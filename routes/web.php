<?php

use Src\Route;
use Controller\Site;
use Controller\PositionController;
use Controller\AdminController;

// Главная страница (index)
Route::add('GET', '/', [Site::class, 'index']);

// Остальные маршруты
Route::add('GET', '/hello', [Site::class, 'hello'])
    ->middleware('auth');

Route::add('GET', '/admin', [AdminController::class, 'index'])
    ->middleware('role:admin');

Route::add(['GET', 'POST'], '/signup', [Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Site::class, 'login']);
Route::add('GET', '/logout', [Site::class, 'logout']);
Route::add('GET', '/home', [Controller\Site::class, 'home']);
Route::add('GET', '/students', [Controller\Site::class, 'students']);
Route::add('GET', '/schedule', [Controller\Site::class, 'schedule']);
Route::add('GET', '/grades', [Controller\Site::class, 'grades']);
