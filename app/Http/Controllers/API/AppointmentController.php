<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Http\Resources\AppointmentResource;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AppointmentResource::collection(
            Appointment::with([
                'doctor',
                'patient',
                'clinic'
            ])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
        'doctor_id' => 'required|exists:doctors,id',
        'patient_id' => 'required|exists:patients,id',
        'clinic_id' => 'required|exists:clinics,id',
        'appointment_date' => 'required|date',
        'status' => 'required'
    ]);

        // Create a new appointment record
        $appointment = Appointment::create([
        'doctor_id' => $request->doctor_id,
        'patient_id' => $request->patient_id,
        'clinic_id' => $request->clinic_id,
        'appointment_date' => $request->appointment_date,
        'status' => $request->status
    ]);
        // Return the newly created appointment as a resource
        return new AppointmentResource($appointment->load([
        'doctor',
        'patient',
        'clinic'
    ]
    ));
    
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $appointment = Appointment::findOrFail($id);// Find the appointment by ID or fail with a 404 error

        $request->validate([
            'status' => 'required'
        ]);

        $appointment->update([
            'status' => $request->status
        ]);

        return new AppointmentResource(
            $appointment->load([
                'doctor',
                'patient',
                'clinic'
            ])
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $appointment = Appointment::findOrFail($id);

    $appointment->delete();

    return response()->json([
        'message' => 'Appointment deleted successfully'
    ]);
    }
}
