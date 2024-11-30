<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'home'], function () {
    Route::get('/', [HomeController::class, 'index'])
        ->name('home.index');
});