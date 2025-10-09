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
    'validators' => [
        'required' => \Src\Validator\Rules\RequiredRule::class,
        'min' => \Src\Validator\Rules\MinRule::class,
        'max' => \Src\Validator\Rules\MaxRule::class,
        'numeric' => \Src\Validator\Rules\NumericRule::class,
        'email' => \Src\Validator\Rules\EmailRule::class,
    ],
];
