<?php

// require_once '../Customer.php';
// require_once '../PaymentProfile.php';
// require_once '../Transaction.php';

// require_once '../App/PaymentGateway/Paddle/CustomerProfile.php';
// require_once '../App/PaymentGateway/Paddle/Transaction.php';
// require_once '../App/PaymentGateway/Stripe/Transaction.php';

spl_autoload_register(function($class) {
    echo "Calling autoloader 1: ";
    var_dump($class);
    echo '<br/>';

    // Trying to include the files
    $classPath = __DIR__ . '/../' . lcfirst(str_replace('\\', '/', $class)) . '.php';
    
    require_once $classPath;
});

spl_autoload_register(function($class) {
    echo "Calling autoloader 2: ";
    var_dump($class);
    echo '<br/>';
}, prepend: true);


use App\PaymentGateway\Paddle\{Transaction, CustomerProfile};
use App\PaymentGateway\Stripe;

// Use namespace 'const' and functions
// use const Some\Namespace\constantName;
// use function Some\Namespace\functionName;

// $transaction = new Transaction(5, 'Test');
// $transaction->customer?->paymentProfile?->id;

$paddleTransaction = new Transaction();

var_dump($paddleTransaction);
