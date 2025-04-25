<?php

// Путь до директории с конфигурационными файлами
const DIR_CONFIG = '/../config';

// Подключение автозагрузчика composer
require_once __DIR__ . '/../vendor/autoload.php';

// Функция, возвращающая массив всех настроек приложения
function getConfigs(string $path = DIR_CONFIG): array
{
    $settings = [];
    foreach (scandir(__DIR__ . $path) as $file) {
        $name = explode('.', $file)[0];
        if (!empty($name)) {
            $settings[$name] = include __DIR__ . "$path/$file";
        }
    }
    return $settings;
}

// Подключаем маршруты
require_once __DIR__ . '/../routes/web.php';

// СОЗДАЁМ глобальный объект $app
$app = new \Src\Application(new \Src\Settings(getConfigs()));

// Глобальная функция, возвращающая $app
function app() {
    global $app;
    return $app;
}

// Возвращаем объект (опционально, если require возвращает)
return $app;
