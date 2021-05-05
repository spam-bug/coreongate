<?php

namespace App\Http\Livewire;


use App\Models\Client;
use Livewire\Component;

class ActiveClientCounter extends Component
{
    public $count = 0;

    public function mount() {
        $this->getActiveClients();
    }

    public function getActiveClients() {
        $this->count = Client::active();
    }

    public function render()
    {
        return view('livewire.active-client-counter');
    }
}
