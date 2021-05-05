<div class="tableWrapper clientsTableWrapper">
    <div class="searchBar">
        <input type="text" wire:model="search" placeholder="Search client..." class="searchInput">
        <button class="searchBtn"><i class="fas fa-search"></i></button>
    </div>

    <table class="table" id="clientsTable">
        <thead>
            <tr class="row">
                <th class="header">Client #</th>
                <th class="header">Name</th>
                <th class="header">Username</th>
                <th class="header">Email</th>
                <th class="header">Current Plan</th>
                <th class="header">Expiration</th>
                <th class="header">Created at</th>
                <th class="header">Activity</th>
            </tr>
        </thead>
        <tbody>
            @if($clients->count() > 0)
                @foreach($clients as $client)
                    
                    <tr class="row">
                        <td class="column">{{ $client->id }}</td>
                        <td class="column">{{ ucfirst($client->first_name) }} {{ ucfirst($client->last_name) }}</td>
                        <td class="column">{{ $client->username }}</td>
                        <td class="column">{{ $client->email }}</td>
                        <td class="column">{{ ($client->plan->first()) ? $client->plan->first()->name : 'No current plan' }}</td>
                        <td class="column">{{ ($client->plan->first() && $client->plan->first()->pivot->end_date) ? date('M d, Y', strtotime($client->plan->first()->pivot->end_date)) : 'No Expiration' }}</td>
                        <td class="column">{{ date('M d, Y', strtotime($client->created_at)) }}</td>
                        @if($client->monitoring->count() > 0)
                            <td class="column">{{ ($client->monitoring->last()->check_out) ? \Carbon\Carbon::parse(strtotime($client->monitoring->last()->check_out))->diffForHumans() : 'Online' }}</td>
                        @else
                            <td class="column">N/A</td>    
                        @endif
                    </tr>
                @endforeach
            @else
                <tr class="row">
                    <td class="column" colspan="8" style="text-align:center;">No client found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div>
        {{ $clients->links('layouts.pagination') }}
    </div>
</div>
