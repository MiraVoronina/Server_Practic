<?php

use Src\Route;
use Controller\Site;
use Controller\AdminController;

Route::add(['GET', 'POST'], '/signup', [Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Site::class, 'login']);
Route::add('GET', '/logout', [Site::class, 'logout']);

Route::add('GET', '/', [Site::class, 'index']);
Route::add('GET', '/home', [Site::class, 'home'])->middleware('auth');
Route::add('GET', '/students', [Site::class, 'students'])->middleware('auth');
Route::add('GET', '/schedule', [Site::class, 'schedule'])->middleware('auth');
Route::add('GET', '/grades', [Site::class, 'grades'])->middleware('auth');
Route::add('GET', '/employees', [Site::class, 'employees'])->middleware('auth');

Route::add('GET', '/admin', [AdminController::class, 'index'])->middleware('auth', 'role:admin');

Route::add(['GET', 'POST'], '/schedule/add', [Site::class, 'addSchedule'])->middleware('auth', 'role:deanery');
Route::add(['GET', 'POST'], '/schedule/edit', [Site::class, 'editSchedule'])->middleware('auth', 'role:deanery');
Route::add(['GET', 'POST'], '/schedule/delete', [Site::class, 'deleteSchedule'])->middleware('auth', 'role:deanery');

Route::add(['GET', 'POST'], '/students/add', [Site::class, 'addStudent'])->middleware('auth', 'role:deanery');
Route::add(['GET', 'POST'], '/students/edit', [Site::class, 'editStudent'])->middleware('auth', 'role:deanery');
Route::add(['GET', 'POST'], '/students/delete', [Site::class, 'deleteStudent'])->middleware('auth', 'role:deanery');

Route::add(['GET', 'POST'], '/grades/add', [Site::class, 'addGrade'])->middleware('auth', 'role:deanery');
Route::add(['GET', 'POST'], '/grades/edit', [Site::class, 'editGrade'])->middleware('auth', 'role:deanery');
Route::add(['GET', 'POST'], '/grades/delete', [Site::class, 'deleteGrade'])->middleware('auth', 'role:deanery');

Route::add(['GET', 'POST'], '/employees/add', [AdminController::class, 'addEmployee'])->middleware('auth', 'role:admin');
Route::add(['GET', 'POST'], '/employees/edit', [AdminController::class, 'editEmployee'])->middleware('auth', 'role:admin');
Route::add(['GET', 'POST'], '/employees/delete', [AdminController::class, 'deleteEmployee'])->middleware('auth', 'role:admin');
