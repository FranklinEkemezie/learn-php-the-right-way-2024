<?php

declare(strict_types=1);

namespace App\Entities;

/**
 * @property-read string $fullName
 * @property-read string $email
 */

class User
{
    
    public function __construct(
        private string $fullName,
        private string $email,
    )
    {

    }

    public function __get(string $name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \Exception("Accessing property '$name' on " . __CLASS__);
    }
}