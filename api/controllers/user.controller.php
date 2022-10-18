<?php
namespace API\Controllers;

use API\Models\User;
use API\Models\Users;
use API\Models\UserType;

class UserController {

    public function getUserByID(int $id): User{
        return User::selectByID($id);
    }

    public function deleteByID(int $id): bool{
        //TODO: Implement
        User::selectByID($id)->delete();
        return true;
    }

    public function selectAll(): Users{
        $tshp = \API\TSHP::getInstance();
        if(!$tshp->admin) {
            throw new \Exception('Unauthorized');
        }

        return User::selectAll();
    }

    public function create(array $dbUser, UserType $userType): User{
        $tshp = \API\TSHP::getInstance();
        if(!$tshp->admin) {
            throw new \Exception('Unauthorized');
        }

        $dbUser['UserID'] = 0;
        $user = User::dbUserToObject($dbUser);
        $user->UserType = $userType;

        return $user->create($dbUser['Password']);
    }
}



?>