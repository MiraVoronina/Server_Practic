<?php

use Src\Route;
use App\Controller\Site;

Route::add('/', [Site::class, 'index']);
Route::add('report', [Controller\Site::class, 'report']);
Route::add('schedule', [Controller\Site::class, 'schedule']);
Route::add('disciplines', [Controller\Site::class, 'disciplines']);
Route::add('students', [Controller\Site::class, 'students']);
Route::add('go', [Site::class, 'index']);
Route::add('hello', [Controller\Site::class, 'hello']);
Route::add('signup', [Controller\Site::class, 'signup']);
Route::add('login', [Controller\Site::class, 'login']);
Route::add('logout', [Controller\Site::class, 'logout']);
