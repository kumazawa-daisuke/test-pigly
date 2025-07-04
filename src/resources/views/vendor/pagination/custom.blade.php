@if ($paginator->hasPages())
<ul class="pagination">
    {{-- 前 --}}
    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><span class="page-link">‹</span></li>
    @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">‹</a>
        </li>
    @endif

    {{-- 数字 --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item-active">
                        <span class="page-link-active">{{ $page }}</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- 次 --}}
    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">›</a>
        </li>
    @else
        <li class="page-item disabled"><span class="page-link">›</span></li>
    @endif
</ul>
@endif