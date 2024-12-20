<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\LoginMiddleware;

// Middleware kiểm tra đăng nhập cho trang login/register
Route::prefix('/')->middleware(LoginMiddleware::class)->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

// Logout không cần middleware
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware xác thực người dùng
Route::prefix('/')->middleware(AuthenticateMiddleware::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/answer', [HomeController::class, 'answer'])->name('home.answer');
    Route::get('/results', [HomeController::class, 'showResults']);
    Route::post('/loadView', [HomeController::class, 'loadView']);
    Route::post('/storeScore', [HomeController::class, 'storeScore']);
});

// Middleware và prefix cho admin
Route::prefix('admin')->middleware(AuthenticateMiddleware::class)->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
});
