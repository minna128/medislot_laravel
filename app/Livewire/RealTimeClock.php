<?php

namespace App\Livewire;

use Livewire\Component;

class RealTimeClock extends Component
{
    public $time;
    public $date;

    public function mount()
    {
        $this->time = now('Asia/Colombo')->format('H:i:s');
        $this->date = now('Asia/Colombo')->format('l, F j, Y');
    }

    public function refreshTime()
    {
        $this->time = now('Asia/Colombo')->format('H:i:s');
        $this->date = now('Asia/Colombo')->format('l, F j, Y');
    }

    public function render()
    {
        return view('livewire.real-time-clock');
    }
}