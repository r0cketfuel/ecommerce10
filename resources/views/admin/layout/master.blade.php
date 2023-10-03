<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta name="viewport"   content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>@yield("title") - {{session("infoComercio.nombre")}}</title>

        <!-- Hojas de estilo -->
		<link rel="stylesheet"	href="{{config('constants.framework_css')}}framework.css">

        <link rel="stylesheet"	href="{{config('constants.admin_css')}}style.css">
		<link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
		<link rel="stylesheet"	href="{{config('constants.admin_css')}}header.css">
		<link rel="stylesheet"	href="{{config('constants.admin_css')}}navbar.css">

		<link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        @yield("css")
        
        <!-- Scripts -->
        <script defer src="{{config('constants.framework_js')}}scroll.js"></script>
        @yield("js")

        @yield("inlineCSS")
	</head>
	<body id="top">
        @include("admin.layout.navbar")
        @include("admin.layout.backToTop")
        @yield("body")
	</body>
</html>