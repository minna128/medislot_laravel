<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Doctor;

class DoctorSearch extends Component
{
    public $search = '';

    public function render()
    {
        $doctors = Doctor::with('user')
            ->whereHas('user', function($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.doctor-search', compact('doctors'));
    }
}
