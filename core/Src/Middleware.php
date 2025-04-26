<?php

namespace Src;

use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use FastRoute\DataGenerator\MarkBased as DataGenerator;
use FastRoute\Dispatcher\MarkBased as Dispatcher;
use Src\Traits\SingletonTrait;

class Middleware
{
    use SingletonTrait;

    private RouteCollector $middlewareCollector;

    private function __construct()
    {
        $this->middlewareCollector = new RouteCollector(new Std(), new DataGenerator());
    }

    public function add($httpMethod, string $route, array $middlewares): void
    {
        $this->middlewareCollector->addRoute($httpMethod, $route, $middlewares);
    }

    public function group(string $prefix, callable $callback): void
    {
        $this->middlewareCollector->addGroup($prefix, $callback);
    }

    public function runMiddlewares(string $httpMethod, string $uri): Request
    {
        $request = new Request();
        $dispatcher = new Dispatcher($this->middlewareCollector->getData());

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        if ($routeInfo[0] === Dispatcher::FOUND) {
            $middlewares = $routeInfo[1]; // Список middleware, например: ['auth', 'role:admin']
            $config = app()->settings->app['routeMiddleware'];

            foreach ($middlewares as $middleware) {
                $args = explode(':', $middleware);
                $name = $args[0];
                $param = $args[1] ?? null;

                if (isset($config[$name])) {
                    (new $config[$name])->handle($request, $param);
                }
            }
        }

        return $request;
    }
}
