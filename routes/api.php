<?php

use App\Models\Appointment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AppointmentController;
use Illuminate\Http\Request;

Route::middleware('auth:sanctum')->group(function () { // Protected routes for appointments
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::put('/appointments/{id}', [AppointmentController::class, 'update']);
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Public route for user login
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);