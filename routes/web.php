<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
    Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create');
    Route::post('/ads', [AdController::class, 'store'])->name('ads.store');
    Route::get('/ads/{ad}', [AdController::class, 'show'])->name('ads.show');
    Route::get('/ads/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit');
    Route::put('/ads/{ad}', [AdController::class, 'update'])->name('ads.update');
    Route::delete('/ads/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');
    Route::redirect('/', '/ads');

    Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::middleware('guest')->group(function () {    
    Route::get('/login', [SessionController::class, 'create'])->name('login.create');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');
    
    Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/forgot-password', [ResetPasswordController::class, 'request'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'email'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'reset'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'update'])->name('password.update');
});
