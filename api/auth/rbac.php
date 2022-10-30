<?php

namespace API\Auth;

use API\Models\Role;
use API\Models\User;
use API\TSHP;

class RBAC {

    public static function checkPerms(string $perm, ?int $otherID): void{
        $tshp = TSHP::getInstance();
        $role = $tshp->user->UserType->getRole();

        if($role == Role::Admin){
            return; // Admin can do everything
        }
        
        $category = explode('.',$perm)[0];
        $action = explode('.',$perm)[1];

        if(@gettype(((object) self::$$category)->$action) == 'array'){
        	$allowedRoles = ((object) self::$$category)->$action;
        }
        else throw new \Exception("Permission not found.");

        in_array($role, $allowedRoles) || throw new \Exception("Unauthorized");

    
        if($category == "users"){
            if($role == Role::Reseller){
                if($otherID != null && $tshp->user->UserID != $otherID){
                    $user = User::selectByID($otherID);
                    if($user->ResellerID != $tshp->user->UserID){
                        throw new \Exception("Unauthorized");
                    }
                }
            }
    
            if($role == Role::User){
                if($otherID != null && $tshp->user->UserID != $otherID){
                    throw new \Exception("Unauthorized");
                }
            }
        }
    }

    public static array $users = [
        "create" => [Role::Reseller],
        "read" => [Role::Reseller, Role::User],
        "update" => [Role::Reseller, Role::User],
        "delete" => [Role::Reseller],
    ];

    public static array $resellerPackages = [
        "create" => [],
        "read" => [Role::Reseller],
        "update" => [],
        "delete" => [],
    ];

}

?>