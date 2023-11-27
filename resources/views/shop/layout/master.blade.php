<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta charset="utf-8">
        <meta name="viewport"       content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token"     content="{{csrf_token()}}">
        <meta name="description"    content="{{ session('infoComercio.nombre') }}">
        
        <title>@yield("title") - {{session("infoComercio.nombre")}}</title>

        <!-- Hojas de estilo -->
        <link rel="stylesheet"	href="{{ config('constants.shop_css') }}style.css">
        <link rel="stylesheet"	href="{{ config('constants.shop_css') }}login.css">
        <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">
        @yield("css")

        <!-- Font awesome -->
		<link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        
        <!-- Scripts -->
        <script defer src="{{config('constants.framework_js')}}scroll.js"></script>
        <script defer src="{{config('constants.framework_js')}}navbar.js"></script>
		@yield("js")

        @yield("inlineCSS")
	</head>
	<body id="top">

        @guest
            @include("shop.modals.login")
        @endguest

        @include("shop.layout.headers")
        @include("shop.layout.backToTop")
        @include("shop.layout.whatsappBubble")
        @yield("body")
        @include("shop.layout.footers")

        @yield("scripts")

        @guest
            <script>
                document.addEventListener("DOMContentLoaded", () => {

                    const loginLink   = document.getElementById("login-link");
                    const modalLogin  = document.getElementById("modal-login");

                    loginLink.addEventListener("click", function(event) {
                        event.preventDefault();

                        modalLogin.style.display = "block";
                    });
                });
            </script>
        @endguest
	</body>
</html>