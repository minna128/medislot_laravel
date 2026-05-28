<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentApiController;
use App\Http\Controllers\Api\DoctorApiController;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/appointments', [AppointmentApiController::class, 'index']);
    Route::post('/appointments', [AppointmentApiController::class, 'store']);
    Route::get('/appointments/{id}', [AppointmentApiController::class, 'show']);
    Route::put('/appointments/{id}', [AppointmentApiController::class, 'update']);
    Route::delete('/appointments/{id}', [AppointmentApiController::class, 'destroy']);
    Route::get('/doctors', [DoctorApiController::class, 'index']);
    Route::get('/doctors/{id}', [DoctorApiController::class, 'show']);
});