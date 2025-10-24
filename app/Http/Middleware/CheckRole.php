<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Необходимо войти в систему');
        }

        if (Auth::user()->ID_User_Role != $role) {
            return redirect()->route('home')->with('error', 'Доступ запрещен. Недостаточно прав.');
        }

        return $next($request);
    }
}
