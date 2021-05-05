<x-app-layout>
    <x-slot name="header">Plans</x-slot>

    <div class="container">
        <form action="{{ route('plan.store') }}" method="POST" class="form planForm">
            @csrf

            <x-input type="text" name="name" label="Plan Name" value="{{ old('name') }}" />
            <x-textarea name="description" label="Description" value="{{ old('description') }}"></x-textarea>

            <div class="numberInput">
                <label>Time</label>
                <div class="inputWrapper">
                    <input type="number" name="hours" id="hours" placeholder="HH" min="0" value="{{ old('hours') }}">
                    <input type="number" name="minutes" id="minutes" placeholder="MM" min="0" value="{{ old('minutes') }}">

                    <div class="checkbox">
                        <input type="checkbox" name="unlimited_time" id="unlimitedTime">
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
                    <input type="number" name="expiration" id="expiration" placeholder="DD" value="{{ old('expiration') }}">

                    <div class="checkbox">
                        <input type="checkbox" name="no_expiration" id="noExpiration">
                        <p>No Expiration</p>
                    </div>
                </div>
                @error('expiration') <p class="error">{{ $message }}</p> @enderror
            </div>

            <x-button type="submit">Create</x-button>
        </form>

        <livewire:plan-table />
    </div>

</x-app-layout>
