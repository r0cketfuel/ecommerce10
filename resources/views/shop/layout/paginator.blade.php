@if($paginator->hasPages())
    <div class="paginator-area">
        <div class="paginator-links">
            @if($paginator->onFirstPage())
                <div class="paginator-page"><i class="fa-solid fa-chevron-left fa-xs">&nbsp;</i>{!! __('pagination.previous') !!}</div>
            @else
                <a class="paginator-page" href="{{$paginator->previousPageUrl()}}"><i class="fa-solid fa-chevron-left fa-xs"></i>&nbsp;{!! __('pagination.previous') !!}</a>
            @endif

            @for($i=1;$i<=$paginator->lastPage();$i++)
                @if($paginator->currentPage()==$i)
                    <div class="paginator-page page-active">{{ $i }}</div>
                @else
                    <a class="paginator-page" href="{{$paginator->url($i)}}">{{ $i }}</a>
                @endif
            @endfor

            @if($paginator->hasMorePages())
                <a class="paginator-page" href="{{$paginator->nextPageUrl()}}">{!! __('pagination.next') !!}&nbsp;<i class="fa-solid fa-chevron-right fa-xs"></i></a>
            @else
                <div class="paginator-page">{!! __('pagination.next') !!}&nbsp;<i class="fa-solid fa-chevron-right fa-xs"></i></div>
            @endif
        </div>
    </div>
@endif