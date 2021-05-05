<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employee;

class EmployeeTable extends Component
{
    public $search = '';

    public function render()
    {
        $employees = Employee::query()->search($this->search)->paginate(5);
        return view('livewire.employee-table', compact('employees'));
    }
}
