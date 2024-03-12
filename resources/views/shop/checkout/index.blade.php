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
			width: 					calc(500% + 400px);
			gap:					100px;
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

		.progress-indicator {
			display: 				grid;
			grid-template-columns: 	repeat(5, 1fr);
			grid-template-rows: 	repeat(2, auto);
			justify-content: 		space-between;
			justify-items: 			center;
			gap: 					5px;
			text-align: 			center;
			background-color: 		#fafafa;
			border: 				1px solid rgb(220, 220, 220);
			border-radius: 			4px;
			padding: 				25px;
		}

		.progress-indicator .step-number {
			border-radius: 			50%;
			height: 				32px;
			width: 					32px;
			border: 				3px solid rgb(220, 220, 220);
			display: 				flex;
			justify-content: 		center;
			align-items: 			center;
			font-weight: 			bold;
		}

		.progress-indicator .step-number.current-step {
			border: 				3px solid rgb(30, 200, 30);
		}

		.progress-indicator .success {
			background-color: 		rgb(80, 210, 80);
			border: 				3px solid rgb(30, 200, 30);
			color: 					white;
		}

		/* .progress-indicator div {
			height: 				3px;
			flex:					1;
			background-color: 		rgb(200,200,200);
		} */
		
		.progress-indicator div.success {
			background-color: 		rgb(80, 210, 80);
		}

		.container {
            height:                         28px;
            width:                          100%;
            border:                         1px solid rgb(220,220,220);
            padding:                        5px;
            background-color:               white;
            box-sizing:                     border-box;
        }
	</style>
@endsection

@section("body")
    <div class="main-container">
		@include("shop.layout.breadcrumb")
		
		@if(count($checkout["items"])>0)

		<div id="total">$100,00</div>

			@include("shop.checkout.step-indicator")

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
						@include("shop.checkout.3")
					</form>

					<!-- Pantalla 4 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="4">
						@csrf
						@include("shop.checkout.4")
					</form>

					<!-- Pantalla 5 -->
					<form method="post" class="step-form">
						<input type="hidden" name="currentStep" value="5">
						@include("shop.checkout.5")
						@csrf
					</form>

				</div>
			</div>
		@else
			<p>Todavía no agregaste ningún item al carrito de compras</p>
		@endif
    </div>

	<form id="form-checkout" action="/shop/process_payment" method="post">@csrf</form>
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
									"Content-Type": "application/json",
									"X-CSRF-TOKEN": token,
					},
					redirect:       "follow",
					referrerPolicy: "strict-origin-when-cross-origin",
					body: 			JSON.stringify(parameters)
				});
				
				return response.json();
			}

			function itemRemove(dataset)
			{
				let parametros = {
					id:         	dataset.id,
					atributos_id:	dataset.atributos_id,
					cantidad:   	'0'
				};

				const url           = "/shop/requests/updateCart";
				const promise       = ajax(url,parametros);
				
				promise.then((data) => 
				{
					window.location.replace("/shop/checkout");
				});
			}
		</script>

		<script>
			document.addEventListener("DOMContentLoaded", () => {
				var radios 			= document.querySelectorAll('input[name="radio_medioPago"]');
				var selectedOption 	= document.querySelector('input[name="radio_medioPago"]:checked').value;
				
				change(selectedOption);
			});

			document.addEventListener('change', async function(event) {
				if (event.target.matches('[name="radio_medioPago"]')) {
					const medioPagoId = event.target.value;
					change(medioPagoId);
				}
			});

			async function change(medioPagoId)
			{
				try
				{
					const response = await fetch(`requests/views/payment-methods/${medioPagoId}`, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': '{{ csrf_token() }}'
						},
					});
					if (!response.ok) {
						throw new Error('Error al obtener la vista del medio de pago');
					}
					const html = await response.text();
					document.getElementById('selected_payment_method').innerHTML = html;
				} catch (error) {
					console.error(error);
				}
			}
		</script>
	@endsection
@endif
