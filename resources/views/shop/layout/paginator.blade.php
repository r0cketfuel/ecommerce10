<!-- Paginator -->
<div class="paginator-area">
    @if($paginator->hasPages())
        <div class="paginator-links">
            @if($paginator->onFirstPage())
                <div class="paginator-page">{!! __('pagination.previous') !!}</div>
            @else
                <a class="paginator-page" href="{{$paginator->previousPageUrl()}}">{!! __('pagination.previous') !!}</a>
            @endif

            @for($i=1;$i<=$paginator->lastPage();$i++)
                @if($paginator->currentPage()==$i)
                    <div class="paginator-page page-active">{{ $i }}</div>
                @else
                    <a class="paginator-page" href="{{$paginator->url($i)}}">{{ $i }}</a>
                @endif
            @endfor

            @if($paginator->hasMorePages())
                <a class="paginator-page" href="{{$paginator->nextPageUrl()}}">{!! __('pagination.next') !!}</a>
            @else
                <div class="paginator-page">{!! __('pagination.next') !!}</div>
            @endif
        </div>
    @endif
</div>