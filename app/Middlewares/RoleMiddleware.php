<?php

namespace Middlewares;

use Src\Auth\Auth;
use Src\Request;

class RoleMiddleware
{
    public function handle(Request $request, $role = null)
    {
        $user = Auth::user();

        if (!$user) {
            echo '<h2 style="text-align:center; margin-top:50px;">Необходима авторизация</h2>';
            exit;
        }

        if ($role && $user->role !== $role) {
            echo '<h2 style="text-align:center; margin-top:50px;">Доступ запрещен</h2>';
            exit;
        }
    }
}
