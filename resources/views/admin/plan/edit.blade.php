<x-app-layout>
    <x-slot name="header">Plans</x-slot>
    <div class="container">
        <form action="{{ route('plan.update', ['id' => $plan->id]) }}" method="POST" class="form planForm" id="planEditForm">
            @csrf
            @method('PATCH')

            <x-input type="text" name="name" label="Plan Name" value="{{ $plan->name }}" />
            <x-textarea name="description" label="Description" value="{{ $plan->description }}"></x-textarea>

            <div class="numberInput">
                <label>Time</label>
                <div class="inputWrapper">
                    <input type="number" name="hours" id="hours" placeholder="HH" min="0" value="{{ (array_key_exists('hours', $time)) ? $time['hours'] : ''}}">
                    <input type="number" name="minutes" id="minutes" placeholder="MM" min="0" value="{{ (array_key_exists('minutes', $time)) ? $time['minutes'] : ''}}">

                    <div class="checkbox">
                        <input type="checkbox" name="unlimited_time" id="unlimitedTime" {{ ($plan->unlimited_time) ? 'checked="checked"' : '' }}>
                        <p>Unlimited Time</p>
                    </div>
                </div>
                @if($errors->has('hours'))
                    @error('hours') <p class="error">{{ $message }}</p> @enderror
                @else
                    @error('minutes') <p class="error">{{ $message }}</p> @enderror
                @endif
            </div>

            <div class="numberInput">
                <label>Expiration</label>
                <div class="inputWrapper">
                    <input type="number" name="expiration" id="expiration" placeholder="DD" value="{{ $plan->expiration }}">

                    <div class="checkbox">
                        <input type="checkbox" name="no_expiration" id="noExpiration" {{ ($plan->no_expiration) ? 'checked="checked"' : '' }}>
                        <p>No Expiration</p>
                    </div>
                </div>
                @error('expiration') <p class="error">{{ $message }}</p> @enderror
            </div>

            <x-button type="submit">save</x-button>
        </form>
        <livewire:plan-table />
    </div>
</x-app-layout>
