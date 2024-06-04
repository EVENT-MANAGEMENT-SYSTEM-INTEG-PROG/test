<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;


Route::prefix('/user')->group(function() {
    Route::post('/login', [AuthController::class, 'loginAccount']);
    Route::post('/signup', [AuthController::class, 'createAccount']);
    Route::get('/me', [AuthController::class, 'show'])->middleware(['auth:sanctum']);
    Route::get('/logout', [AuthController::class, 'logoutAccount'])->middleware(['auth:sanctum']);
});