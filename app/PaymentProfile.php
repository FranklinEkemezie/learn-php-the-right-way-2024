<?php
declare(strict_types=1);

namespace App;

class PaymentProfile
{
    public int $id;

    public function __construct()
    {
        $this->id = rand();
    }
}