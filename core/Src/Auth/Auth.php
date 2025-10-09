<?php

namespace Src\Auth;

use Src\Session;

class Auth

{
    private static IdentityInterface|null $model = null;

    public static function init(IdentityInterface $user): void
    {
        self::$model = $user;
    }

    public static function login(IdentityInterface $user): void
    {
        Session::set('id', $user->getId());
    }

    public static function attempt(array $credentials): bool
    {
        echo "<h3>ОТЛАДКА Auth::attempt</h3>";
        echo "<pre>";
        echo "Model инициализирована: " . (self::$model ? 'ДА' : 'НЕТ') . "\n";

        if (self::$model) {
            echo "Класс модели: " . get_class(self::$model) . "\n";
        } else {
            echo "<p style='color: red;'>КРИТИЧЕСКАЯ ОШИБКА: Auth модель не инициализирована!</p>";
            die();
        }

        echo "\nПереданные credentials:\n";
        print_r($credentials);
        echo "</pre>";

        if (!self::$model) {
            return false;
        }

        echo "<p>Вызываем attemptIdentity на модели " . get_class(self::$model) . "...</p>";

        $user = self::$model->attemptIdentity($credentials);

        echo "<pre>";
        echo "Результат attemptIdentity:\n";
        if ($user) {
            echo "ТИП: " . get_class($user) . "\n";
            echo "ID: " . $user->getId() . "\n";
            var_dump($user);
        } else {
            echo "NULL - пользователь не найден или пароль неверный\n";
        }
        echo "</pre>";

        if ($user) {
            self::login($user);
            return true;
        }

        return false;
    }

    public static function user(): ?IdentityInterface
    {
        if (!self::$model) return null;

        $id = Session::get('id');
        return $id ? self::$model->findIdentity($id) : null;
    }

    public static function check(): bool
    {
        return self::user() !== null;
    }

    public static function logout(): bool
    {
        Session::clear('id');
        return true;
    }
    public static function generateCSRF(): string
    {
        $token = md5(time());
        \Src\Session::set('csrf_token', $token);
        return $token;
    }

}
