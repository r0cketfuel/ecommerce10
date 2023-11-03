@extends("shop.layout.master")

@section("title","Favoritos")

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}productCards.css">
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}breadcrumb.css">
@endsection

@section("js")
    <script defer src="{{config('constants.shop_js')}}ajax.js"></script>
    <script defer src="{{config('constants.shop_js')}}eliminaFavorito.js"></script>
@endsection

@section("body")

    <!-- Contenido de la página -->
    <div class="main-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/shop">Home</a> > Favoritos
        </div>

        @if($favoritosItemQty)
            <ul class="favourites-list">
                @foreach($items as $item)
                    <li class="favourite-card">
                        <div>{{ $item["descripcion"] }}</div>
                        <div class="favourite-card-image">
                            @if ($item->imagenes->isNotEmpty())
                                <img loading="lazy" src="{{ $item->imagenes[0]->ruta }}" alt="{{ $item->imagenes[0]->descripcion }}">
                            @else
                                <img loading="lazy" src="{{ asset('images/content/no-image.png') }}" alt="imagen">
                            @endif
                        </div>
                        <div>{{ $item["precio"] }}</div>
                        <div><button class="btn-danger" value="{{ $item['articulo_id'] }}"><span><i class="fa-solid fa-trash"></i></span>Eliminar</button></div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No tienes añadido ningún item en la lista de deseos
        @endif

    </div>

@endsection