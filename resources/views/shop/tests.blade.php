<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta charset="utf-8">
        <meta name="viewport"       content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token"     content="{{csrf_token()}}">
        <meta name="description"    content="{{ session('infoComercio.nombre') }}">
        
        <title>Página de pruebas</title>

		<style>
			body {
				margin: 		0;
				padding: 		0;

				min-height: 	100vh;
				box-sizing: 	border-box;
				
				display: 		flex;
				flex-flow: 		column nowrap;
			}

			header {
				height: 		100px;
				background: 	orangered;
			}

			.contenedor {
				min-height: 	calc(100vh - 100px);
				background: 	grey;
			}

			footer {
				background: 	blueviolet;
			}
		</style>

	</head>
	<body id="top">

		<header>
			<p>Header</p>
			<p>Header</p>
			<p>Header</p>
		</header>
		<div class="contenedor">
			@for ($i = 0; $i < 0; ++$i)
				<p>{{ $i }}</p>
			@endfor
		</div>
		<footer>
			<p>Footer</p>
			<p>Footer</p>
			<p>Footer</p>
			<p>Footer</p>
			<p>Footer</p>
		</footer>

	</body>
</html>