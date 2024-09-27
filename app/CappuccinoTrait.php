<?php

declare(strict_types=1);

namespace App;

trait CappuccinoTrait
{
    protected string $cappuccinoMilkType = 'dano';

    // Static properties is not shared among classes using the trait.
    // They have a copy of that static property
    public static int $cappuccinoMade = 0;

    public function makeCappuccino()
    {
        static::$cappuccinoMade++;
        echo self::class, ' is making cappuccino with ', $this->cappuccinoMilkType, '<br/>';
    }

    public function setMilkType(string $milkType)
    {
        $this->cappuccinoMilkType = $milkType;

        return $this;
    }
}