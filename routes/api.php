<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CondominiumController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function ()
{
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('user')->name('user.')->group(function ()
{
    Route::post('/register', [UserController::class, 'store']);
});

Route::prefix('condominium')->name('condominium')->group(function ()
{
    Route::middleware('auth:sanctum')->group(function ()
    {
        Route::get('/', [CondominiumController::class, 'index']);
        Route::post('/', [CondominiumController::class, 'store']);
        Route::get('/{id}', [CondominiumController::class, 'show']);
        Route::patch('/{id}', [CondominiumController::class, 'update']);
        Route::delete('/{id}', [CondominiumController::class, 'destroy']);
    });
});
