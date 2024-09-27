<?php
declare(strict_types=1);

namespace App\PaymentGateway\Paddle;

class Transaction
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    // public function getAmount(): float
    // {
    //     return $this->amount;
    // }

    // public function setAmount(float $amount)
    // {
    //     $this->amount = $amount;
    // }

    // We can access the private properties of another object
    // in another object
    public function getAnotherTransactionAmount(Transaction $transaction): float {
        return $transaction->amount;
    }

    public function process()
    {
        echo "Processing \${$this->amount} transaction";
    }

}
