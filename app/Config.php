<?php

declare(strict_types=1);

namespace App;

use App\Exception\NotFoundException;

/**
 * @property-read array $db
 */

class Config
{
    private array $config = [];
    
    public function __construct(array $env)
    {
        // Set the database configuration
        $this->config['db'] = [
            'driver'    => $env['DB_DRIVER']    ?? null,
            'host'      => $env['DB_HOST']      ?? null,
            'db_name'   => $env['DB_DATABASE']  ?? null,
            'user'      => $env['DB_USER']      ?? null,
            'password'  => $env['DB_PASS']      ?? null
        ];
    }

    public function __get(string $name): mixed
    {
        if (key_exists($name, $this->config)) {
            return $this->config[$name];
        }

        throw new NotFoundException(__CLASS__ . " does not have a property '$name'");
    }
}