<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;

class AppointmentStatusUpdater extends Component
{
    public $appointmentId;
    public $status;
    public $message = '';

    public function mount($appointmentId)
    {
        $this->appointmentId = $appointmentId;
        $this->status = Appointment::find($appointmentId)->status;
    }

    public function updateStatus($newStatus)
    {
        $appointment = Appointment::find($this->appointmentId);
        $appointment->update(['status' => $newStatus]);
        $this->status = $newStatus;
        $this->message = 'Status updated to ' . ucfirst($newStatus) . '!';
    }

    public function render()
    {
        return view('livewire.appointment-status-updater');
    }
}