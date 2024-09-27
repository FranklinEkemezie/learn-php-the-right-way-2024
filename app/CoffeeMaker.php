<?php

declare(strict_types=1);

namespace App;

class CoffeeMaker
{
    public function makeCoffee()
    {
        echo self::class, ' is making coffee... <br/>';
    }
}