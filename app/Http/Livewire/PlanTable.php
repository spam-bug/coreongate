<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use Livewire\Component;

class PlanTable extends Component
{
    public $search = '';
    
    public function render()
    {
        $plans = Plan::query()->search($this->search)->paginate(10);
        return view('livewire.plan-table', compact('plans'));
    }
}
