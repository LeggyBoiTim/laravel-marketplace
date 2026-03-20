<?php

use App\Http\Controllers\AdController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
    Route::redirect('/', '/ads');
});

Route::middleware('guest')->group(function () {
    Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
    Route::redirect('/', '/ads');
});
