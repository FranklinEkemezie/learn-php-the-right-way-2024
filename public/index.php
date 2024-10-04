<?php

declare(strict_types=1);

use App\Classes\Home;
use App\Classes\Invoice;
use App\Router;

require __DIR__ . '/../vendor/autoload.php';

// 2.23 - SuperGlobals'

// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';


// (new Router())
//     ->register('/', function () {
//         echo 'Home';
//     })
//     ->register('/invoices', function () {
//         echo 'Invoices';
//     })
//     ->resolve($_SERVER['REQUEST_URI']);

echo (new Router())
    ->register('/', [Home::class, 'index'])
    ->register('/invoices', [Invoice::class, 'index'])
    ->register('/invoices/create', [Invoice::class, 'create'])

    ->resolve($_SERVER['REQUEST_URI']);