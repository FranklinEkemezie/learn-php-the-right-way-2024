<?php

namespace App\Services;

use App\Services\PaymentGatewayServiceInterface;

class StripePaymentService implements PaymentGatewayServiceInterface
{

    public function charge(array $customer, float $amount, float $tax): bool
    {
        echo "Charging from Stripe payment class<br/>";
        sleep(1);
        return (bool) mt_rand(0, 1);
    }
}