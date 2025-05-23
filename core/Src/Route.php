<?php

namespace Src;

use Error;
use Src\Traits\SingletonTrait;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use FastRoute\DataGenerator\MarkBased;
use FastRoute\Dispatcher\MarkBased as Dispatcher;

class Route
{
    use SingletonTrait;

    private string $currentRoute = '';
    private array|string $currentHttpMethod = 'GET';
    private string $prefix = '';
    private RouteCollector $routeCollector;

    public static function add(array|string $httpMethod, string $route, array $action): self
    {
        // Приводим одиночное значение к массиву
        $methods = is_array($httpMethod) ? $httpMethod : [$httpMethod];

        foreach ($methods as $method) {
            self::single()->routeCollector->addRoute($method, $route, $action);
        }

        // Сохраняем только один метод (первый), для логики middleware
        self::single()->currentHttpMethod = $methods[0];
        self::single()->currentRoute = $route;

        return self::single();
    }

    public static function group(string $prefix, callable $callback): void
    {
        self::single()->routeCollector->addGroup($prefix, $callback);
        Middleware::single()->group($prefix, $callback);
    }

    private function __construct()
    {
        $this->routeCollector = new RouteCollector(new Std(), new MarkBased());
    }

    public function setPrefix(string $value = ''): self
    {
        $this->prefix = $value;
        return $this;
    }

    public function redirect(string $url): void
    {
        header('Location: ' . $this->getUrl($url));
        exit;
    }

    public function getUrl(string $url): string
    {
        return $this->prefix . $url;
    }

    public function middleware(...$middlewares): self
    {
        Middleware::single()->add($this->currentHttpMethod, $this->currentRoute, $middlewares);
        return $this;
    }

    public function start(): void
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $uri = rawurldecode($uri);
        $uri = substr($uri, strlen($this->prefix));

        $dispatcher = new Dispatcher($this->routeCollector->getData());

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                throw new Error('NOT_FOUND');
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new Error('METHOD_NOT_ALLOWED');
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = array_values($routeInfo[2]);
                $vars[] = Middleware::single()->runMiddlewares($httpMethod, $uri);
                $class = $handler[0];
                $action = $handler[1];
                call_user_func([new $class, $action], ...$vars);
                break;
        }
    }
}