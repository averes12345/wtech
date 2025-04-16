<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
/* I decided to merge the logic into a single controller */
/* use App\Http\Controllers\Auth\AdminLoginController; */

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginFrom')->name('login');
    Route::post('/login', 'login')->name('login.submit');
});

Route::middleware(['auth:admin']) ->group(function () {
    Route::get('/admin/home', fn () => view('admin-home-page'));
});

Route::get('/', function () {
    return view('homepage');
});

Route::get('/products', function () {
    return view('category-page');
});

//Route::get('/products/{id}', function ($id) {
//    return view('product-page', ['id' => $id]);
//});
Route::get('/product', function () {
    return view('product-page');
});

Route::get('/checkout', function () {
    return view('checkout-page');
});


Route::get('/registration', function () {
    return view('registration-page');
});

