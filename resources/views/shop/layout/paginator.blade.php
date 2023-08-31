<!-- Paginator -->
<div class="paginator-area">
    @if($paginator->hasPages())
        <div class="paginator-links">
            @if($paginator->onFirstPage())
                <div class="paginator-page">&lt; Anterior</div>
            @else
                <a class="paginator-page" href="{{$paginator->previousPageUrl()}}">&lt; Anterior</a>
            @endif

            @for($i=1;$i<=$paginator->lastPage();$i++)
                @if($paginator->currentPage()==$i)
                    <div class="paginator-page page-active">{{$i}}</div>
                @else
                    <a class="paginator-page" href="{{$paginator->url($i)}}">{{$i}}</a>
                @endif
            @endfor

            @if($paginator->hasMorePages())
                <a class="paginator-page" href="{{$paginator->nextPageUrl()}}">Siguiente &gt;</a>
            @else
                <div class="paginator-page">Siguiente &gt;</div>
            @endif
        </div>
    @endif
</div>