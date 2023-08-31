@extends("shop.layout.master")

@section("title","Favoritos")

@section("css")
    <link rel="stylesheet"	href="{{config('constants.shop_css')}}productCards.css">
@endsection

@section("js")
    <script defer src="{{config('constants.shop_js')}}ajax.js"></script>
    <script defer src="{{config('constants.shop_js')}}eliminaFavorito.js"></script>
@endsection

@section("inlineCSS")
    <style>
        .panel {
            max-width:                      600px;
        }
    </style>
@endsection

@section("body")

    <!-- Contenido de la página -->
    <div class="main-container">

        @if($favoritosItemQty)
            <div class="panel">
                <div class="panel-title panel-title-underlined">Mis favoritos</div>
                <div class="panel-content">
                    <ul class="favourites-list">
                        @foreach($items as $item)
                            <li class="favourite-card">
                                <div><?=$item["descripcion"]?></div>
                                <div class="favourite-card-image"><img src="<?=$item["miniatura_1"]?>" alt="imagen del producto"></div>
                                <div><?=_money($item["precio"])?></div>
                                <div><button class="btn-danger" value="<?=$item["articulo_id"]?>"><span><i class="fa-solid fa-trash"></i></span>Eliminar</button></div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        @else
            <p>No tienes añadido ningún item en la lista de deseos
        @endif

    </div>

@endsection