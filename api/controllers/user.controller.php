<?php
namespace API\Controllers;

use API\Auth\RBAC;
use API\Models\ResellerPackage;
use API\Models\Role;
use API\Models\User;
use API\Models\Users;
use API\Models\UserType;
use API\TSHP;

class UserController {

    public function getUserByID(int $id): User{
        RBAC::checkPerms("users.read", $id);

        $user = User::selectByID($id);
        return $user;
    }

    public function deleteByID(int $id): bool{
        RBAC::checkPerms("users.delete", $id);

        $tshp = TSHP::getInstance();
        if($tshp->user->UserID == $id){
            throw new \Exception("You cannot delete yourself");
        }

        $user = User::selectByID($id);
        if($user->UserType->isAdmin() && $user->UserCount > 0){
            throw new \Exception("You cannot delete an admin with users");
        }
        if($user->UserType->isReseller() && $user->UserCount > 0){
            throw new \Exception("You cannot delete a reseller with users");
        }

        $user->delete();
        return true;
    }

    public function selectAll(): Users{
        RBAC::checkPerms("users.read", null);

        return User::selectAll();
    }

    public function create(array $dbUser, UserType $userType): User{
        $tshp = \API\TSHP::getInstance();
        RBAC::checkPerms("users.create", null);

        if($tshp->user->Reseller && $userType->isNotUser()){
            throw new \Exception('You cannot create users of this type');
        }
        
        $dbUser['UserID'] = 0;
        $user = User::dbUserToObject([
            ...$dbUser,
            'UserCount' => 0,
            'Suspended' => 0,
            'Admin' => $userType->isAdmin(),
            'Reseller' => $userType->isReseller(),
            'ResellerID' => $tshp->user->UserID,
            'ResellerPackageID' => $dbUser['ResellerPackageID'] ?? null,
            'UserPackageID' => $dbUser['UserPackageID'] ?? null
        ]);
        $user->UserType = $userType;

        $emailExists = false;
        try{
            User::selectByEmail($user->Email);
            $emailExists = true;
        }catch(\Exception $e){
            // Do nothing
        }finally{
            if($emailExists){
                throw new \Exception('Email already exists');
            }
        }

        $usernameExists = false;
        try{
            User::selectByUsername($user->Username);
            $usernameExists = true;
        }catch(\Exception $e){
            // Do nothing
        }finally{
            if($usernameExists){
                throw new \Exception('Username already exists');
            }
        }

        try{
            if($userType->isReseller()){
                if($user->ResellerPackageID) ResellerPackage::selectByID($user->ResellerPackageID);
                else throw new \Exception('Reseller package not selected');
            }elseif($userType->isUser()){
                // TODO: Check for UserPackageID
                if($user->ResellerID) User::selectByID($user->ResellerID);
                else throw new \Exception('Reseller not selected');
            }
        }catch(\Exception $e){
            throw $e;
        }

        return $user->create($dbUser['Password']);
    }
}



?>