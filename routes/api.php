<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CondominiumController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::prefix('users')->name('user.')->group(function () {
    Route::post('/register', [UserController::class, 'store'])->name('register');
});

Route::apiResource('condominiums', CondominiumController::class)
    ->names('condominium')
    ->middleware('auth:sanctum');
