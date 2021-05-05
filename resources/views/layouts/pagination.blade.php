@if($paginator->hasPages())
<div class="paginationWrapper">
    <p class="text">Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} out of {{ $paginator->total() }} items</p>

    <div class="pagination">
        @if ($paginator->onFirstPage())
            <span aria-hidden="true" class="links disabled">Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="links">Prev</a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="links">Next</a>
        @else
            <span aria-hidden="true" class="links disabled">Next</span>
        @endif
    </div>
</div>
@endif()