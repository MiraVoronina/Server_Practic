<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
        });

        $this->renderable(function (TooManyRequestsHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Слишком много запросов. Пожалуйста, попробуйте позже.'
                ], 429);
            }

            return back()->withErrors([
                'throttle' => 'Слишком много запросов. Пожалуйста, попробуйте позже через несколько минут.'
            ]);
        });
    }
}
