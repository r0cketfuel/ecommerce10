@extends("shop.layout.master")

@section("title","Inicio")

@section("css")
    <link rel="stylesheet"	href="{{config('constants.shop_css')}}carousel.css">
    <link rel="stylesheet"	href="{{config('constants.shop_css')}}productCards.css">
    <link rel="stylesheet"	href="{{config('constants.shop_css')}}newsletter.css">
@endsection

@section("js")
    <script defer src="{{config('constants.shop_js')}}carousel.js"></script>
    <script defer src="{{config('constants.shop_js')}}cart.js"></script>
    <script defer src="{{config('constants.shop_js')}}cardSort.js"></script>
    <script defer src="{{config('constants.shop_js')}}ajaxFavoritos.js"></script>
	<script defer src="{{config('constants.shop_js')}}ajaxSuscribe.js"></script>
@endsection

@section("body")

    @include("shop.layout.modals.addItem")

    <!-- Contenido de la página -->
    <div class="main-container">

        <!-- Banners promocionales -->
        @include("shop.layout.banners")

        <!-- Barra superior de búsqueda -->
        <div class="flex justify-between align-center">
            <div><span class="text-bold">Mostrando: </span>{{$busqueda["titulo"]}}</div>
            <div>
                <select id="sortBy">
                    <option value="" disabled selected>Ordenar...</option>
                    <option value="1">Menor precio</option>
                    <option value="2">Mayor precio</option>
                </select>
            </div>
        </div>
        <!-- /Barra superior de búsqueda -->
        
        <!-- Items -->
        <ul class="product-list">
            @foreach ($items as $item)
            <li class="product-card">
                    <div class="product-card-image">
                        @if ($item['foto_1'])
                            <img loading="lazy" src="{{config('constants.product_images')}}/{{$item->id}}/thumbs/{{$item->foto_1}}" alt="imagen">
                        @else
                            <img loading="lazy" src="{{config('constants.product_images')}}/no-image.png" alt="imagen">
                        @endif
                    </div>
                    <div class="product-card-extra">
                        <ul>
                            @auth
                                <li data-value="{{$item->id}}">
                                    <i class="fa-solid fa-heart fa-lg"></i>
                                </li>
                            @endauth
                            <li>
                                <a href="shop/item/{{$item->id}}">
                                    <i class="fa-solid fa-circle-info fa-lg"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-card-info">
                        <div>
                            <div>{{$item->nombre}}</div>
                            <div>{{$item->descripcion}}</div>
                        </div>
                        <div class="precio">{{_money($item->precio)}}</div>
                    </div>
                    <div class="product-card-cart">
                        <button class="btn-primary btn-rounded" value="{{$item->id}}"><span><i class="fa-solid fa-cart-plus"></i></span>Agregar al carrito</button>
                    </div>
                </li>
                @endforeach
            </ul>
            <!-- /Items -->

        <!-- Paginador -->
        {{$items->links("shop.layout.paginator")}}

    </div>
    
    <!-- Newsletter -->
    @include("shop.layout.newsletter")

@endsection