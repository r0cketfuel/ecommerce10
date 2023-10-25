<header>
    <div class="top-header">
        <div class="top-header-container">
            <marquee>{{ session("marquesinas") }}</marquee>
            <ul>
                <li>
                    @auth
                        <a href="/shop/account">{{ auth()->user()->username }}&nbsp;<i class="fa-solid fa-user-gear"></i></a>
                        &nbsp;|&nbsp; 
                        <a href="/shop/logout">{{ __('general.logout') }}&nbsp;<i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                    @endauth
                    @guest
                        @if (session('shop.usuario.datos.id') == -1)
                            <a href="/shop/account">{{ session('shop.usuario.datos.username') }}&nbsp;<i class="fa-solid fa-user-gear"></i></a>
                            &nbsp;|&nbsp; 
                            <a href="/shop/logout">{{ __('general.logout') }}&nbsp;<i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        @else
                            <a href="{{ route('user.login') }}" id="login-link"><i class="fa-solid fa-user"></i>&nbsp;{{ __('general.login') }}</a>
                        @endif
                    @endguest
                </li>
            </ul>
        </div>
    </div>
    <div class="main-header">
        <div class="main-header-container">
            <div class="main-header-top">
                <div class="logo">
                    <a href="/shop">
                        <h1>{{ session("infoComercio.nombre") }}</h1>
                        <h2>{{ session("infoComercio.slogan") }}</h2>
                    </a>
                </div>
                <div class="search-bar">
                    <form id="form-search" action="/shop"></form>
                    <div class="input-container">
                        <input form="form-search" type="text" name="busqueda" value="{{ isset($busqueda['searchbar']) ? $busqueda['searchbar'] : '' }}" placeholder="{{ __('general.search') }}...">
                        <button form="form-search" type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
                <div class="iconos">
                    <div>
                        <a href="/shop/favoritos">
                            <div class="wishlist-container-icon">
                                <i class="fa-solid fa-heart"></i>
                                <div class="qty" id="heart">{{ $favoritosItemQty }}</div>
                                <div class="shopping-cart-container-label">{{ __('general.favorites') }}</div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="/shop/checkout">
                            <div class="shopping-cart-container-icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <div class="qty" id="qty">{{ $shoppingCartItemQty }}</div>
                                <div class="shopping-cart-container-label">{{ __('general.cart') }}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="main-header-bottom">
                <nav>
                    @include("shop.layout.navbar")
                </nav>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        //return;

        var loginLink   = document.getElementById("login-link");
        var modalLogin  = document.getElementById("modal-login");

        // Agrega un controlador de eventos al enlace de inicio de sesión
        loginLink.addEventListener("click", function(event) {
            event.preventDefault(); // Evita que el enlace se abra

            // Muestra el modal de inicio de sesión
            modalLogin.style.display = "block";
        });
    });
</script>