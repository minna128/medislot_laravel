<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
    return [
        'id' => $this->id,
        'appointment_date' => $this->appointment_date,
        'status' => $this->status,

        'doctor' => [
            'name' => $this->doctor->name,
            'specialization' => $this->doctor->specialization,
        ],

        'patient' => [
            'name' => $this->patient->name,
        ],

        'clinic' => [
            'clinic_name' => $this->clinic->clinic_name,
            'location' => $this->clinic->location,
        ]
        ];
    }
}
