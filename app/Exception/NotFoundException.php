<?php

declare(strict_types=1);

namespace App\Exception;

class NotFoundException extends \Exception
{
    protected $message = 'Not found';
}