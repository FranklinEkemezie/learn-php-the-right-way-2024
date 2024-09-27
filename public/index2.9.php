<?php

declare(strict_types=1);

use App\PaymentGateway\Paddle\Transaction;
use App\Toaster;
use App\ToasterPro;

require_once __DIR__ . '/../vendor/autoload.php';

$transaction = new Transaction(25);

// $transaction->setAmount(125);

$transaction->process(); echo '<br/>';

// Modifying the internal state of a private property using 
// the Reflection API 
$reflectionProperty = new ReflectionProperty(Transaction::class, 'amount');

$reflectionProperty->setValue($transaction, 125);

$transaction->process(); echo '<br/>';

echo $reflectionProperty->getValue($transaction), '<br/>';

// Accessing the private property 'amount' of one object from another
$tr1 = new Transaction(45);
$tr2 = new Transaction(56);

echo "My amount is: {$tr2->getAnotherTransactionAmount($tr1)} <br/>";
echo "My friend's amount: {$tr1->getAnotherTransactionAmount($tr2)} <br/>";


$toast = new Toaster();

$toast->addSlice('bread');
$toast->addSlice('bread');
$toast->addSlice('bread');

$toast->toast();


$toastPro = new ToasterPro();

$toastPro->addSlice('bread');
$toastPro->addSlice('bread');
$toastPro->addSlice('bread');
$toastPro->addSlice('bread');
$toastPro->addSlice('bread');
$toastPro->addSlice('bread');
$toastPro->addSlice('bread');

$toastPro->toastBagel();

// Accepts 'Toaster' and 'ToasterPro' object instances.
// Fails when 'Toaster' object passed and child method
// e.g. 'toastBagel()' is called
function foo(Toaster $toaster)
{
    $toaster->toast();
}

// Accepts only 'ToasterPro' object instances.
function bar(ToasterPro $toaster)
{
    $toaster->toastBagel();
}

foo($toast);
foo($toastPro);
