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
			width: 					500%;
		}

		.carousel-slide {
			flex: 					1;
			transition: 			all 0.5s ease-in-out;
		}

		.panel {
			box-shadow: 			unset;
		}
	</style>
@endsection

@section("body")
    <div class="main-container">
		@include("shop.layout.breadcrumb")

		<!-- Pantallas -->
		<div class="carousel-container">
			<div class="carousel-slider">
				
				<div class="carousel-slide">
					<div class="flex justify-end">
						<a class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></a>
					</div>
					<br>
					<!-- Contenido del Carousel -->
					@include("shop.checkout.1")
				</div>

				<div class="carousel-slide">
					<div class="flex justify-between">
						<a class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</a>
						<a class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></a>
					</div>
					<br>
					<!-- Contenido del Carousel -->
					@include("shop.checkout.2")
				</div>
			
				<div class="carousel-slide">
					<div class="flex justify-between">
						<a class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</a>
						<a class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></a>
					</div>
					<br>
					<!-- Contenido del Carousel -->
					@include("shop.checkout.panel-medio-pago")
					<br>
					@include("shop.checkout.panel-medio-envio")
				</div>
			
				<div class="carousel-slide">
					<div class="flex justify-between">
						<a class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</a>
						<a class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></a>
					</div>
					<br>
					<!-- Contenido del Carousel -->
					@include("shop.checkout.3")
				</div>

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
		<!-- /Pantallas -->

    </div>
@endsection

@section("scripts")
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const slides = document.querySelectorAll(".carousel-slide");
			const maxSlide = slides.length - 1;
			let curSlide = 0;

			const nextButtons = document.querySelectorAll(".btnNext");
			const prevButtons = document.querySelectorAll(".btnPrev");

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
		});
    </script>
@endsection
