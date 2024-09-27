<?php

declare(strict_types=1);

namespace App;

class ClassA
{
    protected static string $name = 'A';

    public static function getName(): string
    {
        echo 'Early static binding: ', self::class, '<br/>';
        echo 'Late static binding: ', static::class, '<br/>';

        // Old school php before 'static' keyword wa introduced
        echo 'Late static binding: ', get_called_class(), '<br/>';

        return static::$name;
    }

    // Using 'static' as return type
    public static function make(): static
    {
        return new static();
    }
}