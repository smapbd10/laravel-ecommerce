<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;

Route::middleware('guest')->group(function () {
    Route::get('/install', [InstallController::class, 'index'])->name('install.index');
    Route::get('/install/step1', [InstallController::class, 'step1'])->name('install.step1');
    Route::get('/install/step2', [InstallController::class, 'step2'])->name('install.step2');
    Route::get('/install/step3', [InstallController::class, 'step3'])->name('install.step3');
    Route::get('/install/step4', [InstallController::class, 'step4'])->name('install.step4');
    Route::post('/install/test-database', [InstallController::class, 'testDatabase'])->name('install.test-database');
    Route::post('/install/process', [InstallController::class, 'process'])->name('install.process');
});
