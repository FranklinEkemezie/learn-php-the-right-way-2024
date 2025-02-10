<?php

declare(strict_types=1);

use App\App;
use App\Config;
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use App\Controllers\LearnController;
use App\Router;

// Define constants
define('DOCUMENT_ROOT', dirname(__DIR__) . '/');
define('LAYOUT_DIR', DOCUMENT_ROOT . 'layouts/');
define('STORAGE_DIR',   DOCUMENT_ROOT . 'storage/');
define('VIEW_DIR',      DOCUMENT_ROOT . 'views/');

// Include Composer's autoloader
require DOCUMENT_ROOT . 'vendor/autoload.php';

// Start session
session_start();

// Load environment variables
Dotenv\Dotenv::createImmutable(DOCUMENT_ROOT)
    ->load();

// DI container
$container = new \App\Container();

// Register routes here
$router = (new Router($container))
    ->get('/', [HomeController::class, 'index'])
    ->post('/upload', [HomeController::class, 'upload'])
    ->get('/download', [HomeController::class, 'download'])

    ->get('/signup', [HomeController::class, 'signup'])
    ->post('/signup', [HomeController::class, 'createUser'])

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
    ->get('/learn/intermediate/php-transactions', [HomeController::class, 'sqlTransaction']);


// Bootstrap application
echo (new App($container, $router, new Config($_ENV)))
    ->run(
        $_SERVER['REQUEST_URI'],
        $_SERVER['REQUEST_METHOD']
    );