<?php

declare(strict_types=1);

namespace App;
use App\Exception\RouteNotFoundException;

class Router
{

    public function __construct(
        private Container $container
    )
    {

    }

    private array $routes = [];

//     public function register(string $route, callable $action): self
//     {
//         $this->routes[$route] = $action;
//
//         return $this;
//     }

    // public function resolve(string $requestUri)
    // {
    //     $route = explode('?', $requestUri)[0];
    //     $action = $this->routes[$route] ?? null;

    //     if (! $action) {
    //         throw new RouteNotFoundException();
    //     }

    //     return call_user_func($action);
    // }

    public function register(string $requestMethod, string $route, callable|array $action): self
    {
        $this->routes[$requestMethod][$route] = $action;

        return $this;
    }

    public function get(string $route, callable|array $action): self
    {
        return $this->register('get', $route, $action);
    }

    public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }

    public function routes(): array
    {
        return $this->routes;
    }

    /**
     * @throws RouteNotFoundException
     */
    public function resolve(string $requestUri, string $requestMethod)
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[strtolower($requestMethod)][$route] ?? null;

        if ($action) {
            if (is_callable($action)) {
                return call_user_func($action);
            }

            [$class, $method] = $action;

            if (class_exists($class)) {
//                $class = new $class();

                $class = $this->container->get($class);

                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }

        throw new RouteNotFoundException();
    }

    
}