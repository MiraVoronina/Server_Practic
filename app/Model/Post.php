<?php

namespace Model;

class Post
{
    public static function all(): array
    {
        // временный пример — можно подключить БД позже
        return [
            ['title' => 'Пример поста', 'content' => 'Это пример содержимого']
        ];
    }
}
