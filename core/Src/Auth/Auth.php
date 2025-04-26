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
        if (!self::$model) return false;

        if ($user = self::$model->attemptIdentity($credentials)) {
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
}
