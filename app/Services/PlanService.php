<?php

namespace App\Services;

use App\Models\Plan;

class PlanService {

    public function create($plan) {
        if(!isset($plan->unlimited_time)) {
            $planInitialTime = ($plan->hours * 3600) + ($plan->minutes * 60);
            $unlimited_time = false;
        } else {
            $planInitialTime = null;
            $unlimited_time = true;
        }

        if(!isset($plan->no_expiration)) {
            $no_expiration = false;
            $expiration = $plan->expiration;
        } else {
            $no_expiration = true;
            $expiration = null;
        }

        $plan = Plan::create([
            'name' => $plan->name,
            'description' => $plan->description,
            'unlimited_time' => $unlimited_time,
            'time' => $planInitialTime,
            'no_expiration' => $no_expiration,
            'expiration' => $expiration,
        ]);

        if(!$plan->id) {
            throw new \Exception('Something went wrong. Please try again.');
        }

        return $plan;
    }
}