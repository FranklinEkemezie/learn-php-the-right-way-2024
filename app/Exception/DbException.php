<?php

declare(strict_types=1);

namespace App\Exception;

class DbException extends \Exception
{
    protected $message = 'Database error occurred';


}