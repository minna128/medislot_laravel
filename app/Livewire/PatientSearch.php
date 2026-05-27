<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Patient;

class PatientSearch extends Component
{
    public $search = '';

    public function render()
    {
        $patients = Patient::with('user')
            ->whereHas('user', function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.patient-search', compact('patients'));
    }
}