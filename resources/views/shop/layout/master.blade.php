<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta charset="utf-8">
        <meta name="viewport"       content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token"     content="{{csrf_token()}}">
        <meta name="description"    content="{{ session('infoComercio.nombre') }}">
        
        <title>@yield("title") - {{session("infoComercio.nombre")}}</title>

        <!-- Estilos -->
        <link rel="stylesheet"	href="{{ config('constants.shop_css') }}style.css">
        <link rel="stylesheet"	href="{{ config('constants.shop_css') }}login.css">
        <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">
        
        @yield("css")

        <!-- Font awesome -->
		<link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        
        <!-- Scripts -->
        <script defer src="{{config('constants.framework_js')}}scroll.js"></script>
        <script defer src="{{config('constants.framework_js')}}navbar.js"></script>
		@yield("js")
        
        <style>
            .wrapper {
				min-height: 		    100vh;
				flex: 				    1;
				display: 			    flex;
				flex-flow: 			    column nowrap;
                opacity: 			    0;
			}

            #loader {
                position:               absolute;
                height:                 100vh;
                width:                  100%;
                top:                    50%;
                left:                   50%;
                -webkit-transform:      translate(-50%, -50%);
                    -ms-transform:      translate(-50%, -50%);
                        transform:      translate(-50%, -50%);
                
                display:                flex;
                justify-content:        center;
                align-items:            center;
                z-index:                99999;
            }

            .loader {
                width: 					60px;
                height: 				60px;
                border: 				5px solid rgb(50,50,50);
                border-bottom-color: 	transparent;
                border-radius: 			50%;
                display: 				block;
                box-sizing: 			border-box;
                animation: 				rotation 1s linear infinite;
            }

            @keyframes rotation {
                0% {transform: rotate(0deg);} 100% {transform: rotate(360deg);}
            } 
		</style>

        @yield("inlineCSS")
	</head>
	<body id="top">

        <!-- Loader -->
        <div id="loader">
            <span class="loader"></span>
        </div>

        <!-- Wrapper -->
        <div class="wrapper" id="wrapper">
            @guest
                @include("shop.modals.login")
            @endguest

            @include("shop.layout.headers")
            @include("shop.layout.backToTop")
            @include("shop.layout.whatsappBubble")
            @yield("body")
        </div>
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

        <script>
            window.addEventListener("load", function () {

            const wrapper   = document.getElementById("wrapper");
            const loader    = document.getElementById("loader");

            wrapper.style.transition    = "opacity 0.5s";
            wrapper.style.opacity       = 1;

            loader.style.display        = "none"

            });
        </script>

        <script>
            function submitForm()
            {
                const searchInput = document.getElementById('busqueda').value.trim();

                if (searchInput !== '')
                    return true;
                else
                    return false;
            }
        </script>
	</body>
</html>