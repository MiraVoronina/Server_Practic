<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Auth\Auth;
use Model\User;

// === НАСТРОЙКА ELOQUENT ORM ===
$capsule = new Capsule;
$capsule->addConnection(include __DIR__ . '/../config/db.php');
$capsule->setAsGlobal();
$capsule->bootEloquent();

// === ТЕПЕРЬ МОЖНО ИНИЦИАЛИЗИРОВАТЬ АВТОРИЗАЦИЮ ===
Auth::init(new User);

// === ЗАГРУЗКА КОНФИГОВ ===
const DIR_CONFIG = '/../config';
function getConfigs(string $path = DIR_CONFIG): array {
    $settings = [];
    foreach (scandir(__DIR__ . $path) as $file) {
        $name = explode('.', $file)[0];
        if (!empty($name)) {
            $settings[$name] = include __DIR__ . "$path/$file";
        }
    }
    return $settings;
}

// === СОЗДАНИЕ ПРИЛОЖЕНИЯ ===
$app = new \Src\Application(new \Src\Settings(getConfigs()));
require_once __DIR__ . '/../routes/web.php';

function app() {
    global $app;
    return $app;
}

return $app;
