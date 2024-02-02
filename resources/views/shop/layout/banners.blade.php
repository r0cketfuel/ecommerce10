<div class="slideshow">
    @for($i = 0; $i < count($banners); $i++)
        <div class="slide">
            @if($banners[$i]['link'] != "")
                <a href="shop/banners/{{ $banners[$i]['link'] }}">
                    <img src="{{ $banners[$i]['imagen'] }}" alt="imagen">
                </a>
            @else
                <img src="{{ $banners[$i]['imagen'] }}" alt="imagen">
            @endif
        </div>
    @endfor
    <button class="btn btn-next"><i class="fa-solid fa-chevron-right"></i></button>
    <button class="btn btn-prev"><i class="fa-solid fa-chevron-left"></i></button>
</div>