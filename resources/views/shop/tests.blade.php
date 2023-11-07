<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta charset="utf-8">
        <meta name="viewport"       content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token"     content="{{csrf_token()}}">
        <meta name="description"    content="{{ session('infoComercio.nombre') }}">
        
        <title>Página de pruebas</title>

        <!-- Hojas de estilo -->
        <link rel="stylesheet"	href="{{ config('constants.shop_css') }}style.css">
        <link rel="stylesheet"	href="{{ config('constants.shop_css') }}login.css">
        <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">

		<link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        
        <!-- Scripts -->
        <script defer src="{{config('constants.framework_js')}}scroll.js"></script>
        <script defer src="{{config('constants.framework_js')}}navbar.js"></script>
	</head>
	<body id="top">
        @include("shop.layout.modals.modalLogin")
        @include("shop.layout.headers")
        @include("shop.layout.backToTop")
        @include("shop.layout.whatsappBubble")


        


        @include("shop.layout.footers")
	</body>
</html>