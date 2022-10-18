<?php
namespace API\Models;

use JsonSerializable;

class UserType implements JsonSerializable {
    private string $type;

    public function __construct(bool $admin, bool $reseller){
        if($admin){
            $this->type = 'Admin';
        } else if($reseller){
            $this->type = 'Reseller';
        } else {
            $this->type = 'User';
        }
    }

    public function __toString(): string{
        return $this->type;
    }

    public function jsonSerialize(): mixed
    {
        return $this->type;
    }

    public static function Admin(): UserType{
        return new UserType(true, false);
    }

    public static function Reseller(): UserType{
        return new UserType(false, true);
    }

    public static function User(): UserType{
        return new UserType(false, false);
    }

    public function isAdmin(): bool{
        return $this->type == 'Admin';
    }

    public function isReseller(): bool{
        return $this->type == 'Reseller';
    }
}