@extends("shop.layout.master")

@php
    $title = "Página de pruebas";
@endphp

@section("title", $title)

@section("css")
	<link rel="stylesheet"	href="{{ config('constants.framework_css') }}panel.css">
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
					<div class="panel">
						<div class="panel-title panel-title-underlined">Pantalla 1</div>
						<div class="panel-content">
							<div class="input-group">
								<label>
									Input 1
									<input type="text">
								</label>
								<label>
									Input 2
									<input type="text">
								</label>
								<label>
									Input 3
									<input type="text">
								</label>
								<label>
									Input 4
									<input type="text">
								</label>
								<label>
									Input 5
									<input type="text">
								</label>
							</div>
						</div>
					</div>
					<br>
					<div class="flex justify-end">
						<button class="btnNext w125px">siguiente <i class="fa-solid fa-chevron-right"></i></button>
					</div>
				</div>

				<div class="carousel-slide">
					<div class="panel">
						<div class="panel-title panel-title-underlined">Pantalla 2</div>
						<div class="panel-content">
							<div class="input-group">
								<label>
									Input 1
									<input type="text">
								</label>
								<label>
									Input 2
									<input type="text">
								</label>
								<label>
									Input 3
									<input type="text">
								</label>
							</div>
						</div>
					</div>
					<br>
					<div class="flex justify-between">
						<button class="btnPrev w125px"><i class="fa-solid fa-chevron-left"></i> Anterior</button>
						<button class="btnNext w125px">Siguiente <i class="fa-solid fa-chevron-right"></i></button>
					</div>
				</div>
			
				<div class="carousel-slide">
					<div class="panel">
						<div class="panel-title panel-title-underlined">Pantalla 3</div>
						<div class="panel-content">
							<div class="input-group">
								<label>
									Input 1
									<input type="text">
								</label>
								<label>
									Input 2
									<input type="text">
								</label>
								<label>
									Input 3
									<input type="text">
								</label>
								<label>
									Input 4
									<input type="text">
								</label>
								<label>
									Input 5
									<input type="text">
								</label>
								<label>
									Input 6
									<input type="text">
								</label>
								<label>
									Input 7
									<input type="text">
								</label>
								<label>
									Input 8
									<input type="text">
								</label>
								<label>
									Input 9
									<input type="text">
								</label>
								<label>
									Input 10
									<input type="text">
								</label>
							</div>
						</div>
					</div>
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
