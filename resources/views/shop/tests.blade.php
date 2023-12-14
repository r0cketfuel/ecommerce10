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
			position: 				relative;
			overflow: 				hidden;
		}

		.pantalla {
			position: 				absolute;
			transition: 			all 0.5s;
			width: 					100%;

		}

		.btn {
			position: 				absolute;
			width: 					40px;
			height: 				40px;
			padding: 				10px;
			border: 				none;
			border-radius: 			50%;
			z-index: 				5;
			cursor: 				pointer;
			background-color: 		#fff;
			color:					black;
			border:                 1px solid rgb(230, 230, 230);
			font-size: 				18px;
		}

		.btn:active {
			transform: 				scale(1.1);
		}

		.btn-prev {
			top: 					45%;
			left: 					2%;
		}

		.btn-next {
			top: 					45%;
			right: 					2%;
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

			<div class="pantalla pantalla1">
			
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

			</div>

			<div class="pantalla pantalla2">
			
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

			</div>
			
			<div class="pantalla pantalla3">
			
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

			</div>

			<button class="btn btn-next"><i class="fa-solid fa-chevron-right"></i></button>
			<button class="btn btn-prev"><i class="fa-solid fa-chevron-left"></i></button>
		</div>
		<!-- /Pantallas -->

    </div>
@endsection

@section("scripts")
	<script>
		const slides    = document.querySelectorAll(".pantalla");
		let maxSlide    = slides.length - 1;
		let curSlide    = 0;

		const nextSlide = document.querySelector(".btn-next");
		const prevSlide = document.querySelector(".btn-prev");

		// loop through slides and set each slides translateX property to index * 100% 
		slides.forEach((slide, indx) => {
			slide.style.transform = `translateX(${indx * 100}%)`;
		});

		nextSlide.addEventListener("click", function ()
		{
			if(curSlide < maxSlide) ++curSlide;

			// move slide by -100%
			slides.forEach((slide, indx) => {
				slide.style.transform = `translateX(${100 * (indx - curSlide)}%)`;
			});
		});

		prevSlide.addEventListener("click", function ()
		{
			if(curSlide > 0) --curSlide;

			// move slide by 100%
			slides.forEach((slide, indx) => {
				slide.style.transform = `translateX(${100 * (indx - curSlide)}%)`;
			});
		});
    </script>
@endsection