<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@medislot.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        // Doctor 1
        $doctor1 = User::create([
            'name'     => 'Dr. Sarah Lee',
            'email'    => 'doctor@medislot.com',
            'password' => bcrypt('password'),
            'role'     => 'doctor',
        ]);
        Doctor::create([
            'user_id'         => $doctor1->id,
            'specialization'  => 'Cardiologist',
            'qualifications'  => 'MBBS, MD Cardiology',
            'clinic_location' => 'Block A, MediSlot Clinic',
            'phone'           => '011-1234567',
            'availability'    => 'Mon-Fri 9am-5pm',
        ]);

        // Doctor 2
        $doctor2 = User::create([
            'name'     => 'Dr. James Wong',
            'email'    => 'doctor2@medislot.com',
            'password' => bcrypt('password'),
            'role'     => 'doctor',
        ]);
        Doctor::create([
            'user_id'         => $doctor2->id,
            'specialization'  => 'General Practitioner',
            'qualifications'  => 'MBBS',
            'clinic_location' => 'Block B, MediSlot Clinic',
            'phone'           => '011-7654321',
            'availability'    => 'Mon-Sat 8am-4pm',
        ]);

        // Patient
        $patientUser = User::create([
            'name'     => 'Patient User',
            'email'    => 'patient@medislot.com',
            'password' => bcrypt('password'),
            'role'     => 'patient',
        ]);
        Patient::create([
            'user_id'       => $patientUser->id,
            'phone'         => '012-9999999',
            'address'       => '123 Main Street, KL',
            'date_of_birth' => '1995-06-15',
        ]);
    }
}