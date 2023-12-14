@extends("shop.layout.master")

@php
    $title = "Checkout";
@endphp

@section("title", $title)

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
			width: 					300%;
		}

		.carousel-slide {
			flex: 					1;
			transition: 			all 0.5s ease-in-out;
		}

		.panel {
			box-shadow: unset;
		}

        .checkout-panels {
            display:                        flex;
            flex-flow:                      row wrap;
            margin:                         0 auto;
            width:                          100%;
            gap:                            20px;
        }

        .checkout-panels>div:nth-child(1) {
            flex:                           9999 1;
        }

        .checkout-panels>div:nth-child(2) {
            flex:                           1 1 250px;
        }
	</style>
@endsection

@section("body")
    <div class="main-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/shop"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > {{ $title }}
        </div>

		<!-- Pantallas -->
		<div class="carousel-container">
			<div class="carousel-slider">
				<div class="carousel-slide">
					<!-- Contenido del Carousel -->
					@include("shop.checkout.1")
					<br>
					<div class="flex justify-end">
						<button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right"></i></button>
					</div>
				</div>

				<div class="carousel-slide">
					<!-- Contenido del Carousel -->
					@include("shop.checkout.2")
					<br>
					<div class="flex justify-between">
						<button class="btnPrev"><i class="fa-solid fa-chevron-left"></i> Anterior</button>
						<button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right"></i></button>
					</div>
				</div>
			
				<div class="carousel-slide">
					<!-- Contenido del Carousel -->
					<br>
					<div class="flex justify-between">
						<button class="btnPrev w125px"><i class="fa-solid fa-chevron-left"></i> Anterior</button>
						<button class="btn-primary w250px">Finalizar compra</button>
					</div>
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

					// move slide by -100%
					slides.forEach((slide, indx) => {
						slide.style.transform = `translateX(${-100 * curSlide}%)`;
						smoothScroll("top");
					});
				});
			});

			prevButtons.forEach(button => {
				button.addEventListener("click", function () {
					if (curSlide > 0) --curSlide;

					// move slide by 100%
					slides.forEach((slide, indx) => {
						slide.style.transform = `translateX(${-100 * curSlide}%)`;
						smoothScroll("top");
					});
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
