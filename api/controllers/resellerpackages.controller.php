<?php
namespace API\Controllers;

use API\Auth\RBAC;
use API\Models\ResellerPackage;

class ResellerPackagesController {

    public function selectAll(){
        RBAC::checkPerms("resellerPackages.read", null);
        return ResellerPackage::selectAll(); 
    }

    public function create(array $dbResellerPackage): ResellerPackage{
        RBAC::checkPerms("resellerPackages.create", null);

        $dbResellerPackage['ResellerPackageID'] = 0;
        $resellerPackage = ResellerPackage::dbResellerPackageToObject($dbResellerPackage);

        return $resellerPackage->create();
    }
}