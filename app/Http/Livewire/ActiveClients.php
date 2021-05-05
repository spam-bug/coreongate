<?php

namespace App\Http\Livewire;

use DateTime;
use App\Models\Plan;
use App\Models\Client;
use App\Helpers\Helper;
use Livewire\Component;
use App\Models\Monitoring;
use App\Models\ClientHasPlan;
use Illuminate\Support\Carbon;
use PHPUnit\TextUI\Help;

class ActiveClients extends Component
{
    public $clients;

    public $plan;

    public function mount() {
        $this->resetClient();

        $this->getActiveClients();
    }

    public function resetClient() {
        $this->clients = [];
    }

    public function getActiveClients() {
        $this->resetClient();

        //Get all current active clients
        $clients = Client::where('active', true)->get();

        if(!$clients->count()) return;

        foreach($clients as $client) {

            if($this->planIsExpired($client->id)) {
                $this->check_out($client->id);
                continue;
            }

            $check_in_time = $client->monitoring->last()->check_in;
//            ($client->plan->last()->no_expiration) ?  'No Expiration' : date('M d, Y', strtotime($client->plan->last()->pivot->end_date))
            array_push($this->clients, [
                'id' => $client->id,
                'name' => ucfirst($client->first_name) . ' ' . ucfirst($client->last_name),
                'username' => $client->username,
                'plan' => $client->plan->last()->name,
                'check_in' => $check_in_time,
                'time_consumed' => $this->getTimeConsumed($check_in_time),
                'expiration' => $client->plan->last()->pivot->time_consumed . ' ' . $client->plan->last()->pivot->remaining_time,
            ]);
        }


    }

    private function getTimeConsumed($check_in_time) {
        $check_in_time = new DateTime($check_in_time);
        $current_time = new DateTime('now');
        $time_consumed = $check_in_time->diff($current_time);

        if($time_consumed->d == 1) {
            $time_consumed = $time_consumed->d . ' day ' .$time_consumed->h . ' hrs ' . $time_consumed->i . ' mins ' . $time_consumed->s . ' secs';
        } elseif($time_consumed->d > 1) {
            $time_consumed = $time_consumed->d . ' days ' .$time_consumed->h . ' hrs ' . $time_consumed->i . ' mins ' . $time_consumed->s . ' secs';
        } else {
            $time_consumed = $time_consumed->h . ' hrs ' . $time_consumed->i . ' mins ' . $time_consumed->s . ' secs';
        }

        return $time_consumed;
    }

    private function getCurrentTimeConsumed($check_in_time) {
        return Helper::timeToDecimalSeconds(date('H:i:s')) - Helper::timeToDecimalSeconds($check_in_time);
    }

    private function planIsExpired($client_id) {
        $client = Client::find($client_id);

        $current_time_consumed = Helper::timeToDecimalSeconds(date('H:i:s')) - Helper::timeToDecimalSeconds($client->monitoring->last()->check_in);

        $client_has_plan = ClientHasPlan::current($client->id)->first();
        $client_has_plan->time_consumed = $current_time_consumed;

        //check current plan if unlimited time
        if(!$client->plan->last()->unlimited_time) {
            if($client_has_plan->time_consumed > $client_has_plan->remaining_time) {
                $client_has_plan->remaining_time = 0;
                $client_has_plan->is_expired = true;
            }
        }

        if(!$client->plan->last()->no_expiration) {
            if(date('Y-m-d') >= date('Y-m-d', strtotime($client_has_plan->end_date))) {
                $client_has_plan->is_expired = true;
            }
        }

        $client_has_plan->save();

        if($client_has_plan->is_expired) return true;

        return false;

    }


    public function check_out($client_id) {
        $client = Client::find($client_id);
        //set client to inactive and logout
        $client->active = false;
        $client->save();

        $monitoring = Monitoring::current($client_id);
        $monitoring->check_out = Carbon::now();
        $monitoring->save();

        $client_has_plan = ClientHasPlan::current($client->id)->first();
        //check if employee force check out client
        if($client_has_plan) {
            if($client_has_plan->remaining_time != 0) {
                //time consumed computation
                $check_in = $monitoring->check_in;
                $check_out = $monitoring->check_out;
                $time_consumed = Helper::timeToDecimalSeconds($check_out) - Helper::timeToDecimalSeconds($check_in);
                $client_has_plan->time_consumed += $time_consumed;

                //updating time remaining
                if(!$client->plan->last()->unlimited_time) {
                    $remaining_time = $client_has_plan->remaining_time - $time_consumed;
                    if($client_has_plan->remaining_time <= 0) {
                        $client_has_plan->remaining_time = 0;
                        $client_has_plan->is_expired = true;
                    } else {
                        $client_has_plan->remaining_time = $remaining_time;
                    }
                }

                $client_has_plan->save();
            }
        }

        return;
    }

    public function render()
    {
        return view('livewire.active-clients');
    }
}
