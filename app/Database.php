<?php

declare(strict_types=1);

namespace App;

use PDO;

class Database
{

    private PDO $db;

    public function __construct(Config $config)
    {
        $dbConfig = $config->db;
        
        $dsn = <<<DSN
        {$dbConfig['driver']}:
        host={$dbConfig['host']};
        dbname={$dbConfig['db_name']}
        DSN;

        $this->db = new PDO(
            $dsn,
            $dbConfig['user'], 
            $dbConfig['password'],
            [
                PDO::ATTR_DEFAULT_STR_PARAM => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES  => false
            ]
        );
    }

    // Proxy PDO database function calls to the PDO extension

    public function __call(string $method, $args)
    {
        if (method_exists($this->db, $method)) {
            return call_user_func_array([$this->db, $method], $args);
        }

        throw new \Exception("Calling undefined method '$method' on " . __CLASS__);
    }
}