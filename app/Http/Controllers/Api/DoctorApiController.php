<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

class DoctorApiController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->get()->map(function ($doctor) {
            return [
                'id'              => $doctor->id,
                'name'            => $doctor->user->name,
                'specialization'  => $doctor->specialization,
                'clinic_location' => $doctor->clinic_location,
                'phone'           => $doctor->phone,
                'availability'    => $doctor->availability,
            ];
        });

        return response()->json($doctors);
    }

    public function show($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return response()->json([
            'id'              => $doctor->id,
            'name'            => $doctor->user->name,
            'specialization'  => $doctor->specialization,
            'clinic_location' => $doctor->clinic_location,
            'phone'           => $doctor->phone,
            'availability'    => $doctor->availability,
        ]);
    }
}