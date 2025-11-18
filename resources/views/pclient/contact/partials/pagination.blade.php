@if($contacts->hasPages())
<div class="dt-paging paging_simple_numbers">
    <nav aria-label="paginação">
        <ul class="pagination">
            @if($contacts->onFirstPage())
                <li class="dt-paging-button page-item disabled">
                    <button class="page-link previous" disabled>‹</button>
                </li>
            @else
                <li class="dt-paging-button page-item">
                    <a href="{{ $contacts->previousPageUrl() }}" class="page-link previous" data-page="{{ $contacts->currentPage() - 1 }}">‹</a>
                </li>
            @endif

            @foreach($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
                <li class="dt-paging-button page-item {{ $page == $contacts->currentPage() ? 'active' : '' }}">
                    <a href="{{ $url }}" class="page-link" data-page="{{ $page }}">{{ $page }}</a>
                </li>
            @endforeach

            @if($contacts->hasMorePages())
                <li class="dt-paging-button page-item">
                    <a href="{{ $contacts->nextPageUrl() }}" class="page-link next" data-page="{{ $contacts->currentPage() + 1 }}">›</a>
                </li>
            @else
                <li class="dt-paging-button page-item disabled">
                    <button class="page-link next" disabled>›</button>
                </li>
            @endif
        </ul>
    </nav>
</div>
@else
<div class="text-muted text-center">
    <small>Nenhuma paginação necessária</small>
</div>
@endif
