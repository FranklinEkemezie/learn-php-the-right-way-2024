<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\DB;
use App\Enums\Status;
use App\PaymentGateway\Paddle\Transaction;

// $paddleTransaction = new Transaction();
// var_dump($paddleTransaction); echo '<br/>';

$tr = new Transaction(120, 'Transaction 2');

// echo Transaction::STATUS_PAID, '<br/>';
// echo $tr::STATUS_PENDING, '<br/>';
// echo $tr::class;
// echo Transaction::class;
// echo '<br/>';

$tr->setStatus(Status::PAID);
// var_dump($tr);

// echo Transaction::$count, '<br/>';
echo Transaction::getCount(), '<br/>';

$tr = new Transaction(14, 'Transaction i');
$tr = new Transaction(10, 'Transaction jj');
$tr = new Transaction(20, 'Transaction 21');
$tr = new Transaction(100, 'Transaction hy');

echo Transaction::getCount(), '<br/>';
// echo $tr::getCount(), '<br/>';
// echo $tr->getCount(), '<br/>';


// Instantiating an object of the DB class is not repeated
// even if we request for the instance multiple times
DB::getInstance([]);
DB::getInstance([]);
DB::getInstance([]);
DB::getInstance([]);
DB::getInstance([]);

