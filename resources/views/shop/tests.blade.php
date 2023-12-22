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

    <style>
        header {
            user-select:        none;
        }

        header .header-container {
            margin:             0 auto;
            max-width:          1280px;
        }

        header .header-container .top-header {
            background:         black;
            color:              white;
            
            padding:            5px;

            display:            flex;
            flex-flow:          row nowrap;
            align-content:      center;
            gap:                10px;
        }

        header .header-container .top-header .user {
            text-wrap:          nowrap;
        }

        header .header-container .main-header .navbar .responsive-nav-icon {
            display:            none;
        }

        @media (max-width: 768px) {
                header .header-container .main-header .navbar .responsive-nav-icon {
                display:                block;
            }
            header .header-container .main-header .navbar .nav-links .sidebar-logo {
                display: 				flex;
                justify-content: 		space-between;
                align-items:            flex-start;
            }

            /* SIDEBAR LOGO */
            .sidebar-logo div {
                font-size: 				20px;
            }
            
            /* BOTON CERRAR */
            .sidebar-logo .font-awesome-icon-close {
                cursor:					pointer;
                padding:                0 12px;
            }

            /* SIDEBAR */
            header .header-container .main-header .navbar .nav-links {
                height:                 100%;
                position: 				fixed;
                top: 					0;
                left: 					-150%; /* OJO ACA ERA 100 */
                display: 				block;
                max-width: 				300px;
                width: 					100%;
                background: 			black;
                line-height: 			40px;
                padding: 				20px;
                box-shadow: 			0 5px 10px rgba(0, 0, 0, 0.2);
                transition: 			all 0.5s ease;
                z-index: 				10;
                color:					white;
            }
        }

    </style>

    </head>
    <body id="top">

        <header>
            <div class="header">
                <div class="header-container">
                    <div class="top-header">
                        <marquee behavior="" direction="">Texto laaaaaaaaaargo de pruebas</marquee>
                        <div class="user">
                            <span>Nombre de usuario | <a href="/shop/logout">Salir</a></span>
                        </div>
                    </div>
                    <div class="main-header">
                        <nav>
                            <div class="navbar">
                                <div class="responsive-nav-icon" id="responsive-nav">
                                    <div class="font-awesome-icon-bars">
                                        <i class="fa-solid fa-bars">BARS</i>
                                    </div>
                                </div>
                                <div class="nav-links">
                                    <div class="sidebar-logo">
                                        <div>
                                            <div>Logo del comercio</div>
                                            <div>Slogan del comercio</div>
                                        </div>
                                        <div class="font-awesome-icon-close">
                                            <i class="fa-solid fa-x fa-lg">X</i>
                                        </div>
                                    </div>
                                    <ul class="links">
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
        
            });
        </script>

    </body>
</html>