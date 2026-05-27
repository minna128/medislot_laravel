<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;

class AppointmentStats extends Component
{
    public $filter = 'all';

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }

    public function render()
    {
        $query = Appointment::query();

        if ($this->filter !== 'all') {
            $query->where('status', $this->filter);
        }

        $appointments = $query->with('patient.user', 'doctor.user')->latest()->take(5)->get();
        $total = Appointment::count();
        $pending = Appointment::where('status', 'pending')->count();
        $confirmed = Appointment::where('status', 'confirmed')->count();
        $cancelled = Appointment::where('status', 'cancelled')->count();

        return view('livewire.appointment-stats', compact(
            'appointments', 'total', 'pending', 'confirmed', 'cancelled'
        ));
    }
}