<?php
namespace API\Models;

use JsonSerializable;

class UserType implements JsonSerializable {
    private Role $type;

    public function __construct(bool $admin, bool $reseller){
        if($admin){
            $this->type = Role::Admin;
        } else if($reseller){
            $this->type = Role::Reseller;
        } else {
            $this->type = Role::User;
        }
    }

    public function __toString(): string{
        return match($this->type){
            Role::Admin => 'Admin',
            Role::Reseller => 'Reseller',
            Role::User => 'User',
        };
    }

    public function jsonSerialize(): mixed
    {
        return $this->__toString();
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

    public function getRole(): Role{
        return $this->type;
    }

    public function isAdmin(): bool{
        return $this->type == Role::Admin;
    }

    public function isReseller(): bool{
        return $this->type == Role::Reseller;
    }

    public function isUser(): bool{
        return $this->type == Role::User;
    }

    public function isNotUser(): bool{
        return $this->type == Role::Admin || $this->type == Role::Reseller;
    }
}