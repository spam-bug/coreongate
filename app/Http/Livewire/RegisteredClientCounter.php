<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class RegisteredClientCounter extends Component
{

    public $count;

    public function mount() {
        $this->getRegisteredClients();
    }

    public function getRegisteredClients() {
        $this->count = Client::all()->count();
    }

    public function render()
    {
        return view('livewire.registered-client-counter');
    }
}
