<?php
namespace API\Models;

use JsonSerializable;

class Name implements JsonSerializable {
    private string $Name;

    public function __construct(string $Name) {
        // Check if name is valid
        if(!preg_match('/^[a-zA-Z0-9 ]+$/', $Name)) {
            throw new \Exception('Invalid name');
        }
        $this->Name = $Name;
    }

    public function __toString()
    {
        return $this->Name;
    }

    public function jsonSerialize()
    {
        return $this->Name;
    }
}


?>