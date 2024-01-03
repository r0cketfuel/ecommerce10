<header>
    <div class="top-header">
        <div class="top-header-container">
            <marquee>
                @foreach (session("shop.marquesinas") as $marquesina)
                    {{ $marquesina->mensaje }}
                @endforeach
            </marquee>
            @auth
                <nav>
                    <div class="navbar">
                        <div class="nav-links">
                            <ul class="links">

                                <li class="main-menu">
                                    <div>
                                        <a class="main-menu-link" href="#"><i class="fa-solid fa-user"></i>&nbsp;{{ auth()->user()->apellidos }}, {{ auth()->user()->nombres }}</a>
                                        <i class="fa-solid fa-caret-down menu-arrow arrow"></i>
                                    </div>
                                    <ul class="main-menu-links sub-menu">
                                        <li class="more flex gap-3">
                                            <div style="color: black">
                                                <a class="submenu-link" href="/shop/account"><i class="fa-solid fa-user-gear"></i>Mi cuenta</a>
                                            </div>
                                        </li>
                                        <li class="more flex gap-3">
                                            <div style="color: black">
                                                <a class="submenu-link" href="/shop/compras"><i class="fa-solid fa-shopping-bag"></i>Mis compras</a>
                                            </div>
                                        </li>
                                        <li class="more flex gap-3">
                                            <div style="color: black">
                                                <a class="submenu-link" href="/shop/logout"><i class="fa-solid fa-arrow-right-from-bracket"></i>Salir</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
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