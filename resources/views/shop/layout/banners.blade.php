<div class="slideshow">
    @for($i=0;$i<count($banners);$i++)
        <div class="slide">
            <a href="shop/banners/{{ $banners[$i]['link'] }}">
                <img src="{{ $banners[$i]['imagen'] }}" alt="imagen">
            </a>
        </div>
    @endfor
    <button class="btn btn-next">&gt;</button>
    <button class="btn btn-prev">&lt;</button>
</div>