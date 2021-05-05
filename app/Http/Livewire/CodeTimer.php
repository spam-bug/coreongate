<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Helpers\Helper;
use Livewire\Component;
use App\Mail\ForgotPasswordMail;
use App\Models\ForgotPasswordCode;
use Illuminate\Support\Facades\Mail;

class CodeTimer extends Component
{
    public $client;
    public $code;
    public $minutes;
    public $seconds = 0;
    public $isTimerStopped;
    public $resendCode;

    public function mount($client, $code) {
        $this->client = $client;
        $this->code = $code;
        $this->resetTImer();
        $this->timer();
        $this->isTimerStopped = false;
        $this->resendCode = false;
    }

    public function timer() {
        if($this->seconds == 0) {
            $this->seconds = 59;
            $this->minutes--;
        } else {
            $this->seconds--;
        }

        if($this->minutes == 0 && $this->seconds == 0) {
            $this->isTimerStopped = true;
            $this->resendCode = true;
        }
    }

    public function resetTimer() {
        $this->minutes = 5;
        $this->seconds = 0;
    }

    public function checkTimer() {
        if($this->isTimerStopped) {
            $code = ForgotPasswordCode::find($this->code);
            $code->is_expired = true;
            $code->save();
        } else {
            $this->timer();
        }
    }

    public function sendCode() {
        $client = Client::find($this->client);

        if($client) {
            $code = Helper::generateCode();

            $forgotPassword = ForgotPasswordCode::create([
                'client_id' => $client->id,
                'code' => $code,
            ]);

            $this->id = $forgotPassword->id;
            $this->clientId = $client->id;

            Mail::to($client->email)->send(new ForgotPasswordMail($code));
            $this->resendCode = false;
            $this->resetTimer();
        }
    }


    public function render()
    {
        return view('livewire.code-timer');
    }
}
