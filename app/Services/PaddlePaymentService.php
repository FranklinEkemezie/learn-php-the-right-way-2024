<?php

namespace App\Services;

use App\Services\PaymentGatewayServiceInterface;

class PaddlePaymentService implements PaymentGatewayServiceInterface
{

    public function charge(array $customer, float $amount, float $tax): bool
    {
        echo "Charging from Paddle payment class<br/>";

        return true;
    }
}