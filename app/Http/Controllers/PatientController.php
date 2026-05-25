<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function dashboard()
    {
        return view('patient.dashboard');
    }

    public function book()
    {
        $doctors = Doctor::with('user')->get();
        return view('patient.book', compact('doctors'));
    }

    public function appointments()
    {
        $patient = Auth::user()->patient;
        $appointments = $patient
            ? Appointment::with('doctor.user')->where('patient_id', $patient->id)->latest()->get()
            : collect();
        return view('patient.appointments', compact('appointments'));
    }

    public function doctors()
    {
        $doctors = Doctor::with('user')->get();
        return view('patient.doctors', compact('doctors'));
    }

    public function profile()
    {
        return view('patient.profile');
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'doctor_id'        => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);

        $patient = Auth::user()->patient;

        if (!$patient) {
            $patient = Patient::create([
                'user_id' => Auth::user()->id,
            ]);
        }

        Appointment::create([
            'patient_id'       => $patient->id,
            'doctor_id'        => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'notes'            => $request->notes,
            'status'           => 'pending',
        ]);

        return redirect()->route('patient.book')->with('success', 'Appointment booked successfully!');
    }
}