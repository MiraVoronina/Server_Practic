<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->ID_User_Role == 1) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Доступ запрещен. Требуются права администратора.');
    }
}
