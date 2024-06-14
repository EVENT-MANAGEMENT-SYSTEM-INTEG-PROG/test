<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;


//USER MANAGEMENT
Route::prefix('/user')->group(function() {
    Route::post('/login', [AuthController::class, 'loginAccount']);
    Route::post('/signup', [AuthController::class, 'createAccount']);
    Route::get('/me', [AuthController::class, 'show'])->middleware(['auth:sanctum']);
    Route::post('/logout', [AuthController::class, 'logoutAccount'])->middleware(['auth:sanctum']);
});

//EVENT MANAGEMENT
Route::prefix('/event')->group(function() {
    Route::get('', [EventController::class, 'index']);
    Route::get('/{id}', [EventController::class, 'show']);
    Route::post('', [EventController::class, 'store']);
    Route::patch('/{id}', [EventController::class, 'update']);
    Route::delete('/{id}', [EventController::class, 'destroy']);
});

//PARTICIPANT REGISTRATION
Route::prefix('/registration')->group(function() {
    Route::get('', [RegistrationController::class, 'index']);
    Route::get('/{id}', [RegistrationController::class, 'show']);
    Route::post('', [RegistrationController::class, 'store']);
    Route::patch('/{id}', [RegistrationController::class, 'update']);
    Route::delete('/{id}', [RegistrationController::class, 'destroy']);
});

// EVALUATION
Route::prefix('/evaluation')->group(function() {
    Route::get('', [EvaluationController::class, 'index']);
    Route::get('/{id}', [EvaluationController::class, 'show']);
    Route::post('', [EvaluationController::class, 'store']);
    Route::patch('/{id}', [EvaluationController::class, 'update']);
    Route::delete('/{id}', [EvaluationController::class, 'destroy']);
});


