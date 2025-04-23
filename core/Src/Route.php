<?php

namespace Src;

use Error;
use Src\Request;

class Route
{
    private static array $routes = [];
    private static string $prefix = '';

    public static function setPrefix($value)
    {
        self::$prefix = $value;
    }

    public static function add(string $route, array $action): void
    {
        if (!array_key_exists($route, self::$routes)) {
            self::$routes[$route] = $action;
        }
    }

    public static function start()
    {
        $uri = $_GET['uri'] ?? '/';

        if (!isset(self::$routes[$uri])) {
            throw new \Error("Route not found: $uri");
        }

        $route = self::$routes[$uri];

        if (is_array($route)) {
            [$class, $method] = $route;

            if (!class_exists($class)) {
                throw new \Error("Class $class does not exist");
            }

            $controller = new $class();
            if (!method_exists($controller, $method)) {
                throw new \Error("Method $method does not exist in $class");
            }

            $request = $_SERVER['REQUEST_METHOD'] === 'POST' ? (object)['method' => 'POST', 'all' => $_POST] : (object)['method' => 'GET'];
            $response = $controller->$method($request);

            if (is_string($response)) {
                echo $response;
            }
            return;
        }

        if (!class_exists($route)) {
            throw new \Error("This class does not exist");
        }

        $page = new $route();
        $page->render();
    }

    public function redirect(string $url): void
    {
        header('Location: ' . $this->getUrl($url));
    }

    public function getUrl(string $url): string
    {
        return self::$prefix . '/' . trim($url, '/');
    }

    public function __construct(string $prefix = '')
    {
        self::setPrefix($prefix);
    }
}
