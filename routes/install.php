<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/install', [\App\Http\Controllers\InstallController::class, 'index'])->name('install.index');
    Route::get('/install/step1', [\App\Http\Controllers\InstallController::class, 'step1'])->name('install.step1');
    Route::get('/install/step2', [\App\Http\Controllers\InstallController::class, 'step2'])->name('install.step2');
    Route::get('/install/step3', [\App\Http\Controllers\InstallController::class, 'step3'])->name('install.step3');
    Route::get('/install/step4', [\App\Http\Controllers\InstallController::class, 'step4'])->name('install.step4');
    Route::post('/install/test-database', [\App\Http\Controllers\InstallController::class, 'testDatabase'])->name('install.test-database');
    Route::post('/install/process', [\App\Http\Controllers\InstallController::class, 'process'])->name('install.process');
});
