<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;

Route::middleware(['auth', 'admin_only'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

    // Users & Roles
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    // Settings
    Route::get('/settings/general', [SettingsController::class, 'general'])->name('settings.general');
    Route::post('/settings/general', [SettingsController::class, 'store'])->name('settings.store.general');
    Route::get('/settings/branding', [SettingsController::class, 'branding'])->name('settings.branding');
    Route::post('/settings/branding', [SettingsController::class, 'store'])->name('settings.store.branding');
    Route::get('/settings/theme', [SettingsController::class, 'theme'])->name('settings.theme');
    Route::post('/settings/theme', [SettingsController::class, 'store'])->name('settings.store.theme');
    Route::get('/settings/header', [SettingsController::class, 'header'])->name('settings.header');
    Route::post('/settings/header', [SettingsController::class, 'store'])->name('settings.store.header');
    Route::get('/settings/footer', [SettingsController::class, 'footer'])->name('settings.footer');
    Route::post('/settings/footer', [SettingsController::class, 'store'])->name('settings.store.footer');
});
