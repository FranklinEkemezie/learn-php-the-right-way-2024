<?php

declare(strict_types=1);

namespace App;

interface DebtCollectorInterface
{
    public function collect(float $owedAmount): float;
}