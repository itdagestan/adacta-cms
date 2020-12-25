@if($paginator->hasMorePages())
<nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Предыдущий</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Следующий</a>
        </li>
    </ul>
</nav>
@endif
