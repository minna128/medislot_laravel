<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdminController;


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
    Route::delete('/appointments/{appointment}', [PatientController::class, 'cancelAppointment'])->name('patient.appointment.cancel');
    Route::get('/clinics', [PatientController::class, 'clinics'])->name('patient.clinics');
});

// Doctor routes
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::get('/appointments', [DoctorController::class, 'appointments'])->name('doctor.appointments');
    Route::post('/appointments/{appointment}/confirm', [DoctorController::class, 'confirm'])->name('doctor.confirm');
    Route::post('/appointments/{appointment}/cancel', [DoctorController::class, 'cancel'])->name('doctor.cancel');
    Route::get('/profile', [DoctorController::class, 'profile'])->name('doctor.profile');
    Route::post('/profile', [DoctorController::class, 'updateProfile'])->name('doctor.profile.update');
});


// Admin routes
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
    Route::get('/doctors/create', [AdminController::class, 'createDoctor'])->name('admin.doctor.create');
    Route::post('/doctors/create', [AdminController::class, 'storeDoctor'])->name('admin.doctor.store');
    Route::get('/patients/create', [AdminController::class, 'createPatient'])->name('admin.patient.create');
    Route::post('/patients/create', [AdminController::class, 'storePatient'])->name('admin.patient.store');
    Route::get('/appointments/{appointment}/reassign', [AdminController::class, 'reassignForm'])->name('admin.reassign.form');
    Route::post('/appointments/{appointment}/reassign', [AdminController::class, 'reassign'])->name('admin.reassign');
    Route::post('/doctor/{doctor}/toggle-status', [AdminController::class, 'toggleDoctorStatus'])->name('admin.doctor.toggle');
    Route::post('/patient/{patient}/toggle-status', [AdminController::class, 'togglePatientStatus'])->name('admin.patient.toggle');
    Route::get('/api-explorer', [AdminController::class, 'apiExplorer'])->name('admin.api.explorer');

});

// Clinic management routes for admin
    Route::get('/clinics', [AdminController::class, 'clinics'])->name('admin.clinics');
    Route::get('/clinics/create', [AdminController::class, 'createClinic'])->name('admin.clinic.create');
    Route::post('/clinics/create', [AdminController::class, 'storeClinic'])->name('admin.clinic.store');
    Route::get('/clinics/{clinic}/edit', [AdminController::class, 'editClinic'])->name('admin.clinic.edit');
    Route::post('/clinics/{clinic}/edit', [AdminController::class, 'updateClinic'])->name('admin.clinic.update');
    Route::delete('/clinics/{clinic}', [AdminController::class, 'deleteClinic'])->name('admin.clinic.delete');