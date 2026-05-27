<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use App\Models\Clinic;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalDoctors      = Doctor::count();
        $totalPatients     = Patient::count();
        $totalAppointments = Appointment::count();
        $pendingCount      = Appointment::where('status', 'pending')->count();
        $totalClinics      = Clinic::count();
        return view('admin.dashboard', compact(
            'totalDoctors', 'totalPatients', 'totalAppointments', 'pendingCount', 'totalClinics'
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

    public function createDoctor()
    {
        return view('admin.create-doctor');
    }

    public function storeDoctor(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:8',
            'specialization'  => 'nullable|string|max:255',
            'qualifications'  => 'nullable|string|max:255',
            'clinic_location' => 'nullable|string|max:255',
            'phone'           => 'nullable|string|max:20',
            'availability'    => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'doctor',
        ]);

        Doctor::create([
            'user_id'         => $user->id,
            'specialization'  => $request->specialization,
            'qualifications'  => $request->qualifications,
            'clinic_location' => $request->clinic_location,
            'phone'           => $request->phone,
            'availability'    => $request->availability,
        ]);

        return redirect()->route('admin.doctors')->with('success', 'Doctor created successfully.');
    }

    public function createPatient()
    {
        return view('admin.create-patient');
    }

    public function storePatient(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:8',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string',
            'date_of_birth' => 'nullable|date',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'patient',
        ]);

        Patient::create([
            'user_id'       => $user->id,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return redirect()->route('admin.patients')->with('success', 'Patient created successfully.');
    }

    

    public function clinics()
    {
        $clinics = Clinic::with('doctors.user')->get();
        return view('admin.clinics', compact('clinics'));
    }

    public function createClinic()
    {
        $doctors = Doctor::with('user')->get();
        return view('admin.create-clinic', compact('doctors'));
    }

    public function storeClinic(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone'    => 'nullable|string|max:20',
            'hours'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $clinic = Clinic::create($request->only([
            'name', 'location', 'phone', 'hours', 'description'
        ]));

        if ($request->has('doctors')) {
            $clinic->doctors()->sync($request->doctors);
        }

        return redirect()->route('admin.clinics')->with('success', 'Clinic created successfully.');
    }

        public function editClinic(Clinic $clinic)
        {
            $doctors = Doctor::with('user')->get();
            return view('admin.edit-clinic', compact('clinic', 'doctors'));
        }

        public function updateClinic(Request $request, Clinic $clinic)
        {
            $request->validate([
                'name'     => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'phone'    => 'nullable|string|max:20',
                'hours'    => 'nullable|string|max:255',
                'description' => 'nullable|string',
            ]);

            $clinic->update($request->only([
                'name', 'location', 'phone', 'hours', 'description'
            ]));

            if ($request->has('doctors')) {
                $clinic->doctors()->sync($request->doctors);
            } else {
                $clinic->doctors()->detach();
            }

            return redirect()->route('admin.clinics')->with('success', 'Clinic updated successfully.');
        }

        public function deleteClinic(Clinic $clinic)
        {
            $clinic->delete();
            return back()->with('success', 'Clinic deleted.');
        }

        public function reassignForm(Appointment $appointment)
{
    $doctors = Doctor::all();

    return view('admin.reassign', compact('appointment', 'doctors'));
}

    public function reassign(Request $request, Appointment $appointment)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        $appointment->doctor_id = $request->doctor_id;
        $appointment->save();

        return redirect()->route('admin.appointments')
            ->with('success', 'Appointment reassigned successfully.');
    }

    public function toggleDoctorStatus(Doctor $doctor)
    {
        $doctor->status =
            $doctor->status === 'active'
            ? 'inactive'
            : 'active';

        $doctor->save();

        return back()->with('success', 'Doctor status updated.');
    }

    public function togglePatientStatus(Patient $patient)
    {
        $patient->status =
            $patient->status === 'active'
            ? 'inactive'
            : 'active';

        $patient->save();

        return back()->with('success', 'Patient status updated.');
    }
}