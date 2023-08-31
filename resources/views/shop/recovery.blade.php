<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recuperar contraseña - {{session("infoComercio.nombre")}}</title>
        
        <!-- Hojas de estilo -->
        <link rel="stylesheet"	href="{{config('constants.shop_css')}}style.css">

        <!-- Scripts -->
        <script src="{{asset('/assets/fontawesome/js/all.js')}}"></script>
    </head>
	<body id="top">

        <!-- Contenido de la página -->
        <div class="main-container">

            @if($success == 1)
                <div class="alert success">Se ha enviado un email con instrucciones para la recuperación de la contraseña</div>
            @endif
            
            @if($success == 2)
                <div class="alert danger">Los datos ingresados no son correctos</div>
            @endif

            <div class="panel">
                <div class="panel-title">Recuperar contraseña</div>
                <div class="panel-content">
                    <label>Teléfono celular
                        <input required form="form" type="text" name="telefono_celular">
                    </label>
                    <label>Correo electrónico
                        <input required form="form" type="email" id="email" name="email">
                    </label>
                    <button form="form" class="btn-primary" type="submit">Enviar</button>
                </div>
            </div>

        </div>

        <form id="form" method="post" autocomplete="off">@csrf</form>
	</body>
</html>