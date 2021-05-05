<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ForgotPasswordTimer extends Component
{
    public $client;
    public $code;

    public function mount($client, $code) {
        $this->client = $client;
        $this->code = $code;
    }

    public function render()
    {
        return view('livewire.forgot-password-timer');
    }
}
