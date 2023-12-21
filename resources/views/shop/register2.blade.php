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
    <script defer src="{{  config('constants.framework_js') }}formError.js"></script>
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
                <div class="carousel-slide">
                    <div class="flex justify-end">
                        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
                    </div>
                    <br>
                    <!-- Contenido -->
                    <div class="panel">
                        <div class="panel-title panel-title-underlined">Usuario y contraseña</div>
                        <div class="panel-content">
                            <label>
                                Usuario
                                <input  form="form" type="text" id="username" name="username" value="{{  old('username') }}" {{ ($errors->first("username") ? " class=form-error" : "") }} autocomplete="off">
                                {!! $errors->first("username", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Password
                                <input  form="form" type="password" id="password" name="password" value="{{  old('password_repeat') }}" {{ ($errors->first("password") ? " class=form-error" : "") }}>
                                {!! $errors->first("password", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Repetir password
                                <input  form="form" type="password" id="password_repeat" name="password_repeat" value="{{  old('password_repeat') }}" {{ ($errors->first("password_repeat") ? " class=form-error" : "") }}>
                                {!! $errors->first("password_repeat", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Pantalla 2 -->
                <div class="carousel-slide">
                    <div class="flex justify-between">
                        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
                        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
                    </div>
                    <br>
                    <!-- Contenido -->
                    <div class="panel">
                        <div class="panel-title panel-title-underlined">Datos personales</div>
                        <div class="panel-content">
                            <div class="flex">
                                <label>
                                    Apellidos
                                    <input form="form" type="text" name="apellidos" value="{{  old('apellidos') }}" {{ ($errors->first("apellidos") ? " class=form-error" : "") }}>
                                    {!! $errors->first("apellidos", "<p class='field-validation-msg'>:message</p>") !!}
                                </label>

                                <label>
                                    Nombres
                                    <input form="form" type="text" name="nombres" value="{{  old('nombres') }}" {{ ($errors->first("nombres") ? " class=form-error" : "") }}>
                                    {!! $errors->first("nombres", "<p class='field-validation-msg'>:message</p>") !!}
                                </label>
                            </div>

                            <div class="flex">
                                <label>
                                    Fecha de nacimiento
                                    <input form="form" type="date" name="fecha_nacimiento" max="{{  date('Y-m-d') }}" value="{{ old('fecha_nacimiento') }}">
                                    {!! $errors->first("fecha_nacimiento", "<p class='field-validation-msg'>:message</p>") !!}
                                </label>

                                <label>
                                    Género
                                    <select form="form" name="genero_id" {{ $errors->first("genero_id") ? "class=form-error" : "" }}>
                                        <option value="" selected disabled>Seleccione</option>
                                        @foreach ($generos as $genero)
                                            <option value="{{ $genero->id }}" @selected(old('genero_id') == $genero->id)>{{ $genero->genero }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first("genero_id", "<p class='field-validation-msg'>:message</p>") !!}
                                </label>
                            </div>

                            <label>
                                Tipo de documento
                                <select form="form" name="tipo_documento_id" {{ $errors->first("tipo_documento_id") ? "class=form-error" : "" }}>
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach ($tiposDocumentos as $tipoDocumento)
                                        <option value="{{ $tipoDocumento->id }}" @selected(old('tipo_documento_id') == $tipoDocumento->id)>{{ $tipoDocumento->tipo }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first("tipo_documento_id", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Número de documento
                                <input form="form" type="text"  name="documento_nro" value="{{ old('documento_nro') }}" {{ ($errors->first("documento_nro") ? " class=form-error" : "") }}>
                                {!! $errors->first("documento_nro", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Cuil
                                <input form="form" type="text" name="cuil" value="{{ old('cuil') }}" {{ ($errors->first("cuil") ? " class=form-error" : "") }}>
                                {!! $errors->first("cuil", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Cuit
                                <input form="form" type="text" name="cuit" value="{{ old('cuit') }}" {{ ($errors->first("cuit") ? " class=form-error" : "") }}>
                                {!! $errors->first("cuit", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Pantalla 3 -->
                <div class="carousel-slide">
                    <div class="flex justify-between">
                        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
                        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
                    </div>
                    <br>
                    <!-- Contenido -->
                    <div class="panel">
                        <div class="panel-title panel-title-underlined">Domicilio</div>
                        <div class="panel-content">
                            <label>
                                Domicilio
                                <input form="form" type="text" name="domicilio" value="{{ old('domicilio') }}" {{ ($errors->first("domicilio") ? " class=form-error" : "") }}>
                                {!! $errors->first("domicilio", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Domicilio número
                                <input form="form" type="text" name="domicilio_nro" value="{{ old('domicilio_nro') }}" {{ ($errors->first("domicilio_nro") ? " class=form-error" : "") }}>
                                {!! $errors->first("domicilio_nro", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Domicilio piso
                                <input form="form" type="text" name="domicilio_piso" value="{{ old('domicilio_piso') }}" {{ ($errors->first("domicilio_piso") ? " class=form-error" : "") }}>
                                {!! $errors->first("domicilio_piso", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Domicilio depto
                                <input form="form" type="text" name="domicilio_depto" value="{{ old('domicilio_depto') }}" {{ ($errors->first("domicilio_depto") ? " class=form-error" : "") }}>
                                {!! $errors->first("domicilio_depto", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Localidad
                                <input form="form" type="text" name="localidad" value="{{ old('localidad') }}" {{ ($errors->first("localidad") ? " class=form-error" : "") }}>
                                {!! $errors->first("localidad", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Código postal
                                <input form="form" type="text" name="codigo_postal" value="{{ old('codigo_postal') }}" {{ ($errors->first("codigo_postal") ? " class=form-error" : "") }}>
                                {!! $errors->first("codigo_postal", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Pantalla 4 -->
                <div class="carousel-slide">
                    <div class="flex justify-between">
                        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
                    </div>
                    <br>
                    <!-- Contenido -->
                    <div class="panel">
                        <div class="panel-title panel-title-underlined">Datos de contacto</div>
                        <div class="panel-content">
                            <label>
                                Teléfono fijo
                                <input form="form" type="text" name="telefono_fijo" value="{{ old('telefono_fijo') }}" {{ ($errors->first("telefono_fijo") ? " class=form-error" : "") }}>
                                {!! $errors->first("telefono_fijo", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Teléfono celular
                                <input form="form" type="text" name="telefono_celular" value="{{ old('telefono_celular') }}" {{ ($errors->first("telefono_celular") ? " class=form-error" : "") }}>
                                {!! $errors->first("telefono_celular", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Teléfono alternativo
                                <input form="form" type="text" name="telefono_alt" value="{{ old('telefono_alt') }}" {{ ($errors->first("telefono_alt") ? " class=form-error" : "") }}>
                                {!! $errors->first("telefono_alt", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>

                            <label>
                                Correo electrónico
                                <input form="form" type="email" name="email" value="{{ old('email') }}" {{ ($errors->first("email") ? " class=form-error" : "") }} autocomplete="off">
                                {!! $errors->first("email", "<p class='field-validation-msg'>:message</p>") !!}
                            </label>
                                
                            <button form="form" type="submit" class="btn-primary">Registrarme</button>
                        </div>
                    </div>
                </div>
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

            document.getElementById('form').addEventListener('invalid', function (e) {
                e.preventDefault();
                window.scrollTo(0, 0);
                console.log("aca");
            }, true);

        });
    </script>

@endsection