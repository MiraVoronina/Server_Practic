<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\OrderFilterController;
use App\Http\Controllers\OrderCommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\NotificationController;

Route::middleware('throttle:global')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');

    Route::get('/about', function () {
        return view('aboutus');
    })->name('about');

    Route::get('/contacts', function () {
        return view('contacts');
    })->name('contacts');

    Route::get('/services', function () {
        return view('services_page');
    })->name('services');

    Route::get('/service-center', function () {
        return view('service_center');
    })->name('service.center');
});

Route::middleware('throttle:login')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('throttle:register')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'throttle:orders'])->group(function () {
    Route::get('/orders', [OrderFilterController::class, 'filter'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::post('/orders/{id}/comments', [OrderCommentController::class, 'store'])->name('orders.comments.store');
    Route::delete('/comments/{id}', [OrderCommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markRead');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unreadCount');
});

Route::middleware(['auth', 'role:1', 'throttle:orders'])->group(function () {
    Route::put('/orders/{id}/status-admin', [OrderStatusController::class, 'update'])->name('orders.status.update');
});

Route::middleware(['auth', 'role:1', 'throttle:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/orders/create', [AdminOrderController::class, 'create'])->name('admin.orders.create');
    Route::post('/orders', [AdminOrderController::class, 'store'])->name('admin.orders.store');
    Route::post('/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});
