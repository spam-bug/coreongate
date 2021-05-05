<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Helpers\Helper;
use App\Services\PlanService;
use App\Http\Requests\PlanRequest;

class PlanController extends Controller
{
    public function index() {
        return view('admin.plan.index');
    }

    public function store(PlanRequest $request, PlanService $planService) {
        try {
            $plan = $planService->create($request);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->back()->with('success', $plan->name . ' has been created.');
    }

    public function edit($id) {
        $plan = Plan::find($id);

        if($plan) {
            $time = Helper::DecimalSecondsToTime($plan->time);

            return view('admin.plan.edit', [
                'plan' => $plan,
                'time' => $time,
            ]);
        }

        return redirect()->back()->with('error', 'Plan not found');
    }

    public function update(PlanRequest $request, $id) {
        $plan = Plan::find($id);

        if(!isset($request->unlimited_time)) {
            $time = ($request->hours * 3600) + ($request->minutes * 60);
            $unlimited_time = false;
        } else {
            $time = null;
            $unlimited_time = true;
        }

        if(!isset($request->no_expiration)) {
            $expiration = $request->expiration;
            $no_expiration = false;
        } else {
            $expiration = null;
            $no_expiration = true;
        }



        if($plan) {
            $plan->name = $request->name;
            $plan->description = $request->description;
            $plan->time = $time;
            $plan->unlimited_time = $unlimited_time;
            $plan->expiration = $expiration;
            $plan->no_expiration = $no_expiration;

            if($plan->save()) {
                return redirect()->route('plan.index')->with('success', 'Update success');
            } else {
                return redirect()->back()->with('error', 'Failed to update plan');
            }
        } else {
            return redirect()->route('plan.index')->back()->with('error', 'Plan not found');
        }
    }

    public function delete($id) {
        try {
            $plan = Plan::find($id);

            if($plan) {
                Plan::destroy($plan->id);
                return redirect()->back()->with('success', 'Plan has been deleted');
            }

            return redirect()->route('plan.index')->back()->with('error', 'Plan not found');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Failed to delete plan');
        }
    }
}
