<?php

declare(strict_types=1);

namespace App;

use App\Exception\RouteNotFoundException;

class App
{

    private static $db;

    public function __construct(
        private Router $router,
        private Config $config
    )
    {
        // Instantiate the Database connection
        static::$db = new Database($config);
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