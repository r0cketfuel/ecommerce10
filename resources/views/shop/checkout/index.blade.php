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

@endsection

@section("inlineCSS")
	<style>
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
		}

		.btnPrev:hover,
		.btnNext:hover {
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
					<div class="carousel-slide">
						<div class="flex justify-end">
							<a class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></a>
						</div>
						<br>
						<!-- Contenido del Carousel -->
						@include("shop.checkout.1")
					</div>

					<!-- Pantalla 2 -->
					<div class="carousel-slide">
						<div class="flex justify-between">
							<a class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</a>
							<a class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></a>
						</div>
						<br>
						<!-- Contenido del Carousel -->
						@include("shop.checkout.2")
					</div>
				
					<!-- Pantalla 3 -->
					<div class="carousel-slide">
						<div class="flex justify-between">
							<a class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</a>
							<a class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></a>
						</div>
						<br>
						<!-- Contenido del Carousel -->
						@include("shop.checkout.panel-medio-pago")
					</div>

					<!-- Pantalla 4 -->
					<div class="carousel-slide">
						<div class="flex justify-between">
							<a class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</a>
							<a class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></a>
						</div>
						<br>
						<!-- Contenido del Carousel -->
						@include("shop.checkout.panel-medio-envio")
					</div>

					<!-- Pantalla 5 -->
					<div class="carousel-slide">
						<div class="flex justify-between">
							<a class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</a>
							<a class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></a>
						</div>
						<br>
						<!-- Contenido del Carousel -->
						@include("shop.checkout.3")
					</div>

					<!-- Pantalla 6 -->
					<div class="carousel-slide">
						<div class="flex justify-start">
							<a class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</a>
						</div>
						<br>
						<!-- Contenido del Carousel -->
						@include("shop.checkout.4")
					</div>
				</div>
			</div>
		@else
			<p>Todavía no agregaste ningún item al carrito de compras</p>
		@endif
    </div>
@endsection

@section("scripts")
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const slides 		= document.querySelectorAll(".carousel-slide");
			const nextButtons 	= document.querySelectorAll(".btnNext");
			const prevButtons 	= document.querySelectorAll(".btnPrev");
			
			let curSlide 		= 0;
			const maxSlide 		= slides.length - 1;

			nextButtons.forEach(button => {
				button.addEventListener("click", function () {
					if (curSlide < maxSlide) ++curSlide;

					slides.forEach((slide, indx) => {
						slide.style.transform = `translateX(${-100 * curSlide}%)`;
					});
					smoothScroll("top");
				});
			});

			prevButtons.forEach(button => {
				button.addEventListener("click", function () {
					if (curSlide > 0) --curSlide;

					slides.forEach((slide, indx) => {
						slide.style.transform = `translateX(${-100 * curSlide}%)`;
					});
					smoothScroll("top");
				});
			});

			function smootScroll(id)
			{
				let element = document.getElementById(id);
				if(element)
					element.scrollIntoView({block: "start", behavior: "smooth"});
			}

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
