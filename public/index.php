<?php

declare(strict_types=1);

use App\Classes\Home;
use App\Classes\Invoice;
use App\Router;

require __DIR__ . '/../vendor/autoload.php';
session_start();

// 2.23 - SuperGlobals'

// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';


// -- First Router version --
// (new Router())
//     ->register('/', function () {
//         echo 'Home';
//     })
//     ->register('/invoices', function () {
//         echo 'Invoices';
//     })
//     ->resolve($_SERVER['REQUEST_URI']);

// -- Second Router Version --
// echo (new Router())
//     ->register('/', [Home::class, 'index'])
//     ->register('/invoices', [Invoice::class, 'index'])
//     ->register('/invoices/create', [Invoice::class, 'create'])

//     ->resolve($_SERVER['REQUEST_URI']);

// -- Third Router Version --
echo (new Router())
    ->get('/', [Home::class, 'index'])

    ->get('/invoices', [Invoice::class, 'index'])
    ->get('/invoices/create', [Invoice::class, 'create'])
    ->post('/invoices/create', [Invoice::class, 'store'])

    ->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

    
// 
echo '<pre>';
print_r($_COOKIE);
echo '</pre>';