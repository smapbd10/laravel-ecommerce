<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be executed by the "web" middleware group. Create something great!
|
*/

require __DIR__ . '/install.php';

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/wishlist', function () {
    return view('wishlist');
})->name('wishlist');

// Customer routes
Route::middleware(['auth'])->group(function () {
    Route::get('/account', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    Route::get('/account/orders', function () {
        return view('customer.orders');
    })->name('customer.orders');

    Route::get('/account/profile', function () {
        return view('customer.profile');
    })->name('customer.profile');
});
