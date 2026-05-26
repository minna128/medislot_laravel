<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = [
        'name', 'location', 'phone', 'hours', 'description', 'image'
    ];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}