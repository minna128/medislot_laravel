<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalDoctors      = Doctor::count();
        $totalPatients     = Patient::count();
        $totalAppointments = Appointment::count();
        $pendingCount      = Appointment::where('status', 'pending')->count();
        return view('admin.dashboard', compact(
            'totalDoctors', 'totalPatients', 'totalAppointments', 'pendingCount'
        ));
    }

    public function doctors()
    {
        $doctors = Doctor::with('user')->get();
        return view('admin.doctors', compact('doctors'));
    }

    public function patients()
    {
        $patients = Patient::with('user')->get();
        return view('admin.patients', compact('patients'));
    }

    public function appointments()
    {
        $appointments = Appointment::with('patient.user', 'doctor.user')->latest()->get();
        return view('admin.appointments', compact('appointments'));
    }

    public function confirm(Appointment $appointment)
    {
        $appointment->update(['status' => 'confirmed']);
        return back()->with('success', 'Appointment confirmed.');
    }

    public function cancel(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']);
        return back()->with('success', 'Appointment cancelled.');
    }

    public function deleteAppointment(Appointment $appointment)
    {
        $appointment->delete();
        return back()->with('success', 'Appointment deleted.');
    }

    public function deleteDoctor(Doctor $doctor)
    {
        $doctor->delete();
        return back()->with('success', 'Doctor deleted.');
    }

    public function deletePatient(Patient $patient)
    {
        $patient->delete();
        return back()->with('success', 'Patient deleted.');
    }
}