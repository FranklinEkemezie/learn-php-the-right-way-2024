<?php

declare(strict_types=1);

class Invoice
{

    public function __construct() {}

    public function __destruct()
    {
        echo 'Invoice Destructor' . PHP_EOL;
    }

}

//$i = new Invoice();
//$r = WeakReference::create($i);
//
//unset($i);
//var_dump($r->get());
//
//exit();

$invoice1 = new Invoice();
//$invoice2 = $invoice1;

$map = new WeakMap();

$map[$invoice1] = ['a' => 1, 'b' => 2];

//var_dump($map[$invoice1]);
//exit();

//var_dump($map);
//var_dump(count($map));

//var_dump(count($map));
//unset($map[$invoice1]);
//var_dump(count($map));

echo 'Unsetting Invoice 1' . PHP_EOL;
unset($invoice1);
echo 'Unset Invoice 1' . PHP_EOL;

//var_dump($invoice2);
