<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return view('welcome');
});

// Override the default /dashboard route to redirect by role
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return match(Auth::user()->role) {
            'admin'   => redirect('/admin/dashboard'),
            'doctor'  => redirect('/doctor/dashboard'),
            'patient' => redirect('/patient/dashboard'),
            default   => view('dashboard'),
        };
    })->name('dashboard');
});

// Patient routes
Route::middleware(['auth', 'role:patient'])->prefix('patient')->group(function () {
    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/book', [PatientController::class, 'book'])->name('patient.book');
    Route::get('/appointments', [PatientController::class, 'appointments'])->name('patient.appointments');
    Route::get('/doctors', [PatientController::class, 'doctors'])->name('patient.doctors');
    Route::get('/profile', [PatientController::class, 'profile'])->name('patient.profile');
    Route::post('/book', [PatientController::class, 'storeBooking'])->name('patient.book.store');
});

use App\Http\Controllers\DoctorController;

Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::get('/appointments', [DoctorController::class, 'appointments'])->name('doctor.appointments');
    Route::post('/appointments/{appointment}/confirm', [DoctorController::class, 'confirm'])->name('doctor.confirm');
    Route::post('/appointments/{appointment}/cancel', [DoctorController::class, 'cancel'])->name('doctor.cancel');
    Route::get('/profile', [DoctorController::class, 'profile'])->name('doctor.profile');
    Route::post('/profile', [DoctorController::class, 'updateProfile'])->name('doctor.profile.update');
});

use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/doctors', [AdminController::class, 'doctors'])->name('admin.doctors');
    Route::get('/patients', [AdminController::class, 'patients'])->name('admin.patients');
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
    Route::post('/appointments/{appointment}/confirm', [AdminController::class, 'confirm'])->name('admin.confirm');
    Route::post('/appointments/{appointment}/cancel', [AdminController::class, 'cancel'])->name('admin.cancel');
    Route::delete('/appointments/{appointment}', [AdminController::class, 'deleteAppointment'])->name('admin.appointment.delete');
    Route::delete('/doctors/{doctor}', [AdminController::class, 'deleteDoctor'])->name('admin.doctor.delete');
    Route::delete('/patients/{patient}', [AdminController::class, 'deletePatient'])->name('admin.patient.delete');
});