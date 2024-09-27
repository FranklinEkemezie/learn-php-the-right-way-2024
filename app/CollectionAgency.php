<?php

declare(strict_types=1);

namespace App;

use App\DebtCollectorInterface;

class CollectionAgency implements DebtCollectorInterface
{
    public function collect(float $owedAmount): float
    {
        $guaranteed = $owedAmount * 0.5;
        return mt_rand((int) $guaranteed, (int) $owedAmount);
    }
}