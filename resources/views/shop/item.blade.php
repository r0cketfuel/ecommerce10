@extends("shop.layout.master")

@php
    $title = "$item->nombre";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}carousel.css">
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}tiles.css">
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}productRating.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}tabs.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}breadcrumb.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.shop_js') }}tiles.js"></script>
    <script defer src="{{ config('constants.shop_js') }}tabs.js"></script>
    <script defer src="{{ config('constants.shop_js') }}cart.js"></script>
    <script defer src="{{ config('constants.framework_js') }}modal.js"></script>
@endsection

@section("inlineCSS")
    <style>
        ul.tabs {
            margin-top: 50px;
        }
    </style>
@endsection

@section("body")

    @auth
        @include("shop.layout.modals.addReview")
    @endauth

    <!-- Contenido de la página -->
    <div class="main-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/shop"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > Detalle item
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-12 grid-align-start">

            <!-- Mosaicos -->
            <div class="col-span-7 col-span-900p-12">
                <div class="product-tile">
                    <div class="tiles-container">
                        @if ($item->imagenes->isNotEmpty())
                            @foreach ($item->imagenes as $imagen)
                                @if ($loop->first)
                                    <div class="tile active">
                                        <img src="{{ $imagen->miniatura }}" alt="{{ $imagen->descripcion }}">
                                    </div>
                                    <div class="tile main">
                                        <a href="{{ $item->imagenes[0]->ruta }}">
                                            <img id="image" src="{{ $item->imagenes[0]->miniatura }}" alt="vista_previa">
                                        </a>
                                        <button class="btn btn-next">&gt;</button>
                                        <button class="btn btn-prev">&lt;</button>
                                    </div>
                                @else
                                    <div class="tile">
                                        <img src="{{ $imagen->miniatura }}" alt="{{ $imagen->descripcion }}">
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <!-- En caso de que no haya imágenes, puedes mostrar una imagen de reemplazo o un mensaje -->
                            <div class="tile active">
                                <img src="{{ asset('images/content/no-image.png') }}" alt="No Image">
                            </div>
                            <div class="tile main">
                                <img src="{{ asset('images/content/no-image.png') }}" alt="No Image">
                                <button class="btn btn-next">&gt;</button>
                                <button class="btn btn-prev">&lt;</button>
                            </div>
                            <div class="tile">
                                <img src="{{ asset('images/content/no-image.png') }}" alt="No Image">
                            </div>
                            <div class="tile">
                                <img src="{{ asset('images/content/no-image.png') }}" alt="No Image">
                            </div>
                            <div class="tile">
                                <img src="{{ asset('images/content/no-image.png') }}" alt="No Image">
                            </div>
                            <div class="tile">
                                <img src="{{ asset('images/content/no-image.png') }}" alt="No Image">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /Mosaicos -->



            <!-- Panel info -->
            <div class="col-span-5 col-span-900p-12">
                <div class="tile-info">
                    <div>
                        <h1>{{ $item->nombre }}</h1>
                        <h2>{{ $item->descripcion }}</h2>
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
                    <button id="button_addToCart" value="{{ $item->id }}" class="btn-primary"><span><i class="fa-solid fa-cart-plus"></i></span>{{ __('buttons.addToCart') }}</button>
                </div>
            </div>
            <!-- /Panel info -->
        </div>
        <!-- /Grid -->

        @include("shop.layout.tabs")

    </div>
    <!-- /Contenido de la página -->
@endsection