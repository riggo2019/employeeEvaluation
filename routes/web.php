<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\LanguageSwitcher;
use Illuminate\Support\Facades\Session;

// Middleware kiểm tra đăng nhập cho trang login/register
Route::prefix('/')->middleware([LoginMiddleware::class, LanguageSwitcher::class])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

// Logout không cần middleware
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware xác thực người dùng
Route::prefix('/')->middleware([AuthenticateMiddleware::class, LanguageSwitcher::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/answer', [HomeController::class, 'answer'])->name('home.answer');
    Route::get('/results', [HomeController::class, 'showResults'])->name('home.results');
    Route::get('/evaluation_management', [HomeController::class, 'evaluation_management'])->name('evaluation_management');

    Route::post('/loadView', [HomeController::class, 'loadView']);
    Route::post('/storeAdminScores', [HomeController::class, 'storeAdminScores'])->name('storeAdminScores');
    Route::post('/storeScore', [HomeController::class, 'storeScore']);

});

// Middleware và prefix cho admin
Route::prefix('admin')->middleware([AuthenticateMiddleware::class, LanguageSwitcher::class])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/addUsers', [AdminController::class, 'addUsers'])->name('admin.addUsers');
    Route::get('/editUsers/{id}', [AdminController::class, 'editUsers'])->name('admin.editUsers');
    Route::get('/scoreListbyCategory', [AdminController::class, 'scoreListbyCategory'])->name('admin.scoreListbyCategory');
    Route::get('/scoreListByEmployee/{department_id}', [AdminController::class, 'scoreListByEmployee'])->name('admin.scoreListByEmployee');
    
    Route::post('/storeUsers', [AdminController::class, 'storeUsers'])->name('admin.storeUsers');
    Route::post('/saveUsers', [AdminController::class, 'saveUsers'])->name('admin.saveUsers');
    Route::post('/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});

Route::get('/change-language/{locale}', function ($locale) {
    if (in_array($locale, ['vi', 'ko'])) {
        Session::put('locale', $locale); // Lưu ngôn ngữ vào session
    }
    return redirect()->back(); // Quay lại trang trước đó
})->middleware(LanguageSwitcher::class)->name('change.language');