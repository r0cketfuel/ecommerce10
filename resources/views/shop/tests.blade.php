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

		<div class="container">
		<label>Provincias</label>
		<select id="selectProvincias">
			<option value="Elige una provincia">Elige una provincia</option>
		</select>
		<span></span>

		<label>Municipios</label>
		<select id="selectMunicipios">
			<option value="Elige un municipio">Elige un municipio</option>
		</select>
		<span></span>

		<label>Localidades</label>
		<select id="selectLocalidades">
			<option value="Elige una localidad">Elige una localidad</option>
		</select>
		<span></span>
		</div>

		<script>
			const $selectProvincias 	= document.getElementById("selectProvincias");
			const $selectMunicipios 	= document.getElementById("selectMunicipios");
			const $selectLocalidades 	= document.getElementById("selectLocalidades");

			function provincia()
			{
				fetch("https://apis.datos.gob.ar/georef/api/provincias")
				.then(res => res.ok ? res.json() : Promise.reject(res))
				.then(json => {
					let $options = `<option value="Elige una provincia">Elige una provincia</option>`;

					json.provincias.forEach(el => $options += `<option value="${el.nombre}">${el.nombre}</option>`);

					$selectProvincias.innerHTML = $options;
				})
				.catch(error => {
					let message = error.statusText || "Ocurrió un error";

					$selectProvincias.nextElementSibling.innerHTML = `Error: ${error.status}: ${message}`;
				})
			}

			document.addEventListener("DOMContentLoaded", provincia)

			function municipio(provincia) {
				fetch(`https://apis.datos.gob.ar/georef/api/municipios?provincia=${provincia}&max=500`)
				.then(res => res.ok ? res.json() : Promise.reject(res))
				.then(json => {
					let $options = `<option value="Elige un municipio">Elige un municipio</option>`;

					json.municipios.forEach(el => $options += `<option value="${el.id}">${el.nombre}</option>`);

					$selectMunicipios.innerHTML = $options;
				})
				.catch(error => {
					let message = error.statusText || "Ocurrió un error";

					$selectMunicipios.nextElementSibling.innerHTML = `Error: ${error.status}: ${message}`;
				})
			}

			$selectProvincias.addEventListener("change", e => {
				municipio(e.target.value);
				console.log(e.target.value)
			})

			function localidad(municipio) {
				fetch(`https://apis.datos.gob.ar/georef/api/localidades?municipio=${municipio}&max=500`)
				.then(res => res.ok ? res.json() : Promise.reject(res))
				.then(json => {
					let $options = `<option value="Elige una localidad">Elige una localidad</option>`;

					json.localidades.forEach(el => $options += `<option value="${el.id}">${el.nombre}</option>`);

					$selectLocalidades.innerHTML = $options;
				})
				.catch(error => {
					let message = error.statusText || "Ocurrió un error";

					$selectLocalidades.nextElementSibling.innerHTML = `Error: ${error.status}: ${message}`;
				})
			}

			$selectMunicipios.addEventListener("change", e => {
				localidad(e.target.value);
				console.log(e.target.value)
			})
		</script>

	</body>
</html>