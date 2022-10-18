<?php
namespace API\Models;

use API\Models\Email;
use Countable;

class User {
    public int $UserID;
    public Name $Username;
    public Email $Email;
    public Name $FName;
    public Name $LName;
    public bool $Suspended;
    public bool $Admin;
    public bool $Reseller;
    public UserType $UserType;
    public ?int $ResellerID;
    public ?int $ResellerPackageID;
    
    public ?self $ResellerUser;
    public ?ResellerPackage $ResellerPackage;

    public ?int $UserCount;

    public function __construct(int $UserID, Name $Username, Email $Email, Name $FName, Name $LName, bool $Suspended, bool $Admin, bool $Reseller, ?int $ResellerID, ?int $ResellerPackageID, ?int $UserCount) {
        $this->UserID = $UserID;
        $this->Username = $Username;
        $this->Email = $Email;
        $this->FName = $FName;
        $this->LName = $LName;
        $this->Suspended = $Suspended;
        $this->Admin = $Admin;
        $this->Reseller = $Reseller;
        $this->ResellerID = $ResellerID;
        $this->ResellerPackageID = $ResellerPackageID;
        $this->UserCount = $UserCount;

        $this->UserType = new UserType($Admin, $Reseller);
    }

    public static function dbUserToObject(array $dbUser): self {
        $user = new self(
            $dbUser['UserID'],
            new Name($dbUser['Username']),
            new Email($dbUser['Email']),
            new Name($dbUser['FName']),
            new Name($dbUser['LName']),
            boolval($dbUser['Suspended']),
            boolval($dbUser['Admin']),
            boolval($dbUser['Reseller']),
            $dbUser['ResellerID'],
            $dbUser['ResellerPackageID'],
            $dbUser['UserCount']
        );

        if($user->ResellerID != null) {
            $user->ResellerUser = self::selectByID($dbUser['ResellerID']);
        }

        if($user->ResellerPackageID != null) {
            $user->ResellerPackage = ResellerPackage::selectByID($dbUser['ResellerPackageID']);
        }
        
        return $user;
    }

    public static function selectAll(): Users {
        $db = \API\DB::getInstance();
        $users = $db->getAllUsers();
        if(!$users['success'] || count($users['results']) == 0) {
            throw new \Exception('Users not found');
        }
        return new Users($users['results']);
    }

    public static function selectByID(int $id): self {
        $db = \API\DB::getInstance();
        $user = $db->getUserByID($id);
        if(!$user['success'] || count($user['results']) == 0) throw new \Exception("User not found");

        return self::dbUserToObject($user['results'][0]);
    }

    public function create(string $pass): self {
        $db = \API\DB::getInstance();
        $tshp = \API\TSHP::getInstance();

        $salt = $tshp->generateSalt($pass);
        $hash = $tshp->hashPass($pass, $salt);

        $user = $db->addUser((string) $this->Username, $hash, $salt, (string) $this->Email, (string) $this->FName, (string) $this->LName, (int) $this->UserType->isAdmin(), (int) $this->UserType->isReseller(), $tshp->id, $this->ResellerPackageID);
        if(!$user['success']) throw new \Exception("User not created");

        $this->UserID = $db->lastInsertId();
        return $this;
    }

    public function edit(Name $user, string $pass, Email $email, Name $fname, Name $lname, UserType $userType, ?int $resellerPackageID): self {
        $db = \API\DB::getInstance();
        $tshp = \API\TSHP::getInstance();

        if($resellerPackageID == null) {
            $resellerPackageID = $this->ResellerPackageID;
        }else{
            $resellerPackage = ResellerPackage::selectByID($resellerPackageID);
            $resellerPackageID = $resellerPackage->ResellerPackageID;
        }

        $user = $db->editUser($this->UserID, (string) $user, (string) $email, (string) $fname, (string) $lname, (int) $userType->isAdmin(), (int) $userType->isReseller(), $resellerPackageID);
        if(!empty($pass)){
            $salt = $tshp->generateSalt($pass);
            $db->editUserPassword($this->UserID, $tshp->hashPass($pass, $salt), $salt);

        }
        if(!$user['success']) throw new \Exception("User not edited");

        return $this;
    }

    public function delete(): bool {
        $this->db->deleteUserByID($this->UserID);
        return true;
    }

    public static function isAdmin(User $user): bool {
        return $user->Admin;
    }

    public static function isReseller(User $user): bool {
        return $user->Reseller;
    }

    public static function isUser(User $user): bool {
        return !$user->Admin && !$user->Reseller;
    }

    public function fullName(): string {
        return $this->FName . ' ' . $this->LName;
    }
}

class Users implements Countable, \Iterator {
    public array $users;

    public function __construct(array $users) {
        $this->users = array();
        $userObjects = array();
        foreach($users as $user) {
            if($user instanceof User) {
                array_push($userObjects, $user);
                continue;
            }else{
                $userObject = User::dbUserToObject($user);
                array_push($userObjects, $userObject);
            }
        }
        $this->users = $userObjects;
    }

    public function count(): int {
        return count($this->users);
    }

    public function current(): User {
        return current($this->users);
    }

    public function key(): int {
        return key($this->users);
    }

    public function next(): void {
        next($this->users);
    }

    public function rewind(): void {
        reset($this->users);
    }
    
    public function valid(): bool {
        return key($this->users) !== null;
    }

    public function filter(string $filter): Users {
        $filteredUsers = array_filter($this->users, "API\Models\User::$filter");
        return new Users($filteredUsers);
    }

    public function filterByType(UserType $type): Users{
        $filteredUsers = array_filter($this->users, function(User $user) use ($type){
            return $user->UserType == $type;
        });
        return new Users($filteredUsers);
    }
    
}

?>