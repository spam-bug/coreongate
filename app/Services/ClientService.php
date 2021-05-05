<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Client;
use App\Helpers\Helper;
use App\Models\Monitoring;
use App\Models\ClientHasPlan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\NoPlanFoundException;
use App\Exceptions\AlreadyCheckInException;
use App\Exceptions\AlreadyCheckOutException;
use App\Exceptions\ClientNotFoundException;
use App\Exceptions\PlanHasExpiredException;

class ClientService {

    public function check_in($credentials) {

        $client = Client::where('username', '=', $credentials['username'])->first();

        //user doest not exist
        if(!$client) throw new ClientNotFoundException;

        //user exist but incorrect password
        if(!Hash::check($credentials['password'], $client->password)) throw new ClientNotFoundException;


        //client already active
        if($client->active) throw new AlreadyCheckInException;

        $clientHasPlan = ClientHasPlan::current($client->id)->first();

        if(!$clientHasPlan) throw new NoPlanFoundException;

        $client->active = true;
        $client->save();

        Monitoring::create([
            'client_id' => $client->id,
            'check_in' => Carbon::now(),
        ]);

        $currentPlan = Plan::find($clientHasPlan->plan_id);


        //get the plan remaining time
        if($currentPlan->unlimited_time) {
            $remaining_time = "Unlimited Time";
        } else {
            $time = Helper::DecimalSecondsToTime($clientHasPlan->remaining_time);
            $remaining_time = $time['hours'] . ' hrs ' . $time['minutes'] . ' minutes';
        }

        if($currentPlan->no_expiration) {
            $expiration = "No Expiration";
        } else {
            $expiration = date('M d, Y', strtotime($clientHasPlan->end_date));
        }

        return [
            'remaining_time' => $remaining_time,
            'expiration' => $expiration,
        ];
    }


    public function check_out($credentials) {
        $client = Client::where('username', '=', $credentials['username'])->first();

        //user doest not exist
        if(!$client) throw new ClientNotFoundException;

        //user exist but incorrect password
        if(!Hash::check($credentials['password'], $client->password)) throw new ClientNotFoundException;

        //client already check out
        if(!$client->active) throw new AlreadyCheckOutException;

        $clientHasPlan = ClientHasPlan::current($client->id)->first();

        if(!$clientHasPlan) throw new NoPlanFoundException;

        $monitoring = Monitoring::current($client->id);
        $monitoring->check_out = Carbon::now();
        $monitoring->save();

        //compute time consumed
        $check_in = $monitoring->check_in;
        $check_out = $monitoring->check_out;
        $time_consumed = Helper::timeToDecimalSeconds($check_out) - Helper::timeToDecimalSeconds($check_in);
        $clientHasPlan->time_consumed += $time_consumed;


        $plan =  Plan::find($clientHasPlan->plan_id);

        //deduct time consume to remaining time if not unlimited time
        if($plan->unlimited_time == false) {
            $remaining_time = $clientHasPlan->remaining_time - $time_consumed;
            if($remaining_time <= 0) {
                $clientHasPlan->remaining_time = 0;
                $clientHasPlan->is_expired = true;
            } else {
                $clientHasPlan->remaining_time = $remaining_time;
            }
        }

        if($plan->no_expiration == false) {
            //check if current plan has expired
            if(date('Y-m-d') >= date('Y-m-d', strtotime($clientHasPlan->end_date))) {
                $clientHasPlan->is_expired = true;
            }
        }

        $clientHasPlan->save();
        $client->active = false;
        $client->save();

        return;
    }
}
