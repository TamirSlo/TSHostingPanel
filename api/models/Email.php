<?php
namespace API\Models;

use JsonSerializable;

class Email implements JsonSerializable {

    private string $email;

    public function __construct(string $email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email");
        }
        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }

    public function jsonSerialize(): mixed
    {
        return $this->email;
    }
}

?>