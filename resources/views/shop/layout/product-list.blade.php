<ul class="product-list">
    @foreach ($items as $item)
    <li class="product-card">
    <div class="product-card-image">
    @if ($item->imagenes->isNotEmpty())
        @foreach ($item->imagenes as $imagen)
            <img loading="lazy" src="{{ $imagen->ruta }}" alt="{{ $imagen->nombre }}">
        @endforeach
    @else
        <img loading="lazy" src="{{ asset('images/content/no-image.png') }}" alt="imagen">
    @endif
</div>
        <div class="product-card-extra">
            <ul>
                @auth
                <li data-value="{{ $item->id }}">
                    <i class="fa-solid fa-heart fa-lg"></i>
                </li>
                @endauth
                <li>
                    <a href="shop/item/{{ $item->id }}">
                        <i class="fa-solid fa-circle-info fa-lg"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="product-card-info">
            <div>
                <div>{{ $item->nombre }}</div>
                <div>{{ $item->descripcion }}</div>
            </div>
            <div class="precio">{{ _money($item->precio) }}</div>
        </div>
        <div class="product-card-cart">
            <button class="btn-primary btn-rounded" value="{{ $item->id }}"><span><i class="fa-solid fa-cart-plus"></i></span>{{ __('buttons.addToCart') }}</button>
        </div>
    </li>
    @endforeach
</ul>