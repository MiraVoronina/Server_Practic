<?php

return [
    'auth' => \Src\Auth\Auth::class,
    'identity' => \Model\User::class,

    'routeMiddleware' => [
        'auth'     => \Middlewares\AuthMiddleware::class,
        'role'     => \Middlewares\RoleMiddleware::class,
        'sanitize' => \Middlewares\SanitizeMiddleware::class,
        'csrf'     => \Middlewares\CSRFMiddleware::class,
    ],

    'app' => [
        'validators' => [
            'required' => \Validators\RequireValidator::class,
            'unique'   => \Validators\UniqueValidator::class,
        ],
    ],
];
