<div class="tableWrapper planTableWrapper">
    <div class="searchBar">
        <input type="text" wire:model="search" placeholder="Search plan..." class="searchInput">
        <button class="searchBtn"><i class="fas fa-search"></i></button>
    </div>

    <table class="table" id="planTable">
        <thead>
            <tr class="row">
                <th class="header">Name</th>
                <th class="header">Created At</th>
                <th class="header">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($plans->count() > 0)
                @foreach($plans as $plan)
                    <tr class="row">
                        <td class="column">{{ $plan->name }}</td>
                        <td class="column">{{ date('M d, Y', strtotime($plan->created_at)) }}</td>
                        <td class="column">
                            <div class="action">
                                <a href="{{ route('plan.edit', ['id' => $plan->id]) }}"><i class="fas fa-edit edit"></i></a>
                                <form action="{{ route('plan.delete', ['id' => $plan->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <a href="#" 
                                        onclick="event.preventDefault();
                                        if (confirm('Are you sure you want to delete {{ $plan->name }} ?') == true) {
                                            this.closest('form').submit();
                                        }"
                                    ><i class="fas fa-trash trash"></i></a>     
                                </form>
                            </div> 
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="row">
                    <td class="column" colspan="3" style="text-align:center;">No plan found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div>
        {{ $plans->links('layouts.pagination') }}
    </div>
</div>
