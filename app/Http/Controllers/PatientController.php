<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use App\Models\Clinic;


class PatientController extends Controller
{
    public function dashboard()
    {
        return view('patient.dashboard');
    }

    public function book()
    {
    $doctors = Doctor::with('user')->where('status', 'active')->get();        
    $doctorAvailability = $doctors->mapWithKeys(function ($doctor) {
            return [$doctor->id => $doctor->availability];
        });
    $clinics = Clinic::all();

    return view('patient.book', compact(
        'doctors',
        'doctorAvailability',
        'clinics'
    ));    
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

    public function cancelAppointment(Appointment $appointment)
{
    // Only allow patient to cancel their own appointment
    $patient = Auth::user()->patient;

    if (!$patient || $appointment->patient_id !== $patient->id) {
        abort(403);
    }

    if ($appointment->status === 'confirmed') {
        return back()->with('error', 'Cannot cancel a confirmed appointment.');
    }

    $appointment->delete();
    return back()->with('success', 'Appointment cancelled successfully.');
}

    public function storeBooking(Request $request)
    {
        $request->validate([
            'clinic_id' => 'required|exists:clinics,id',
            'doctor_id'        => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);

        // Check availability
        $doctor = Doctor::find($request->doctor_id);
        if ($doctor->clinic_id != $request->clinic_id) {
            return back()->withErrors([
                'doctor_id' => 'Selected doctor does not belong to this clinic.'
            ])->withInput();
        }
        if ($doctor->status !== 'active') {
            return back()->withErrors([
            'doctor_id' => 'This doctor is currently inactive.'
            ])->withInput();
        }
        if ($doctor && $doctor->availability) {
            preg_match('/(\d+)(am|pm)-(\d+)(am|pm)/i', str_replace(' ', '', $doctor->availability), $matches);
            if ($matches) {
                $startHour = (int)$matches[1];
                $endHour   = (int)$matches[3];
                if (strtolower($matches[2]) === 'pm' && $startHour !== 12) $startHour += 12;
                if (strtolower($matches[4]) === 'pm' && $endHour !== 12) $endHour += 12;

                $bookedHour = (int)explode(':', $request->appointment_time)[0];
                $bookedMin  = (int)explode(':', $request->appointment_time)[1];
                $bookedTime = $bookedHour + $bookedMin / 60;

                if ($bookedTime < $startHour || $bookedTime >= $endHour) {
                    return back()->withErrors([
                        'appointment_time' => "Dr. {$doctor->user->name} is only available {$doctor->availability}."
                    ])->withInput();
                }
            }
        }

        // Check duplicate slot
        $exists = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($exists) {
            return back()->withErrors(['appointment_time' => 'This time slot is already booked. Please choose another.'])->withInput();
        }

        $patient = Auth::user()->patient;
        if (!$patient) {
            $patient = Patient::create(['user_id' => Auth::id()]);
        }

        Appointment::create([
        'patient_id'       => $patient->id,
        'doctor_id'        => $request->doctor_id,
        'clinic_id'        => $request->clinic_id,
        'appointment_date' => $request->appointment_date,
        'appointment_time' => $request->appointment_time,
        'notes'            => $request->notes,
        'status'           => 'pending',
    ]);

        return redirect()->route('patient.book')->with('success', 'Appointment booked successfully!');
    }


    public function clinics()
    {
        $clinics = Clinic::with('doctors.user')->get();
        return view('patient.clinics', compact('clinics'));
    }
}