<?php

declare(strict_types=1);

use App\Classes\Home;
use App\Classes\Invoice;

use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use App\Controllers\LearnController;
use App\Exception\RouteNotFoundException;
use App\Router;
use App\View;

require __DIR__ . '/../vendor/autoload.php';
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('DOCUMENT_ROOT', __DIR__ . '/../');
define('LAYOUT_DIR',    DOCUMENT_ROOT . 'layouts/');
define('STORAGE_DIR',   DOCUMENT_ROOT . 'storage/');
define('VIEW_DIR',      DOCUMENT_ROOT . 'views/');

// Check REQUEST_URI for the custom page
$reqUri = $_SERVER['REQUEST_URI'];

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
try {
    echo (new Router())
    ->get('/', [HomeController::class, 'index'])
    ->post('/upload', [HomeController::class, 'upload'])
    ->get('/download', [HomeController::class, 'download'])

    ->get('/invoices', [InvoiceController::class, 'index'])
    ->get('/invoices/create', [InvoiceController::class, 'create'])
    ->post('/invoices/create', [InvoiceController::class, 'store'])

    // Unrelated routes... for tracking learning
    ->get('/learn', [LearnController::class, 'learn'])
    ->get('/learn/basic', [LearnController::class, 'basic'])
    ->get('/learn/intermediate', [LearnController::class, 'intermediate'])
    ->get('/learn/advanced', [LearnController::class, 'advanced'])

    // Route to run PHP PDO example
    ->get('/learn/intermediate/php-pdo', [HomeController::class, 'learnPHPPDO'])

    // Route to run PHP transaction example
    ->get('/learn/intermediate/php-transactions', [HomeController::class, 'sqlTransaction'])

    
    ->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

} catch(RouteNotFoundException $e) {
    // Set header to send 404 Not Found HTTP status code
    header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found!");

    // Or, use the function below
    http_response_code(404);

    // Use headers_sent() function to check if headers have been sent already

    echo View::make('error/404');
}

// // 