<?php

use App\CartService as AppCartService;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
/* I decided to merge the logic into a single controller */
/* use App\Http\Controllers\Auth\AdminLoginController; */
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RegistrationController;

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginFrom')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::post('/logout', 'logout')->name('login.logout');
});

Route::middleware(['auth:admin']) ->group(function () {
    Route::get('/admin/home', fn () => view('admin-home-page'));
    /* all the other admin routes, which should be protected by the admin guard ei. redirect to the login page */
});

Route::get('/', function () {
    return view('homepage');
});

Route::get('/products/{category:name}', [CategoryController::class, 'byCategory'])
    ->name('products.byCategory');


Route::get('/product/{product:id}/{currentVariant:id}', [ProductController::class, 'show'])
    ->name('product.show');



/* CHECKOUT PAGE METHODS */

/* show the checkout page, index the items in the cart*/
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

/* display if the everything was successfull */
Route::post('/checkout/order', [CheckoutController::class, 'order'])->name('checkout.shipping.order');
Route::get('/checkout/success', [CheckoutController::class, 'success']);
/* cancel the order, checkout failiure */
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel']);

/* shipping */
/* post the shipping info */
Route::post('checkout/shipping-details', [CheckoutController::class, 'shippingDetails'])->name('checkout.shipping.details');

Route::post('checkout/shipping-option', [CheckoutController::class, 'shippingOption'])->name('checkout.shipping.option');
/* payment */
/* post the payment info*/
Route::post('checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');

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
Route::post('/registration', [RegistrationController::class, 'store']);

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
