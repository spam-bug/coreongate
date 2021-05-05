<?php

namespace App\Http\Livewire;

use App\Models\Plan;

use App\Models\Client;
use App\Helpers\Helper;
use Livewire\Component;
use App\Mail\TopUpSuccesMail;
use App\Models\ClientHasPlan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class TopUp extends Component
{
    public $search;
    public $clientList;
    public $selectedClient;
    public $selectedPlan;
    public $plan;

    public $voucherUsername;
    public $voucherPassword;

    protected $rules = [
        'voucherUsername' => ['required'],
        'voucherPassword' => ['required']
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function mount() {
        $this->clear();
        $this->getPlan();
        $this->selectedClient = [];
    }

    public function clear() {
        $this->clientList = [];
        $this->search = '';
    }

    public function updatedSearch() {
        $this->clientList = Client::query()->search($this->search)->get();
    }

    public function updatedPlan() {
        $this->getPlan();
    }

    public function getPlan() {
        if(!empty($this->plan)) {
            $this->selectedPlan = Plan::find($this->plan)->toArray();

            if($this->selectedPlan['unlimited_time']) {
                $this->selectedPlan['duration'] = 'Unlimited Time';
            } else {
                $duration = Helper::DecimalSecondsToTime($this->selectedPlan['time']);
                $this->selectedPlan['duration'] = $duration['hours'] . ' hrs ' . $duration['minutes'] . ' mins';
            }

            if($this->selectedPlan['no_expiration']) {
                $this->selectedPlan['expiration_date'] = 'No Expiration'; 
            } else {
                $this->selectedPlan['expiration_date'] = date('M d, Y', strtotime(Carbon::now()->addDays($this->selectedPlan['expiration'])));
            }
        } else {
            $this->selectedPlan = [];
        }
    }

    public function select($id) {
        $this->selectedClient = Client::find($id)->toArray();
        $clientHasPlan = ClientHasPlan::current($this->selectedClient['id'])->first();

        if($clientHasPlan) {
            $currentPlan = Plan::find($clientHasPlan->plan_id);
            $this->selectedClient['current_plan'] = $currentPlan->name;
        } else {
            $this->selectedClient['current_plan'] = 'None';
        }
        
        $this->clear();
    }

    public function addPlanToClient() {
        if($this->selectedClient && $this->selectedPlan) {
            $clientHasPlan = ClientHasPlan::create([
                'client_id' => $this->selectedClient['id'],
                'plan_id' => $this->selectedPlan['id'],
                'remaining_time' => ($this->selectedPlan['time']) ? $this->selectedPlan['time'] : null,
                'time_consumed' => null,
                'end_date' => ($this->selectedPlan['no_expiration']) ? null : Carbon::now()->addDays($this->selectedPlan['expiration']),
            ]);

            if($clientHasPlan) {

                if(!empty($this->voucherUsername) && !empty($this->voucherPassword)) {
                    Mail::to($this->selectedClient['email'])->send(new TopUpSuccesMail([
                        'username' => $this->voucherUsername,
                        'password' => $this->voucherPassword,
                    ]));
                    session()->flash('success', 'Top up success');
                    return redirect(route('client.top_up'));
                } else {
                    session()->flash('error', 'Top up failed');
                    return redirect(route('client.top_up'));
                }
            } else {
                session()->flash('error', 'Top up failed');
                return redirect(route('client.top_up'));
            }
        } else {
            session()->flash('error', 'Please select a client and membership type');
            return redirect(route('client.top_up'));
        }
    }
    

    public function render()
    {
        $planList = Plan::all();
        
        
        return view('livewire.top-up', compact('planList'));
    }
}
