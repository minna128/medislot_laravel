<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

class Clinic extends Model
{
    protected $fillable = [
    'clinic_name',
    'location'
    ];

    
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    //
}
