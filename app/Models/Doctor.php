<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Clinic;

class Doctor extends Model
{
    protected $fillable = [
        'user_id', 'specialization', 'qualifications',
        'clinic_location', 'phone', 'availability'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}