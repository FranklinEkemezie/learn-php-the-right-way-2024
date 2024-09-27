<?php

// Include the 'Transaction' file before use
require_once '../Transaction.php';

// If the class has no `constructor` or it takes no parameters
// you can ommit the parentheses, as in:
// >>> new Transaction
// However, you should always include it to stay consistent.
// $transaction = new Transaction(100, 'Transaction 1');

$amount = (new Transaction(200, 'Some transaction...'))
    ->addTax(5)
    ->applyDiscount(10)
    ->getAmount();

// $trClassName = 'Transaction';
// $tr2 = new $trClassName(500, 'XYZ');

// $transaction
    // ->addTax(8)
    // ->applyDiscount(10);

// var_dump($transaction->getAmount());   

var_dump($amount);

// var_dump($tr2);
echo '<br/>';


$str = '{"a": 1, "b": 2, "c": 3}';

$arr = json_decode($str);

var_dump($arr->c);

$obj = new \stdClass();

$obj->a = 1;
$obj->b = 2;

var_dump($obj); echo '<br/>';

$arr = [1, 2, 3];
$obj = (object) $arr;

var_dump($obj->{2});

$x = 5;

var_dump((object) $x); echo '<br/>';
var_dump(((object) $x)->scalar); echo '<br/>';
var_dump(((object) false)->scalar);
var_dump((object) NULL);


