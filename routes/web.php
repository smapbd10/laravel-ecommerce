<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be executed by the "web" middleware group.
|
*/

require __DIR__ . '/install.php';

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/shop', function () {
    return view('shop.index');
})->name('shop');

Route::get('/product/{slug}', function ($slug) {
    return view('shop.product');
})->name('product');

Route::get('/category/{slug}', function ($slug) {
    return view('shop.category');
})->name('category');

Route::get('/brand/{slug}', function ($slug) {
    return view('shop.brand');
})->name('brand');

Route::get('/cart', function () {
    return view('cart.index');
})->name('cart');

Route::get('/checkout', function () {
    return view('checkout.index');
})->name('checkout');

Route::get('/wishlist', function () {
    return view('wishlist.index');
})->name('wishlist');

Route::get('/blog', function () {
    return view('blog.index');
})->name('blog');

Route::get('/blog/{slug}', function ($slug) {
    return view('blog.post');
})->name('blog.post');

Route::get('/news', function () {
    return view('news.index');
})->name('news');

Route::get('/news/{slug}', function ($slug) {
    return view('news.post');
})->name('news.post');

Route::get('/tools', function () {
    return view('tools.index');
})->name('tools');

Route::get('/page/{slug}', function ($slug) {
    return view('pages.show');
})->name('page');

Route::get('/contact', function () {
    return view('contact.index');
})->name('contact');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
});

// Customer Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/account', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');

    Route::get('/account/orders', function () {
        return view('customer.orders.index');
    })->name('customer.orders');

    Route::get('/account/orders/{id}', function ($id) {
        return view('customer.orders.show');
    })->name('customer.order');

    Route::get('/account/profile', function () {
        return view('customer.profile.edit');
    })->name('customer.profile');

    Route::get('/account/addresses', function () {
        return view('customer.addresses.index');
    })->name('customer.addresses');

    Route::get('/account/reviews', function () {
        return view('customer.reviews.index');
    })->name('customer.reviews');
});
