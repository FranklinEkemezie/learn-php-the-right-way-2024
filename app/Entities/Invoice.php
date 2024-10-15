<?php

declare(strict_types=1);

namespace App\Entities;

/**
 * @property-read int $amount
 * @property-read string $invoiceId
 */

class Invoice
{


    public function __construct(
        private string $invoiceId,
        private int $amount
    )
    {

    }


    public function __get(string $name): mixed
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \Exception("Accessing property $name on " . __CLASS__);
    }
}