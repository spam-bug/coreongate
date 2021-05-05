<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <div class="counterWrapper">
        <livewire:active-client-counter/>
        <livewire:registered-client-counter/>
    </div>

    <hr>

    <livewire:active-clients/>
</x-app-layout>