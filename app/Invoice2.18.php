<?php

declare(strict_types=1);

namespace App;

class Invoice
{
    private string $id;

    public function __construct(
        public float $amount,
        public string $description
    ) {
        $this->id = uniqid('Invoice_');
    }


    // Create a new object of the same type
    public static function make(float $amount, string $description): static {
        return new static($amount, $description);
    }

}