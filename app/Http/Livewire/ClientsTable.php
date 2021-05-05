<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Carbon\Carbon;
use Livewire\Component;

class ClientsTable extends Component
{
    public $search = '';


    public function render()
    {
        $clients = Client::query()->search($this->search)->paginate(5);

        return view('livewire.clients-table', compact('clients'));
    }
}
