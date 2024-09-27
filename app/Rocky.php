<?php

declare(strict_types=1);

namespace App;

class Rocky implements DebtCollectorInterface
{
    public function collect(float $owedAmount): float
    {
        return $owedAmount * .65;
    }
}