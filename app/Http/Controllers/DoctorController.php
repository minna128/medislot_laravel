<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;


class DoctorController extends Controller
{
    public function dashboard()
    {
        $doctor = Auth::user()->doctor;
        $appointments = $doctor
            ? Appointment::with('patient.user')
                ->where('doctor_id', $doctor->id)
                ->latest()->take(5)->get()
            : collect();
        return view('doctor.dashboard', compact('appointments'));
    }

    public function appointments()
    {
        $doctor = Auth::user()->doctor;
        $appointments = $doctor
            ? Appointment::with('patient.user')
                ->where('doctor_id', $doctor->id)
                ->latest()->get()
            : collect();
        return view('doctor.appointments', compact('appointments'));
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

    public function profile()
    {
        $doctor = Auth::user()->doctor;
        return view('doctor.profile', compact('doctor'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'specialization'  => 'nullable|string|max:255',
            'qualifications'  => 'nullable|string|max:255',
            'clinic_location' => 'nullable|string|max:255',
            'phone'           => 'nullable|string|max:20',
            'availability'    => 'nullable|string|max:255',
        ]);

        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            $doctor = Doctor::create(['user_id' => Auth::id()]);
        }

        $doctor->update($request->only([
            'specialization', 'qualifications',
            'clinic_location', 'phone', 'availability'
        ]));

        return back()->with('success', 'Profile updated successfully.');
    }
}