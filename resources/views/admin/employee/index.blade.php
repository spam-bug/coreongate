<x-app-layout>
    <x-slot name="header">Employee</x-slot>

    <div class="container">
        <form action="{{ route('employee.store') }}" method="POST" class="form planForm">
            @csrf

            <x-input type="text" name="name" label="Name" value="{{ old('name') }}" />
            <x-input type="text" name="username" label="Username" value="{{ old('username') }}" />
            <x-input type="password" name="password" label="Password" />
            <x-input type="password" name="password_confirmation" label="Confirm Password" />
            <x-button type="submit">Create</x-button>
        </form>

        <livewire:employee-table />
    </div>
</x-app-layout>