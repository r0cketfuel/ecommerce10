@php
    $title = "Página de pruebas";
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <!-- Hojas de estilo -->
    <link rel="stylesheet" href="{{ config('constants.framework_css') }}normalize.css">
    <link rel="stylesheet" href="{{ config('constants.shop_css') }}headers.css">
    <link rel="stylesheet" href="{{ config('constants.framework_css') }}links.css">

        <!-- Font awesome -->
		<link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --containers-max-width:     	1366px;
            --containers-side-padding:		20px;
        }

        .user-menu {
            position:           relative;
            display:            inline-block;
        }

        .user-menu .main-menu-link {
            display:            flex;
            gap:                5px;
            white-space:        nowrap;
            cursor:             pointer;
            padding:            10px;
            align-items:        center;
        }

        .user-menu .main-menu-submenu {
            position:           absolute;
            background:         white;
            color:              black;
            z-index:            10;
            border:             1px solid black;
            padding:            10px;
            display:            none;
            white-space:        nowrap;
        }

        .user-menu .main-menu-link:hover + .main-menu-submenu,
        .user-menu .main-menu-submenu:hover {
            display:            flex;
            flex-flow:          column nowrap;
        }

        .submenu-item:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
        
        .user-menu .main-menu-submenu .submenu-item {
            display:            flex;
            gap:                5px;
            padding:            5px;
        }

        .user-menu .main-menu-submenu .submenu-item .user-menu-icon {
            width:              20px;
        }

        .user-menu .main-menu-submenu .submenu-item .user-menu-link {
            flex:               1;
        }
    </style>

</head>
<body id="top">
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
                            <div class="menu-link"><a href="#"><i class="fa-regular fa-user"></i>&nbsp;{{ auth()->user()->apellidos }}, {{ auth()->user()->nombres }}</a></div>
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
        </header>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
        
            });
        </script>

    </body>
</html>