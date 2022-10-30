<?php
namespace API\Models;

use Countable;

class UserPackage {
    public int $UserPackageID;
    public int $ResellerID;
    public Name $Name;
    public int $MaxBandwidth;
    public int $MaxDiskUsage;
    public int $MaxDomains;
    public int $MaxSubDomains;
    public int $MaxDatabases;
    public int $MaxFTPAccounts;

    public ?User $Reseller;

    public function __construct(int $UserPackageID, int $ResellerID, Name $Name, int $MaxBandwidth, int $MaxDiskUsage, int $MaxDomains, int $MaxSubDomains, int $MaxDatabases, int $MaxFTPAccounts) {
        $this->UserPackageID = $UserPackageID;
        $this->ResellerID = $ResellerID;
        $this->Name = $Name;
        $this->MaxBandwidth = $MaxBandwidth;
        $this->MaxDiskUsage = $MaxDiskUsage;
        $this->MaxDomains = $MaxDomains;
        $this->MaxSubDomains = $MaxSubDomains;
        $this->MaxDatabases = $MaxDatabases;
        $this->MaxFTPAccounts = $MaxFTPAccounts;
    }

    public static function dbUserPackageToObject(array $dbUserPackage): self {
        return new UserPackage(
            $dbUserPackage['UserPackageID'],
            $dbUserPackage['ResellerID'],
            new Name($dbUserPackage['Name']),
            $dbUserPackage['MaxBandwidth'],
            $dbUserPackage['MaxDiskUsage'],
            $dbUserPackage['MaxDomains'],
            $dbUserPackage['MaxSubDomains'],
            $dbUserPackage['MaxDatabases'],
            $dbUserPackage['MaxFTPAccounts']
        );
    }

    public static function selectAll(): UserPackages{
        $db = \API\DB::getInstance();
        $dbUserPackages = $db->getUserPackages();
        if(!$dbUserPackages['success']) {
            throw new \Exception('User packages not found');
        }
        return new UserPackages($dbUserPackages['results']);
    }

    public static function selectByID(int $id): self{
        $db = \API\DB::getInstance();
        $dbUserPackages = $db->getUserPackageByID($id);
        if(!$dbUserPackages['success'] || count($dbUserPackages['results']) == 0) {
            throw new \Exception('User package not found');
        }
        return self::dbUserPackageToObject($dbUserPackages['results'][0]);
    }

    public function create(): self {
        $tshp = \API\TSHP::getInstance();
        $db = \API\DB::getInstance();
        $dbUserPackages = $db->addUserPackage($this->Name, $tshp->user->UserID, $this->MaxBandwidth, $this->MaxDiskUsage, $this->MaxDomains, $this->MaxSubDomains, $this->MaxDatabases, $this->MaxFTPAccounts);
        if(!$dbUserPackages['success']) {
            throw new \Exception('User package not created');
        }
        $this->UserPackageID = $db->lastInsertId();
        return $this;
    }

}

class UserPackages implements Countable, \Iterator {
    public array $UserPackages;

    public function __construct(array $UserPackages) {
        $this->UserPackages = array();
        $UserPackagesObjects = array();
        foreach($UserPackages as $UserPackage) {
            if($UserPackage instanceof UserPackage) {
                array_push($UserPackagesObjects, $UserPackage);
                continue;
            }else{
                $UserPackageObject = UserPackage::dbUserPackageToObject($UserPackage);
                array_push($UserPackagesObjects, $UserPackageObject);
            }
        }
        $this->UserPackages = $UserPackagesObjects;
    }

    public function count(): int {
        return count($this->UserPackages);
    }

    public function current(): UserPackage {
        return current($this->UserPackages);
    }

    public function key(): int {
        return key($this->UserPackages);
    }

    public function next(): void {
        next($this->UserPackages);
    }

    public function rewind(): void {
        reset($this->UserPackages);
    }
    
    public function valid(): bool {
        return key($this->UserPackages) !== null;
    }
    
}

?>