<?php
declare(strict_types=1);

namespace App\PaymentGateway\Paddle;

use App\Enums\Status;

class Transaction
{
    private static int $count = 0;
    private string $status = Status::PENDING;

    // Transaction status
    public function __construct(
        public float $amount,
        public string $description
    )
    {
        // var_dump(Status::PAID); echo '<br/>';
        // var_dump(Status::DECLINED); echo '<br/>';

        // Increment the static $count property each time an object
        // of this class is created
        self::$count++;
    }

    public function setStatus(string $status): self{
        if (! isset(Status::ALL_STATUSES[$status])) {
            throw new \InvalidArgumentException('Invalid status');
        }

        $this->status = $status;

        return $this;
    }

    public static function getCount(): int {
        return self::$count;
    }

    public function process()
    {
        array_map(function(){
            echo $this->amount, '<br/>';
        }, [1]);

        // Cannot use the '$this' here, since closure is 
        // declared static
        array_map(static function() {
            // echo $this->amount, '<br/>';
        }, [1]);

        echo "Transaction {$this->description} processing...<br />";
    }
}