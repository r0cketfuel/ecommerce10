<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sitio en mantenimiento</title>

        <!-- Hojas de estilo -->
        <link rel="stylesheet"	href="{{asset('/assets/css/site/style.css')}}">
        <link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <!-- Scripts -->
		<script defer src="{{asset('/assets/js/framework/scroll.js')}}"></script>
		<script defer src="{{asset('/assets/js/framework/navbar.js')}}"></script>
        <script defer src="{{asset('/assets/js/framework/preloader.js')}}"></script>
    </head>
	<body id="top">
        <div class="hero-text">
            <h2>Estamos haciendo mantenimiento, te pedimos disculpas</h2>
        </div>
	</body>
</html>