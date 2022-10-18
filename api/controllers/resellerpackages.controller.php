<?php
namespace API\Controllers;

use API\Models\ResellerPackage;

class ResellerPackagesController {

    public function selectAll(){
        $tshp = \API\TSHP::getInstance();
        if(!$tshp->admin) {
            throw new \Exception('Unauthorized');
        }
        return ResellerPackage::selectAll(); 
    }

    public function create(array $dbResellerPackage): ResellerPackage{
        $tshp = \API\TSHP::getInstance();
        if(!$tshp->admin) {
            throw new \Exception('Unauthorized');
        }

        $dbResellerPackage['ResellerPackageID'] = 0;
        $resellerPackage = ResellerPackage::dbResellerPackageToObject($dbResellerPackage);

        return $resellerPackage->create();
    }
}