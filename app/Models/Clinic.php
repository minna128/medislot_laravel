<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
use App\Models\Appointment;

class Clinic extends Model
{
    protected $fillable = [
        'name', 'location', 'phone', 'hours', 'description', 'image'
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}