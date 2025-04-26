<?php

use Src\Route;
use Controller\Site;
use Controller\AdminController;

// Главная страница
Route::add('GET', '/', [Site::class, 'index']);

// Аутентификация
Route::add(['GET', 'POST'], '/signup', [Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Site::class, 'login']);
Route::add('GET', '/logout', [Site::class, 'logout']);

// Стандартные страницы
Route::add('GET', '/home', [Site::class, 'home']);
Route::add('GET', '/students', [Site::class, 'students']);
Route::add('GET', '/schedule', [Site::class, 'schedule']);
Route::add('GET', '/grades', [Site::class, 'grades']);
Route::add('GET', '/employees', [Site::class, 'employees']);

// Для Расписания (schedule)
Route::add(['GET', 'POST'], '/schedule/add', [Site::class, 'addSchedule']);
Route::add(['GET', 'POST'], '/schedule/edit', [Site::class, 'editSchedule']);
Route::add(['GET', 'POST'], '/schedule/delete', [Site::class, 'deleteSchedule']);

// Для Студентов (students)

Route::add(['GET', 'POST'], '/students/add', [Site::class, 'addStudent'])->middleware('sanitize');
Route::add(['GET', 'POST'], '/students/edit', [Site::class, 'editStudent']);
Route::add(['GET', 'POST'], '/students/delete', [Site::class, 'deleteStudent']);

// Для Оценок (grades)
Route::add(['GET', 'POST'], '/grades/add', [Site::class, 'addGrade']);
Route::add(['GET', 'POST'], '/grades/edit', [Site::class, 'editGrade']);
Route::add(['GET', 'POST'], '/grades/delete', [Site::class, 'deleteGrade']);

// Для Сотрудников (employees) — только для администратора
Route::add(['GET', 'POST'], '/employees/add', [AdminController::class, 'addEmployee'])->middleware('role:admin');
Route::add(['GET', 'POST'], '/employees/edit', [AdminController::class, 'editEmployee'])->middleware('role:admin');
Route::add(['GET', 'POST'], '/employees/delete', [AdminController::class, 'deleteEmployee'])->middleware('role:admin');
