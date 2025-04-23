<?php

namespace Src;

use Error;

class Settings
{
    private array $_settings;

    public function __construct(array $settings = [])
    {
        $this->_settings = $settings;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->_settings)) {
            return $this->_settings[$key];
        }
        throw new Error('Accessing a non-existent property');
    }

    public function getRootPath(): string
    {
        return $this->path['root'] ? '/' . $this->path['root'] : '';
    }

    public function getViewsPath(): string
    {
        return '/' . ($this->path['views'] ?? '');
    }

    public function getDbSetting(): array
    {
        $path = dirname(__DIR__, 2) . '/config/db.php';

        if (!file_exists($path)) {
            throw new \Error("Файл конфигурации базы данных не найден: $path");
        }

        $settings = require $path;

        if (!is_array($settings)) {
            throw new \Error("Файл конфигурации базы данных не вернул массив");
        }

        return $settings;
    }
}
