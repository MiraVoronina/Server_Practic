<?php

namespace Src;

use Error;

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

    public function start(): void
    {
        $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
        $path = preg_replace('#^' . preg_quote($scriptDir, '#') . '#', '', $_SERVER['REQUEST_URI']);
        $path = trim(explode('?', $path)[0], '/');

        if (!array_key_exists($path, self::$routes)) {
            throw new \Error("This path does not exist: [$path]");
        }

        $class = self::$routes[$path][0];
        $action = self::$routes[$path][1];

        if (!class_exists($class)) {
            throw new \Error('This class does not exist');
        }

        if (!method_exists($class, $action)) {
            throw new \Error('This method does not exist');
        }

        echo call_user_func([new $class, $action]);
    }
}
