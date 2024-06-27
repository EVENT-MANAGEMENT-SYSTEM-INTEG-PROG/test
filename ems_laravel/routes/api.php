<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SchedulingController;
use App\Http\Controllers\BudgetController;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;


//USER MANAGEMENT
Route::prefix('/user')->group(function() {
    Route::post('/login', [AuthController::class, 'loginAccount']);
    Route::post('/signup', [AuthController::class, 'createAccount']);
    Route::get('/me', [AuthController::class, 'show'])->middleware(['auth:sanctum']);
    Route::patch('/me', [AuthController::class, 'accountUpdate'])->middleware(['auth:sanctum']);
    Route::post('/logout', [AuthController::class, 'logoutAccount'])->middleware(['auth:sanctum']);
    Route::get('/organizers', [AuthController::class, 'showOrganizer']);
    

    //Event
    Route::get('/events', [EventController::class, 'myEvent'])->middleware(['auth:sanctum']);
});

//EVENT MANAGEMENT
Route::prefix('/event')->group(function() {
    Route::get('', [EventController::class, 'index']);
    Route::get('/{id}', [EventController::class, 'show']);
    Route::post('', [EventController::class, 'store'])->middleware(['auth:sanctum']);
    Route::patch('/{id}', [EventController::class, 'update'])->middleware(['auth:sanctum']);
    Route::delete('/{id}', [EventController::class, 'destroy'])->middleware(['auth:sanctum']);
    Route::post('/{id}/notify', [EventController::class, 'notifyParticipants']); // Notify participants
    Route::post('/check-conflict', [EventController::class, 'checkConflict']); // Check for conflicts
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

// SCHEDULE
Route::prefix('/schedule')->group(function() {
    Route::get('', [SchedulingController::class, 'index']);
    Route::get('/{id}', [SchedulingController::class, 'show']);
    Route::post('', [SchedulingController::class, 'store']);
    Route::patch('/{id}', [SchedulingController::class, 'update']);
    Route::delete('/{id}', [SchedulingController::class, 'destroy']);
});

// Budget
Route::prefix('/budget')->group(function() {
    Route::get('', [BudgetController::class, 'index'])->middleware(['auth:sanctum']);
    Route::get('/{id}', [BudgetController::class, 'show'])->middleware(['auth:sanctum']);
    Route::post('', [BudgetController::class, 'store'])->middleware(['auth:sanctum']);
    Route::patch('/{id}', [BudgetController::class, 'update'])->middleware(['auth:sanctum']);
    Route::delete('/{id}', [BudgetController::class, 'destroy'])->middleware(['auth:sanctum']);
});

// Attendee
use App\Http\Controllers\AttendeeController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/event', [AttendeeController::class, 'getEventInfo']);
    Route::get('/attendees', [AttendeeController::class, 'getAttendees']);
    Route::post('/attendees', [AttendeeController::class, 'addAttendee']);
    Route::put('/attendees/{id}', [AttendeeController::class, 'updateAttendee']);
    Route::delete('/attendees/{id}', [AttendeeController::class, 'deleteAttendee']);
});

