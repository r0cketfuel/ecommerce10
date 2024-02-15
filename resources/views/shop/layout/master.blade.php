<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta charset="utf-8">
        <meta name="viewport"       content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token"     content="{{ csrf_token() }}">
        <meta name="description"    content="{{ session('infoComercio.nombre') }}">
        
        <title>@yield("title") - {{ session("infoComercio.nombre") }}</title>

        <!-- Estilos -->
        <link rel="stylesheet"  href="{{ config('constants.shop_css') }}style.css">
        <link rel="stylesheet"	href="{{ config('constants.shop_css') }}login.css">
        <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">
        
        @yield("css")

        <!-- Font awesome -->
		<link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        
        <!-- Scripts -->
        <script src="{{ config('constants.framework_js') }}scroll.js"></script>
        <script src="{{ config('constants.framework_js') }}loader.js"></script>
        <script src="{{ config('constants.framework_js') }}navbar.js"></script>
		@yield("js")

        <style>
            .wrapper {
                min-height: 		    100vh;
                flex: 				    1;
                display: 			    flex;
                flex-flow: 			    column nowrap;
                opacity: 			    0;
            }
        </style>

        @yield("inlineCSS")
	</head>
	<body id="top">
        @include("shop.layout.loader")

        @include("shop.layout.alerts")

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
                    
                    const loginLink         = document.getElementById("login-link");
                    const modalLogin        = document.getElementById("modal-login");
                    const modalContainer    = document.getElementById("modal-container");
                    const loginForm         = document.getElementById("form-login");

                    loginLink.addEventListener("click", function(event) {
                        event.preventDefault();
                        modalLogin.style.display = "block";
                    });

                    loginForm.addEventListener("submit", function(event) {
                        event.preventDefault();
                        
                        document.getElementsByName("username")[0].classList.remove("form-error");
                        document.getElementsByName("password")[0].classList.remove("form-error");

                        loading(true);

                        const formData = new FormData(loginForm);

                        fetch("{{ route('login.modal') }}", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                        })
                        .then(response => {
                            
                            if (response.ok)
                            {
                                window.location.reload();
                            }
                            else
                            {
                                loading(false);
                                
                                document.getElementsByName("username")[0].classList.add("form-error");
                                document.getElementsByName("password")[0].classList.add("form-error");
                            }
                        })
                        .catch(error => {
                            console.error('Error al iniciar sesión:', error);
                        });
                    });
                });
            </script>
        @endguest

        <script>
            window.addEventListener("load", function () {

                const wrapper = document.getElementById("wrapper");

                wrapper.style.transition    = "opacity 1s";
                wrapper.style.opacity       = 1;
            });
        </script>

        <script>
            document.getElementById('search_form').addEventListener('submit', function (event) {
                
                const searchInput = document.getElementById('busqueda').value.trim();

                if(searchInput === '')
                    event.preventDefault();
            });
        </script>
	</body>
</html>