<?php

declare(strict_types=1);

namespace App\Models;

use App\App;
use App\Database;


/**
 * @property-read \PDO $db
 */
abstract class BaseModel
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::db();
    }

    
}