<?php
namespace API\Models;

use Countable;

class ResellerPackage {
    public int $ResellerPackageID;
    public Name $Name;
    public int $MaxBandwidth;
    public int $MaxDiskUsage;
    public int $MaxUsers;
    public int $MaxDomains;
    public int $MaxSubDomains;
    public int $MaxDatabases;
    public int $MaxFTPAccounts;

    public function __construct(int $ResellerPackageID, Name $Name, int $MaxBandwidth, int $MaxDiskUsage, int $MaxUsers, int $MaxDomains, int $MaxSubDomains, int $MaxDatabases, int $MaxFTPAccounts) {
        $this->ResellerPackageID = $ResellerPackageID;
        $this->Name = $Name;
        $this->MaxBandwidth = $MaxBandwidth;
        $this->MaxDiskUsage = $MaxDiskUsage;
        $this->MaxUsers = $MaxUsers;
        $this->MaxDomains = $MaxDomains;
        $this->MaxSubDomains = $MaxSubDomains;
        $this->MaxDatabases = $MaxDatabases;
        $this->MaxFTPAccounts = $MaxFTPAccounts;
    }

    public static function dbResellerPackageToObject(array $dbResellerPackage): self {
        return new ResellerPackage(
            $dbResellerPackage['ResellerPackageID'],
            new Name($dbResellerPackage['Name']),
            $dbResellerPackage['MaxBandwidth'],
            $dbResellerPackage['MaxDiskUsage'],
            $dbResellerPackage['MaxUsers'],
            $dbResellerPackage['MaxDomains'],
            $dbResellerPackage['MaxSubDomains'],
            $dbResellerPackage['MaxDatabases'],
            $dbResellerPackage['MaxFTPAccounts']
        );
    }

    public static function selectAll(): ResellerPackages{
        $db = \API\DB::getInstance();
        $dbResellerPackages = $db->getResellerPackages();
        if(!$dbResellerPackages['success'] || count($dbResellerPackages['results']) == 0) {
            throw new \Exception('Reseller packages not found');
        }
        return new ResellerPackages($dbResellerPackages['results']);
    }

    public static function selectByID(int $id): self{
        $db = \API\DB::getInstance();
        $dbResellerPackage = $db->getResellerPackageByID($id);
        if(!$dbResellerPackage['success'] || count($dbResellerPackage['results']) == 0) {
            throw new \Exception('Reseller package not found');
        }
        return self::dbResellerPackageToObject($dbResellerPackage['results'][0]);
    }

    public function create(): self {
        $db = \API\DB::getInstance();
        $dbResellerPackage = $db->addResellerPackage($this->Name, $this->MaxUsers, $this->MaxBandwidth, $this->MaxDiskUsage, $this->MaxDomains, $this->MaxSubDomains, $this->MaxDatabases, $this->MaxFTPAccounts);
        if(!$dbResellerPackage['success']) {
            throw new \Exception('Reseller package not created');
        }
        $this->ResellerPackageID = $db->lastInsertId();
        return $this;
    }

}

class ResellerPackages implements Countable, \Iterator {
    public array $ResellerPackages;

    public function __construct(array $ResellerPackages) {
        $this->ResellerPackages = array();
        $ResellerPackagesObjects = array();
        foreach($ResellerPackages as $ResellerPackage) {
            if($ResellerPackage instanceof ResellerPackage) {
                array_push($ResellerPackagesObjects, $ResellerPackage);
                continue;
            }else{
                $ResellerPackageObject = ResellerPackage::dbResellerPackageToObject($ResellerPackage);
                array_push($ResellerPackagesObjects, $ResellerPackageObject);
            }
        }
        $this->ResellerPackages = $ResellerPackagesObjects;
    }

    public function count(): int {
        return count($this->ResellerPackages);
    }

    public function current(): ResellerPackage {
        return current($this->ResellerPackages);
    }

    public function key(): int {
        return key($this->ResellerPackages);
    }

    public function next(): void {
        next($this->ResellerPackages);
    }

    public function rewind(): void {
        reset($this->ResellerPackages);
    }
    
    public function valid(): bool {
        return key($this->ResellerPackages) !== null;
    }
    
}

?>