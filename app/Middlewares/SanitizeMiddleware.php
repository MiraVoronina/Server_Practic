<?php

namespace App\Middlewares;

use Src\Request;

class SanitizeMiddleware
{
    public function handle(Request $request, $param = null)
    {
        $sanitized = [];
        foreach ($request->all() as $key => $value) {
            $sanitized[$key] = htmlspecialchars(strip_tags($value));
        }

        $request->body = $sanitized;
    }
}
