@extends("shop.layout.master")

@php
    $title = $item->nombre;
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.shop_css')}}carousel.css">
    <link rel="stylesheet"	href="{{config('constants.shop_css')}}tiles.css">
    <link rel="stylesheet"	href="{{config('constants.shop_css')}}productRating.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}tabs.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}modal.css">
@endsection

@section("js")
    <script defer src="{{config('constants.shop_js')}}tiles.js"></script>
    <script defer src="{{config('constants.shop_js')}}tabs.js"></script>
    <script defer src="{{config('constants.shop_js')}}cart.js"></script>
@endsection

@section("body")

    @auth
        @include("shop.layout.modals.addReview")
    @endauth

    <!-- Contenido de la página -->
    <div class="main-container">
        <!-- Grid -->
        <div class="grid grid-cols-12 grid-align-start">
            <!-- Mosaicos -->
            <div class="col-span-7 col-span-900p-12">
                <div class="product-tile">
                    <div class="tiles-container">
                        <div class="tile active">
                            <img src="{{$item->miniatura_1}}" alt="miniatura_1">
                        </div>
                        <div class="tile main">
                            <a href="{{$item->foto_1}}">
                                <img id="image" src="{{$item->miniatura_1}}" alt="vista_previa">
                            </a>
                            <button class="btn btn-next">&gt;</button>
                            <button class="btn btn-prev">&lt;</button>
                        </div>
                        <div class="tile">
                            <img src="{{$item->miniatura_2}}" alt="miniatura_2">
                        </div>
                        <div class="tile">
                            <img src="{{$item->miniatura_3}}" alt="miniatura_3">
                        </div>
                        <div class="tile">
                            <img src="{{$item->miniatura_4}}" alt="miniatura_4">
                        </div>
                        <div class="tile">
                            <img src="{{$item->miniatura_5}}" alt="miniatura_5">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Mosaicos -->

            <!-- Panel info -->
            <div class="col-span-5 col-span-900p-12">
                <div class="tile-info">
                    <div>
                        <h1>{{$item->nombre}}</h1>
                        <h2>{{$item->descripcion}}</h2>
                    </div>

                    @include("shop.layout.rating")

                        <!-- Precio -->
                        <div class="flex justify-between align-center">
                            <div>Precio:</div>
                            <div id="precio">-</div>
                        </div>
                        <!-- /Precio -->

                        <!-- Atributo Tamaño -->
                        <div style="display: flex; justify-content: space-between; align-items: center; height: 38px;">
                            <p>Tamaño:</p>
                            <div style="display: flex;">
                                <select id="sizes" class="attribute"></select>
                            </div>
                        </div>
                        
                        <!-- Atributo Color -->
                        <div style="display: flex; justify-content: space-between; align-items: center; height: 38px;">
                            <p>Color:</p>
                            <div style="display: flex;">
                                <select id="colors" class="attribute"></select>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; height: 38px;">
                            <p>Stock disponible:</p>
                            <p id="stock">-</p>
                        </div>
                        
                        <!-- Cantidad -->
                        <div id="qtyControl" class="flex justify-between align-center">
                            <div>Cantidad:</div>
                            <div style="display: flex; max-width: 120px;">
                                <button id="minusButton"><i class="fa-solid fa-minus"></i></button>
                                <input 	id="addToCartQty" type="number" disabled>
                                <button id="plusButton"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>

                        <!-- Subtotal -->
                        <div style="display: flex; justify-content: space-between; align-items: center; height: 38px;">
                            <p>Subtotal:</p>
                            <p id="subtotal">-</p>
                        </div>

                        <div style="flex-grow: 1"></div>
                    <button id="button_addToCart" value="{{$item->id}}" class="btn-primary"><span><i class="fa-solid fa-cart-plus"></i></span>Agregar al carrito</button>
                </div>
            </div>
            <!-- /Panel info -->
        </div>
        <!-- /Grid -->

        <!-- /Tabs -->
        <ul class="tabs" style="margin-top: 40px;">
            <li class="tab active">Información</li>
            <li class="tab">Reseñas({{count($reviews)}})</li>
        </ul>

        <div class="tab-content">
            @if($detalle)
                {!!$detalle->detalle!!}
            @else
                <p>El artículo no tiene detalle</p>
            @endif
        </div>

        <div class="tab-content">
            @for($i=0;$i<count($reviews);$i++)
                <div class="user-review">
                    <div>
                        <div class="user-review-picture"><i class="fa-solid fa-user fa-2x"></i></div>
                        <div>
                            <div><b>{{$reviews[$i]["username"]}}</b></div>
                            <div>{{$reviews[$i]["fecha"]}}</div>
                        </div>
                    </div>
                    <b>{{$reviews[$i]["titulo"]}}</b>
                    {{$reviews[$i]["texto"]}}
                </div>
            @endfor
        </div>
        <!-- /Tabs -->

    </div>
    <!-- /Contenido de la página -->
@endsection