<?php
namespace API\Controllers;

use API\Auth\RBAC;
use API\Models\UserPackage;
use API\Models\UserPackages;

class UserPackagesController {

    public function selectAll(): UserPackages{
        RBAC::checkPerms("userPackages.read", null);
        return UserPackage::selectAll(); 
    }

    public function create(array $dbUserPackage): UserPackage{
        RBAC::checkPerms("userPackages.create", null);

        $dbUserPackage['UserPackageID'] = 0;
        $userPackage = UserPackage::dbUserPackageToObject($dbUserPackage);

        return $userPackage->create();
    }
}