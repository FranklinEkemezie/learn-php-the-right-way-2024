<?php

declare(strict_types=1);

namespace App\Exception;

class InvoiceException extends \Exception
{
    public static function missingBillingInfo(): static {
        return new static('Missing billing info');
    }

    public static function invalidAmount(): static {

        return new static('Invalid amount');
    }
}