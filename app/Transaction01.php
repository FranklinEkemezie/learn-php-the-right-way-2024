<?php
declare(strict_types=1);

/*
 * It is conventional to:
 * - have one class per file, and
 * - give class the same name as the file containing it.
 * 
 * This is convention that is higly recommended although
 * code can work will work perfectly fine without it.
 */


class Transaction
{
    // private float $amount;
    // private $description;

    // public function __construct(float $amount, string $description)
    // {
    //     $this->amount       = $amount;
    //     $this->description  = $description;
    // }

    public ?Customer $customer;

    public function __construct(
        private float $amount,
        private string $description
    ) {
        echo $amount;
    }

    public function addTax(float $rate): Transaction
    {
        $this->amount += $this->amount * $rate / 100;

        return $this;
    }

    public function applyDiscount(float $rate): Transaction
    {
        $this->amount -= $this->amount * $rate / 100;

        return $this;
    }

    public function getAmount(): float {
        return $this->amount;
    }

    public function __destruct()
    {
        echo "Destruct {$this->description} <br/>";
    }
}