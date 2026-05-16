<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Doctor::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        Doctor::create([
        'name' => 'Dr Jane',
        'specialization' => 'Neurology',
        'email' => 'drjane@gmail.com',
        'phone' => '0711111111'
        ]);

        return "Doctor Added Successfully";
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
        $doctor = Doctor::find($id);
        $doctor->phone = '0779999999';
        $doctor->save();

        return "Doctor Updated Successfully";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::find($id);
        $doctor->delete();

        return "Doctor Deleted Successfully";
    }
}
