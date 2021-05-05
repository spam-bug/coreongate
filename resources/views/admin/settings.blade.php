<x-app-layout>
    <x-slot name="header">Settings</x-slot>

    <div class="container">
        <a href="{{ route('plan.index') }}" class="settings">
            <i class="fas fa-address-card"></i>
            <span>Plan</span>
        </a>

        <a href="{{ route('employee.index') }}" class="settings">
            <i class="fas fa-users"></i>
            <span>Employee</span>
        </a>

        <a href="{{ route('reports.index') }}" class="settings">
            <i class="fas fa-chart-pie"></i>
            <span>Reports</span>
        </a>

        <a href="{{ route('ads.index') }}" class="settings">
            <i class="fas fa-ad"></i>
            <span>Advertisements</span>
        </a>
    </div>
</x-app-layout>
