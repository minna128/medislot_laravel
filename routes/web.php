<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;

Route::get('/', function () {
    return view('welcome');
});

//routes automatically create URLs for the standard CRUD operations (index, create, store, show, edit, update, destroy) for the Doctor resource.
Route::resource('doctors', DoctorController::class);
Route::get('/add-doctor', [DoctorController::class, 'store']);
Route::get('/update-doctor/{id}', [DoctorController::class, 'update']);
Route::get('/delete-doctor/{id}', [DoctorController::class, 'destroy']);