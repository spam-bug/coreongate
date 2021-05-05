<div id="topupForm">
    
    <div id="clientSearch">
        <input type="text" wire:model="search" placeholder="Search client...">
        <div id="searchHint">
           @if(!empty($clientList))
                @foreach($clientList as $client)
                    <p wire:click="select({{ $client->id }})">{{ ucfirst($client->first_name) }} {{ ucfirst($client->last_name) }}</p>
                @endforeach
           @endif
        </div>
    </div>
{{-- {{dd($selectedClient)}} --}}
    <div id="infoWrapper">
        <section>
            <header>Client Information</header>
            <div class="info">
                <div class="labels">
                    <p class="label">Name</p>
                    <p class="label">Email</p>
                    <p class="label">Contact Number</p>
                    <p class="label">Address</p>
                    <p class="label">Birthday</p>
                    <p class="label">Current Plan</p>
                    
                </div>
                <div class="data">
                    <p class="text">{{ ($selectedClient) ? ucfirst($selectedClient['first_name']) . ' ' . ucfirst($selectedClient['last_name']) : '' }}</p>
                    <p class="text">{{ ($selectedClient) ? $selectedClient['email'] : '' }}</p>
                    <p class="text">{{ ($selectedClient) ? $selectedClient['contact_number'] : '' }}</p>
                    <p class="text">{{ ($selectedClient) ? $selectedClient['address'] : '' }}</p>
                    <p class="text">{{($selectedClient) ?  date('M d, Y', strtotime($selectedClient['birthday'])) : '' }}</p>
                    <p class="text">{{ ($selectedClient) ? $selectedClient['current_plan'] : '' }}</p>
                    
                </div>
            </div>

            {{-- <div class="input">
                <p class="label">Choose Plan</p>
                <select wire:model="plan" name="plan" id="planSelect">
                    @if($planList->count() > 0)
                        <option value="" selected>Select Plan</option>
                        @foreach($planList as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                        @endforeach
                    @else
                        <option selected disabled>No Membership Found</option>
                    @endif
                </select>
            </div> --}}
        
        <section>
            <div id="choosePlan">
                <header>Choose Plan</header>
                <select wire:model="plan" name="plan" id="planSelect">
                    @if($planList->count() > 0)
                        <option value="" selected>Select Plan</option>
                        @foreach($planList as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                        @endforeach
                    @else
                        <option selected disabled>No Membership Found</option>
                    @endif
                </select>
            </div>
            @if($selectedPlan)
                <div class="planInfoWrapper">
                    <div class="info">
                        <div class="labels">
                            <p class="label">Name</p>
                            <p class="label">Duration</p>
                            <p class="label">Expiration</p>
                        </div>
                        <div class="data">
                            <p class="text">{{ ($selectedPlan) ? $selectedPlan['name'] : '' }}</p>
                            <p class="text">{{ ($selectedPlan) ? $selectedPlan['duration'] : '' }}</p>
                            <p class="text">{{ ($selectedPlan) ? $selectedPlan['expiration_date'] : '' }}</p>
                        </div>
                    </div>
                    <div class="voucher">
                        <x-input type="text" name="voucherUsername" wire:model="voucherUsername" label="Voucher Username" />
                        <x-input type="text" name="voucherPassword" wire:model="voucherPassword" label="Voucher Password    " />
                    </div>
                </div>
            @endif
        </section>
    </div>

    @if($selectedClient && $selectedPlan && $selectedClient['current_plan'] === 'None')
        <form wire:submit.prevent="addPlanToClient">
            <x-button class="topUpBtn" type="submit">Top Up</x-button>
        </form>
    @else
        <x-button class="topUpBtn" disabled>Top Up</x-button>
    @endif
</div>
