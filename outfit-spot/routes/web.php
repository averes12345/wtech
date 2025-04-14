<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminLoginController;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginFrom')->name('login');
    Route::post('/login', 'login')->name('login.submit');
});
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');

Route::middleware(['auth:admin']) ->group(function () {
    Route::get('/admin/home', fn () => view('admin-home-page'));
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/checkout', function () {
    return view('checkout-page');
});


Route::get('/registration', function () {
    return view('registration-page');
});

