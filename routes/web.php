<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home.index');
Route::get('/translate', [HomeController::class, 'translate'])
    ->name('home.translate');
Route::post('/loadView', [HomeController::class, 'loadView']);
Route::post('/storeScore', [HomeController::class, 'storeScore']);
Route::get('/results', [HomeController::class, 'showResults']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
