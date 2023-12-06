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
				margin: 			0;
				padding: 			0;

				min-height: 		100vh;
				box-sizing: 		border-box;

				display: 			flex;
				flex-flow: 			column nowrap;
			}

			header {
				background: 		orangered;
			}

			header .header {
				display: 			flex;
				flex-flow: 			column nowrap;
				gap: 				10px;
			}

			header .logo {
				text-transform: 	uppercase;
			}

			header nav .navbar ul {
				margin: 			0;
				padding: 			0;
				list-style: 		none;
				display: 			flex;
				flex-flow: 			row nowrap;
				gap: 				10px;
			}

			.contenedor {
				flex: 				1;
				background: 		grey;
			}

			footer {
				background: 		blueviolet;
			}

			footer .footer {
				display: 			flex;
				flex-flow: 			row nowrap;
				justify-content: 	space-between;
				gap: 				50px;
			}

			.wrapper {
				min-height: 		100vh;
				flex: 				1;
				display: 			flex;
				flex-flow: 			column nowrap;
			}
		</style>

	</head>
	<body id="top">

			<div class="wrapper">
				<header>
					<div class="header">
						<div class="logo">
							<h1>Logo</h1>
						</div>
						<nav>
							<div class="navbar">
								<ul>
									<li>Menu 1</li>
									<li>Menu 2</li>
									<li>Menu 3</li>
									<li>Menu 4</li>
								</ul>
							</div>
						</nav>
					</div>
				</header>
				<div class="contenedor">
					<p>Párrafo 1</p>
					<p>Párrafo 2</p>
					<p>Párrafo 3</p>
				</div>
			</div>

			<!-- Footer -->
			<footer>
				<div class="footer">
					<div class="footer-section">Section 1</div>
					<div class="footer-section">Section 2</div>
					<div class="footer-section">Section 3</div>
				</div>
			</footer>

	</body>
</html>