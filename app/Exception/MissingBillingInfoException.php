<?php

declare(strict_types=1);

namespace App\Exception;

class MissingBillingInfoException extends \Exception
{
    protected $message = 'Missing billing information.';
}