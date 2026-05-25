<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;

class AppointmentApiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            $appointments = Appointment::with('patient.user', 'doctor.user')->latest()->get();
        } elseif ($user->role === 'doctor') {
            $appointments = Appointment::with('patient.user')
                ->where('doctor_id', $user->doctor?->id)
                ->latest()->get();
        } else {
            $appointments = Appointment::with('doctor.user')
                ->where('patient_id', $user->patient?->id)
                ->latest()->get();
        }

        return response()->json($appointments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'        => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);

        $patient = $request->user()->patient;

        if (!$patient) {
            $patient = Patient::create(['user_id' => $request->user()->id]);
        }

        $appointment = Appointment::create([
            'patient_id'       => $patient->id,
            'doctor_id'        => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'notes'            => $request->notes,
            'status'           => 'pending',
        ]);

        return response()->json($appointment, 201);
    }

    public function show($id)
    {
        $appointment = Appointment::with('patient.user', 'doctor.user')->findOrFail($id);
        return response()->json($appointment);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'status' => 'sometimes|in:pending,confirmed,cancelled',
        ]);

        $appointment->update($request->only([
            'status', 'notes', 'appointment_date', 'appointment_time'
        ]));

        return response()->json($appointment);
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted successfully']);
    }
}