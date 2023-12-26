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

        form {
            width: 100%;
        }
	</style>
@endsection

@section("body")
    <div class="main-container">
        @include("shop.layout.breadcrumb")

        <div class="carousel-container">
            <div class="carousel-slider">
                
                <!-- Pantalla 1 -->
                <form method="post" class="step-form" data-step="1">
                    <input type="hidden" name="currentStep" value="1">
                    @csrf
                    @include('shop.register.1')
                </form>

                <!-- Pantalla 2 -->
                <form method="post" class="step-form" data-step="2">
                    <input type="hidden" name="currentStep" value="2">
                    @csrf
                    @include('shop.register.2')
                </form>

                <!-- Pantalla 3 -->
                <form method="post" class="step-form" data-step="3">
                    <input type="hidden" name="currentStep" value="3">
                    @csrf
                    @include('shop.register.3')
                </form>

                <!-- Pantalla 4 -->
                <form method="post" class="step-form" data-step="4">
                    <input type="hidden" name="currentStep" value="4">
                    @csrf
                    @include('shop.register.4')
                </form>
            </div>
        </div>
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

            const forms         = document.getElementsByClassName('step-form');

            let datosRecopilados = {};

            for (let i = 0; i < forms.length; i++) {
                forms[i].addEventListener('submit', function (event) {
                    event.preventDefault();

                // Recopilar datos del formulario actual
                var formData = new FormData(event.target);
                for (var [key, value] of formData.entries()) {
                    datosRecopilados[key] = value;
                }

                // Verificar si es el último formulario
                if (esUltimoFormulario(event.target)) {
                    // Todos los formularios han sido enviados, puedes usar datosRecopilados para crear el modelo
                    console.log('Datos completos:', datosRecopilados);
                }
            })};

            function esUltimoFormulario(formulario) {

                // Lógica para determinar si es el último formulario, por ejemplo, basado en la clase, el índice, etc.

                if(formulario.dataset.step==='4')
                    return true;

                return false;
            }

            nextButtons.forEach(button => {
                button.addEventListener("click", function () {
                    submitForm();
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

            function submitForm() {
                const button = event.target;
                const form = button.closest(".step-form");

                if (form) {
                    // Recopilar datos de todos los formularios anteriores y el formulario actual
                    const allForms = document.querySelectorAll(".step-form");
                    const formData = new FormData();

                    allForms.forEach((form, index) => {
                        // Solo recopila datos del formulario actual y los formularios anteriores
                        if (index <= curSlide) {
                            const formFields = new FormData(form);
                            formFields.forEach((value, key) => {
                                formData.append(key, value);
                            });
                        }
                    });

                    fetch(form.action, {
                        method: form.method,
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Respuesta del servidor:", data);

                        if (data["success"] === true) {
        if (data['redirect_url']) {
            // Redirigir a la URL proporcionada por el servidor
            window.location.href = data['redirect_url'];
        } else if (curSlide < maxSlide) {
            ++curSlide;
            slides.forEach((slide, indx) => {
                slide.style.transform = `translateX(${-100 * curSlide}%)`;
            });
            smoothScroll("top");
        }
    }
})
                    .catch(error => {
                        console.error("Error al enviar el formulario:", error);
                    });
                }
            }

        });
    </script>
@endsection