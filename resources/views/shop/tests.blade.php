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
			transition: 			all 0.5s;
		}

		.panel {
			box-shadow: 			none;
		}
	</style>
@endsection

@section("body")
    <div class="main-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/shop"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > Página de pruebas
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
					<div class="flex">
						<button class="btnPrev">Anterior</button>
						<button class="btnNext">siguiente</button>
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
					<div class="flex">
						<button class="btnPrev">Anterior</button>
						<button class="btnNext">siguiente</button>
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
					<div class="flex">
						<button class="btnPrev">Anterior</button>
						<button class="btnNext">siguiente</button>
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

			// loop through slides and set each slide's translateX property to index * 100% 
			slides.forEach((slide, indx) => {
				slide.style.transform = `translateX(${indx * 100}%)`;
				slide.style.display = "block";
			});

			nextButtons.forEach(button => {
				button.addEventListener("click", function () {
					if (curSlide < maxSlide) ++curSlide;

					// move slide by -100%
					slides.forEach((slide, indx) => {
						slide.style.transform = `translateX(${100 * (0 - curSlide)}%)`;
					});
				});
			});

			prevButtons.forEach(button => {
				button.addEventListener("click", function () {
					if (curSlide > 0) --curSlide;

					// move slide by 100%
					slides.forEach((slide, indx) => {
						slide.style.transform = `translateX(${100 * (0 - curSlide)}%)`;
					});
				});
			});
		});
    </script>
@endsection
