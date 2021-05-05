<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;

class ReportsTable extends Component
{
    public $search = '';

    public function render()
    {

        $clients = Client::query()->search($this->search)->paginate(5);
        
        return view('livewire.reports-table', compact('clients'));
    }
}
