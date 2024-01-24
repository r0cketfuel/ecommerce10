@extends("shop.layout.master")

@php
    $title = "Checkout";
@endphp

@section("title", $title)

@php
    $breadcrumbs = [
    ];
@endphp

@section("css")
	<link rel="stylesheet"	href="{{ config('constants.shop_css') }}productCards.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}panel.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">
@endsection

@section("js")
	<script defer src="{{ config('constants.shop_js') }}carouselForms.js"></script>
@endsection

@section("inlineCSS")
    <style>
        @media (max-width: 600px)
        {
            .panel-content .flex {
                flex-flow: 			column nowrap;
            }
        }

		.carousel-container {
			flex: 					1;
			overflow: 				hidden;
		}

		.carousel-slider {
			display: 				flex;
			flex-flow: 				row nowrap;
			width: 					600%;
		}

		.carousel-slide {
			flex: 					1;
			transition: 			all 0.5s ease-in-out;
		}

		.btnPrev,
		.btnNext {
			padding:				8px 16px;
			border: 				1px solid rgb(200,200,200);
			border-radius:  		4px;
			width:					unset;
		}

		.btnPrev:not(.btn-primary):hover,
		.btnNext:not(.btn-primary):hover {
			cursor: 				pointer;
			background-color: 		rgba(0, 0, 0, 0.05);
		}

		.panel {
			box-shadow: 			unset;
		}
	</style>
@endsection

@section("body")
    <div class="main-container">
		@include("shop.layout.breadcrumb")
		
		@if(count($checkout["items"])>0)
			<div class="carousel-container">
				<div class="carousel-slider">

					<!-- Pantalla 1 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="1">
						@csrf
						@include('shop.checkout.1')
					</form>

					<!-- Pantalla 2 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="2">
						@csrf
						@include('shop.checkout.2')
					</form>

					<!-- Pantalla 3 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="3">
						@csrf
						@include("shop.checkout.panel-medio-pago")
					</form>

					<!-- Pantalla 4 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="4">
						@csrf
						@include("shop.checkout.panel-medio-envio")
					</form>

					<!-- Pantalla 5 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="5">
						@csrf
						@include("shop.checkout.3")
					</form>

					<!-- Pantalla 6 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="6">
						@csrf
						@include("shop.checkout.4")
					</form>

				</div>
			</div>
		@else
			<p>Todavía no agregaste ningún item al carrito de compras</p>
		@endif
    </div>
@endsection

@if(count($checkout["items"])>0)
	@section("scripts")
		<script>
			document.addEventListener("DOMContentLoaded", () => {

				const radiosMedioPago   = document.querySelectorAll('input[name="radio_medioPago"]');
				const radiosMedioEnvio  = document.querySelectorAll("input[type='radio'][name='radio_medioEnvio']");
				
				const panelEnvios       = document.getElementById('shipmentPanel');
				const dataFields        = document.getElementById("shipmentData");

				radiosMedioPago.forEach(function (radio) {
					radio.addEventListener("change", function () { handleMediosPago(this); return false });
				});

				radiosMedioEnvio.forEach(function (radio) {
					radio.addEventListener("change", function () { handleMediosEnvio(this); return false });
				});

				medioPagoSeleccionado();

				function handleMediosPago(radio)
				{
					if(radio.value !== '1')
					{
						habilitaEnvio();
					}
					else
					{
						restablecerMedioEnvio();
						deshabilitaEnvio();
					}
				}

				function handleMediosEnvio(radio)
				{
					if(radio.value === '1')
					{
						ocultarCamposEnvio();
					}
					else
					{
						mostrarCamposEnvio();
					}
				}

				function habilitaEnvio() {
					const medio = document.querySelectorAll('input[name="radio_medioEnvio"]');
					medio[1].removeAttribute("disabled");
				}

				function deshabilitaEnvio() {
					const medio = document.querySelectorAll('input[name="radio_medioEnvio"]');
					medio[1].disabled = "disabled";
				}

				function mostrarCamposEnvio() {
					dataFields.style.display = "block";
				}

				function ocultarCamposEnvio() {
					dataFields.style.display = "none";
				}

				function medioPagoSeleccionado()
				{
					const medio = document.querySelector('input[name="radio_medioPago"]:checked');
					handleMediosPago(medio);
				}

				function restablecerMedioEnvio()
				{
					const primerMedioEnvio = document.querySelector("input[type='radio'][name='radio_medioEnvio']:first-child");
					if (primerMedioEnvio)
					{
						primerMedioEnvio.checked = true;
						ocultarCamposEnvio();
					}
				}
			});
		</script>

		<script>
			async function ajax(url = "", parameters = {})
			{
				let token = document.querySelector("meta[name='csrf-token']").getAttribute("content");

				const response = await fetch(url,
				{
					method:         "POST",
					cache:          "no-cache",
					credentials:    "same-origin",
					headers: 
					{
									"Content-Type": "application/x-www-form-urlencoded",
									"X-CSRF-TOKEN": token,
					},
					redirect:       "follow",
					referrerPolicy: "strict-origin-when-cross-origin",
					body:           parameters
				});
				
				return response.json();
			}

			function itemRemove(dataset)
			{
				let parametros = {
					id:             dataset.id,
					opciones: {
						talle_id:   '',
						color:      ''
					},
					cantidad:       '0'
				};

				if(parseInt(dataset.talle_id)>0)    parametros["opciones"]["talle_id"] = dataset.talle_id;
				if(parseInt(dataset.idcolor)>0)     parametros["opciones"]["color_id"] = dataset.idcolor;

				const url           = "/shop/ajax/updateCart";
				const parameters    = encodeURIComponent(JSON.stringify(parametros));
				const promise       = ajax(url,parameters);
				
				promise.then((data) => 
				{
					//window.location.replace("/shop/checkout")
				});
			}
		</script>
	@endsection
@endif
