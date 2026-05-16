<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Clinic;

class Appointment extends Model
{

    protected $fillable = [
    'doctor_id',
    'patient_id',
    'clinic_id',
    'appointment_date',
    'status'
    ];

    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
    }
