<x-app-layout>
    <x-slot name="header">Reports</x-slot>

    <div class="reportsWrapper">
        <form action="{{ route('reports.export') }}" method="POST">
            @csrf
            <div class="dateFilter">
                <x-input type="date" name="start_date" label="Start Date" />
                <x-input type="date" name="end_date" label="End Date" />
            </div>
            <x-button type="submit" name="action" value="PDF">EXPORT TO PDF</x-button>
            <x-button type="submit" name="action" value="excel">EXPORT TO EXCEL</x-button>
        </form>   
    </div>

    <hr>

    <livewire:reports-table />
</x-app-layout>