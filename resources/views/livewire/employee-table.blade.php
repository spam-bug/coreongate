<div class="tableWrapper planTableWrapper">
    <div class="searchBar">
        <input type="text" wire:model="search" placeholder="Search employee..." class="searchInput">
        <button class="searchBtn"><i class="fas fa-search"></i></button>
    </div>

    <table class="table" id="planTable">
        <thead>
            <tr class="row">
                <th class="header">Name</th>
                <th class="header">Username</th>
                <th class="header">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($employees->count() > 0)
                @foreach($employees as $employee)
                    @if($employee->roles[0]->name != 'Admin')
                        <tr class="row">
                            <td class="column">{{ $employee->name }}</td>
                            <td class="column">{{ $employee->username }}</td>
                            <td class="column">
                                <div class="action">
                                    <a href="{{ route('employee.edit', ['id' => $employee->id]) }}"><i class="fas fa-edit edit"></i></a>
                                    <form action="{{ route('employee.delete', ['id' => $employee->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <a href="#" 
                                            onclick="event.preventDefault();
                                            if (confirm('Are you sure you want to delete {{ $employee->name }} ?') == true) {
                                                this.closest('form').submit();
                                            }"
                                        ><i class="fas fa-trash trash"></i></a>     
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @else
                        <tr class="row">
                            <td class="column" colspan="3" style="text-align:center;">No employee found</td>
                        </tr>
                    @endif
                @endforeach
            @else
                <tr class="row">
                    <td class="column" colspan="3" style="text-align:center;">No employee found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div>
        {{ $employees->links('layouts.pagination') }}
    </div>
</div>
