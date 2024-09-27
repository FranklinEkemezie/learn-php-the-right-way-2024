<?php

declare(strict_types=1);

namespace App;

use App\DebtCollectorInterface;

class DebtCollectionService
{
    public function collectDebt(DebtCollectorInterface $collector)
    {
        $amountOwed = mt_rand(100, 1000);
        $collectedAmount = $collector->collect($amountOwed);

        echo "Collected $$collectedAmount out of $$amountOwed <br/>";
    }
}