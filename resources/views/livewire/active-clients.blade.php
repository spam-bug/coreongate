<div wire:poll.1000ms="getActiveClients" class="clientCardWrapper">

    {{-- {{ dd($clients) }} --}}
    @if(!empty($clients))
        @foreach($clients as $client)
            <div class="activeClientCard">
                <div class="header">
                    <h1 class="name">{{ ucfirst($client['name']) }}</h1>
                    <span wire:click="check_out({{ $client['id'] }})" class="checkOut">X</span>
                </div>
                <div class="credentials">
                    <div class="labels">
                        <p>Username</p>
                        <p>Membership</p>
                        <p>Check In</p>
                        <p>Time Consumed</p>
                        <p>Expiration</p>
                    </div>
                    <div class="data">
                        <p>{{ $client['username'] }}</p>
                        <p>{{ $client['plan'] }}</p>
                        <p>{{ $client['check_in'] }}</p>
                        <p>{{ $client['time_consumed'] }}</p>
                        <p>{{ $client['expiration'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="noClient">
            <p>No Active Client</p>
        </div>
    @endif
</div>
