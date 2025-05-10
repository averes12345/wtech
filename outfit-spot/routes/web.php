<?php

use App\CartService as AppCartService;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
/* I decided to merge the logic into a single controller */
/* use App\Http\Controllers\Auth\AdminLoginController; */
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminHome;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginFrom')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::post('/logout', 'logout')->name('login.logout');
});


Route::middleware(['auth:admin']) ->group(function () {
    Route::get('/admin/home', [AdminHome::class, 'index'])->name('adminHome');
    Route::get('/admin/home/search', [AdminHome::class, 'index'])->name('products.find');
    Route::delete('/admin/delete/{currentVariant:id}', [AdminHome::class, 'delete'])->name('product.delete');

    Route::get('/admin/addProduct', [ProductController::class, 'create'] )->name('addProduct');
    Route::get('/admin/editProduct/{product:id}/{currentVariant:id}', [ProductController::class, 'edit'])->name('admin.products.edit');

    Route::put( 'admin/products/update/{product:id}', [ProductController::class, 'update']) ->name('admin.products.update');

    Route::post( 'admin/products/upload-image', [ProductController::class, 'uploadImage']) ->name('admin.products.uploadImage');
    Route::post( 'admin/products/add', [ProductController::class, 'store']) ->name('admin.products.store');
    /* all the other admin routes, which should be protected by the admin guard ei. redirect to the login page */
});


Route::get('/', function () {
    return view('homepage');
});

Route::get('/products/{category:name}', [CategoryController::class, 'byCategory'])
    ->name('products.byCategory');

Route::get('/products', [CategoryController::class, 'byName'])
    ->name('products.byName');


Route::get('/product/{product:id}/{currentVariant:id}', [ProductController::class, 'show'])
    ->name('product.show');



/* CHECKOUT PAGE METHODS */

Route::controller(CheckoutController::class)->group(function () {
    /* show the checkout page, index the items in the cart*/
    Route::get('/checkout', 'index')->name('checkout');

    /* submit the order and redirect to success / failiure */
    Route::post('/checkout/order', 'order')->name('checkout.shipping.order');
    /* display if the everything was successfull */
    Route::get('/checkout/success', 'success');
    /* cancel the order, checkout failiure */
    Route::get('/checkout/cancel', 'cancel');

    /* shipping */
    /* post the shipping details */
    Route::post('checkout/shipping-details', 'shippingDetails')->name('checkout.shipping.details');
    /* post the shipping option */
    Route::post('checkout/shipping-option', 'shippingOption')->name('checkout.shipping.option');
    /* post the payment info */
    Route::post('checkout/payment', 'payment')->name('checkout.payment');
});



/* cart */
/* update the ammount of a product variation in the cart */
Route::patch('checkout/{productVariationId}', [CartController::class, 'update'])->name('cart.update');
/* add to the cart */
Route::post('checkout/{productVariantId}', [CartController::class, 'add'])->name('cart.add');
/* remove a specific variation of a product from the cart */
Route::delete('checkout/{productVariationId}', [CartController::class, 'destroy'])-> name('cart.delete');



/* REGISTRATION PAGE METHODS */
/* display the registration page */
Route::get('/registration', [RegistrationController::class, 'showForm']);
/* submit the registration page form, create user, redirect to login */
Route::post('/registration', [RegistrationController::class, 'store'])->name('register');

/* TESTING ROUTES */
use App\Services\CartService;
use Illuminate\Support\Facades\Redis;
Route::get('/test-session', function () {
    session(['test' => 'it works']);
    return 'Session stored.';
});
Route::get('/test-redis', function () {
    Redis::set('test-key', 'working');
    return Redis::get('test-key');
});
Route::get('/test-cart/{productVariationId}/{quantity}', function ($productVariationId, $quantity){
    $cartservice = app(CartService::class);
    $cartservice->add($productVariationId, $quantity);
    return session()->get('cart', []);
    });
