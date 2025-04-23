<?php
declare(strict_types=1);
spl_autoload_register(function ($class) {
    $path = '../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        throw new Error("Autoload failed: $path not found");
    }
});

try {
    $app = require_once __DIR__ . '/../core/bootstrap.php';
    $app->run();
} catch (\Throwable $exception) {
    echo '<pre>';
    print_r($exception);
    echo '</pre>';
}
