<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Clinic;

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
            'name'     => 'Sarah Lee',
            'email'    => 'doctor@medislot.com',
            'password' => bcrypt('password'),
            'role'     => 'doctor',
        ]);
        $doc1 = Doctor::create([
            'user_id'         => $doctor1->id,
            'specialization'  => 'Cardiologist',
            'qualifications'  => 'MBBS, MD Cardiology',
            'clinic_location' => 'Block A, MediSlot Clinic',
            'phone'           => '011-1234567',
            'availability'    => 'Mon-Fri 9am-5pm',
        ]);

        // Doctor 2
        $doctor2 = User::create([
            'name'     => 'James Wong',
            'email'    => 'doctor2@medislot.com',
            'password' => bcrypt('password'),
            'role'     => 'doctor',
        ]);
        $doc2 = Doctor::create([
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

        // Clinic
        $clinic = Clinic::create([
            'name'        => 'MediSlot Main Clinic',
            'location'    => 'No. 1, Jalan Sehat, Kuala Lumpur',
            'phone'       => '03-12345678',
            'hours'       => 'Mon-Sat 8am-6pm',
            'description' => 'Our flagship clinic providing comprehensive healthcare services including cardiology and general practice.',
        ]);

        // Assign both doctors to the clinic
        $clinic->doctors()->attach([$doc1->id, $doc2->id]);
    }
}