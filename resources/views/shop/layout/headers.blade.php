<header>
    <div class="top-header">
        <div class="top-header-container">
            <marquee>
                @foreach (session("shop.marquesinas") as $marquesina)
                    {{ $marquesina->mensaje }}
                @endforeach
            </marquee>
            @auth
                <nav class="user-menu">
                    <div class="main-menu-link">
                        <div class="menu-link"><a href="#"><i class="fa-regular fa-user"></i>&nbsp;{{ auth()->user()->nombres }}</a></div>
                        <div class="menu-arrow"><i class="fa-solid fa-chevron-down fa-sm"></i></div>
                    </div>
                    <ul class="main-menu-submenu">
                        <li class="submenu-item">
                            <div class="user-menu-icon"><i class="fa-solid fa-user-gear"></i></div>
                            <div class="user-menu-link"><a href="/shop/account">Mi cuenta</a></div>
                        </li>
                        <li class="submenu-item">
                            <div class="user-menu-icon"><i class="fa-solid fa-shopping-bag"></i></div>
                            <div class="user-menu-link"><a href="/shop/compras">Mis compras</a></div>
                        </li>
                        <li class="submenu-item">
                            <div class="user-menu-icon"><i class="fa-solid fa-heart"></i></div>
                            <div class="user-menu-link"><a href="/shop/favoritos">Favoritos</a></div>
                        </li>
                        <li class="submenu-item">
                            <div class="user-menu-icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></div>
                            <div class="user-menu-link"><a href="/shop/logout">Salir</a></div>
                        </li>
                    </ul>
                </nav>
            @endauth
            @guest
                <ul>
                    <li>
                        @if (session('shop.usuario.datos.id') == -1)
                            <a href="/shop/account">{{ session('shop.usuario.datos.username') }}&nbsp;<i class="fa-solid fa-user-gear"></i></a>
                            &nbsp;|&nbsp; 
                            <a href="/shop/logout">{{ __('general.logout') }}&nbsp;<i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        @else
                            <a href="{{ route('user.login') }}" id="login-link"><i class="fa-solid fa-user"></i>&nbsp;{{ __('general.login') }}</a>
                        @endif
                    </li>
                </ul>
            @endguest
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
                    <div class="input-container">
                        <form id="search_form" action="/shop" method="get" onsubmit="return submitForm()">
                            <input type="text" name="busqueda" id="busqueda" value="{{ isset($busqueda['searchbar']) ? $busqueda['searchbar'] : '' }}" placeholder="{{ __('general.search') }}...">
                            <button type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
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