@extends("shop.layout.master")

@php
    $title = "Alta de usuarios";
@endphp

@section("title", $title)

@php
    $breadcrumbs = [
    ];
@endphp

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}alert.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}layout.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}panel.css">
@endsection

@section("js")
    <script defer src="{{  config('constants.framework_js') }}alert.js"></script>
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
			width: 					400%;
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

        <div class="carousel-container">
            <div class="carousel-slider">
                
                <!-- Pantalla 1 -->
                @include('shop.register.1')

                <!-- Pantalla 2 -->
                @include('shop.register.2')

                <!-- Pantalla 3 -->
                @include('shop.register.3')

                <!-- Pantalla 4 -->
                @include('shop.register.4')
            </div>
        </div>
    </div>

    <form id="form" method="post">@csrf</form>
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

            function smoothScroll(id) {
                const element = document.getElementById(id);
                if(element)
                    element.scrollIntoView({ block: "start", behavior: "smooth" });
            }

            const errorFields = document.querySelectorAll(".form-error");

            errorFields.forEach(errorField => {
                errorField.addEventListener("input", function () {
                    errorField.classList.remove("form-error");
                    const errorMessage = errorField.closest(".panel").querySelector(".field-validation-msg");
                    if (errorMessage) {
                        errorMessage.remove();
                    }
                });
            });

            if (errorFields.length > 0) {
                const elementLabel = errorFields[0].closest(".panel");
                setTimeout(function() { 
                    smoothScroll(elementLabel);
                }, 1000);
                errorFields[0].focus();
            }
        });
    </script>
@endsection