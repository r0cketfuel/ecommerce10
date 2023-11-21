@extends("shop.layout.master")

@php
    $title = "Inicio";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}carousel.css">
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}productCards.css">
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}newsletter.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}paginator.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.shop_js') }}carousel.js"></script>
    <script defer src="{{ config('constants.shop_js') }}cart.js"></script>
    <script defer src="{{ config('constants.shop_js') }}cardSort.js"></script>
    <script defer src="{{ config('constants.shop_js') }}ajaxFavoritos.js"></script>
	<script defer src="{{ config('constants.shop_js') }}ajaxSuscribe.js"></script>
    <script defer src="{{ config('constants.framework_js') }}modal.js"></script>
@endsection

@section("body")

    @include("shop.modals.addItem")

    <!-- Contenido de la página -->
    <div class="main-container">

        <!-- Banners promocionales -->
        @include("shop.layout.banners")

        <!-- Barra superior de búsqueda -->
        <div class="flex justify-between align-center">
            <div>
                <span class="text-bold">{{ __('general.showing') }}: </span>{{ $busqueda["titulo"] }}
            </div>
            <div class="w150px">
                <select id="sortBy">
                    <option value="" disabled selected>{{ __('general.sort') }}...</option>
                    <option value="1">{{ __('general.price_lowest') }}</option>
                    <option value="2">{{ __('general.price_highest') }}</option>
                </select>
            </div>
        </div>
        <!-- /Barra superior de búsqueda -->
        
        <!-- Items -->
        @include("shop.products.product-list")

        <!-- Paginador -->
        {{ $items->links("shop.layout.paginator") }}

    </div>
    
    <!-- Newsletter -->
    @include("shop.layout.newsletter")

@endsection