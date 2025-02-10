<?php

declare(strict_types=1);

namespace App;

use App\Exception\RouteNotFoundException;
use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;

class App
{

    private static $db;
    public static Container $container;

    public function __construct(
        private Router $router,
        private Config $config
    )
    {
        // Instantiate the Database connection
        static::$db = new Database($config);
        static::$container = new Container();

        // Register services here
//        static::$container->set(InvoiceService::class, function (Container $c) {
//            return new InvoiceService(
//                $c->get(SalesTaxService::class),
//                $c->get(PaymentGatewayService::class),
//                $c->get(EmailService::class)
//            );
//        });
//
//        static::$container->set(SalesTaxService::class, fn() => new SalesTaxService());
//        static::$container->set(PaymentGatewayService::class, fn() => new PaymentGatewayService());
//        static::$container->set(EmailService::class, fn() => new EmailService());

    }

    public static function db(): Database
    {
        return static::$db;
    }

    public function run(string $requestUri, string $requestMethod): View|string
    {
        try {
            return $this->router
                ->resolve($requestUri, $requestMethod);

        } catch(RouteNotFoundException) {
            // Tip: Best to have an ErrorController to handle this

            // Send 404 Not Found status code
            header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");

            return View::make('error/404', title: 'Error 404 Not Found');
        } 
        catch(\Exception $e) {
            // Tip: Best to have an ErrorController to handle this

            // Send 500 error code
            http_response_code(500);

            return View::make('error/500', [
                'error_msg'     => $e->getMessage(),
                'error_code'    => (string) $e->getCode() ??'NULL'
            ], 'Internal Error');
        }

    }
}