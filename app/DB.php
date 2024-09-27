<?php
declare(strict_types=1);

namespace App;

/*
 * One common use case of the `static` keyword for class
 * properties and methods is in the Singleton pattern.
 * 
 * This design pattern ensures that some operations which
 * require instensive resources are executed once by
 * ensuring the object initiating the operation is only
 * instantiated once. 
 * 
 */
class DB
{
    public static ?DB $instance = null;

    private function __construct(public array $config)
    {
        echo 'Instance Created<br/>';
    }

    public static function getInstance(array $config): DB
    {
        if (self::$instance === null) {
            self::$instance = new DB($config);
        }

        return self::$instance;
    }
}