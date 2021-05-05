<x-app-layout>
    <x-slot name="header">Employee</x-slot>

    <div class="container">
        <form action="{{ route('employee.update', ['id' =>$employee->id]) }}" method="POST" class="form planForm" id="planEditForm">
            @csrf
            @method('PATCH')

            <x-input type="text" name="name" label="Name" value="{{ $employee->name }}" />
            <x-input type="text" name="username" label="Username" value="{{ $employee->username }}" />
            <x-input type="password" name="password" label="Password" />
            <x-input type="password" name="password_confirmation" label="Confirm Password" />
            <x-button type="submit">save</x-button>
        </form>
        
        <livewire:employee-table />
    </div>
</x-app-layout>