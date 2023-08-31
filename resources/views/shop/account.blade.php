@extends("shop.layout.master")

@section("title","Mi cuenta")

@section("css")
@endsection

@section("inlineCSS")
@endsection

@section("js")
    <script defer src="/assets/framework/js/accordion.js"></script>
@endsection

@section("body")

    <!-- Contenido de la página -->
    <div class="main-container">

        <h1>Mi cuenta</h1>

        <div class="flex-col gap1" style="max-width: 700px">
            <div class="accordion">
                <div class="accordion-header">Datos personales<span class="arrow"><i class="fa-solid fa-chevron-down"></i></span></div>
                <div class="accordion-panel">
                    <div class="panel-container">
                        <div class="flex">
                            <label>
                                Apellidos
                                <input form="form" id="apellidos" name="apellidos" value="{{session('shop.usuario.apellidos')}}">
                            </label>
                            <label>
                                Nombres
                                <input form="form" id="nombres" name="nombres" value="{{session('shop.usuario.nombres')}}">
                            </label>
                        </div>

                        <div class="flex">
                            <label>
                                Fecha de nacimiento
                                <input form="form" id="fecha_nacimiento" name="fecha_nacimiento" value="{{session('shop.usuario.datos.fecha_nacimiento')}}">
                            </label>

                            <label>
                                Género
                                <select form="form" id="genero_id" name="genero_id">
                                    <option value="" disabled selected>Seleccione...</option>
                                </select> value="{{session('shop.usuario.genero_id')}}">
                            </label>

                            <label>
                                Tipo de documento
                                <select form="form" id="tipo_documento_id" name="tipo_documento_id" required>
                                    <option value="" selected disabled>Seleccione</option>
                                    @foreach($tiposDocumentos as $tipoDocumento)
                                        <option value="{{$tipoDocumento->id}}" @if(session('shop.usuario.datos.tipo_documento_id') == $tipoDocumento->id) selected @endif>{{$tipoDocumento->tipo}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>

                        <label>
                            Número de documento
                            <input form="form" id="documento_nro" name="documento_nro" value="{{session('shop.usuario.datos.documento_nro')}}">
                        </label>

                        <label>
                            Cuil
                            <input form="form" id="cuil" name="cuil" value="{{session('shop.usuario.datos.cuil')}}">
                        </label>

                        <label>
                            Cuit
                            <input form="form" id="cuit" name="cuit" value="{{session('shop.usuario.datos.cuit')}}">
                        </label>

                        <label>
                            Domicilio
                            <input form="form" id="domicilio" name="domicilio" value="{{session('shop.usuario.datos.domicilio')}}">
                        </label>

                        <div class="flex">
                            <label>
                                Domicilio número
                                <input form="form" type="text" id="domicilio_nro" name="domicilio_nro" required value="{{session('shop.usuario.datos.domicilio_nro')}}">
                            </label>
                            
                            <label>
                                Domicilio piso
                                <input form="form" type="text" id="domicilio_piso" name="domicilio_piso" value="{{session('shop.usuario.datos.domicilio_piso')}}">
                            </label>

                            <label>
                                Domicilio depto
                                <input form="form" type="text" id="domicilio_depto" name="domicilio_depto" value="{{session('shop.usuario.datos.domicilio_depto')}}">
                            </label>
                        </div>

                        <label>
                            Localidad
                            <input form="form" type="text" id="localidad" name="localidad" required value="{{session('shop.usuario.datos.localidad')}}">
                        </label>

                        <label>
                            Codigo postal
                            <input form="form" type="text" id="codigo_postal" name="codigo_postal" required value="{{session('shop.usuario.datos.codigo_postal')}}">
                        </label>

                        <label>
                            Teléfono fijo
                            <input form="form" type="text" id="telefono_fijo" name="telefono_fijo" required value="{{session('shop.usuario.datos.telefono_fijo')}}">
                        </label>

                        <label>
                            Teléfono celular
                            <input form="form" type="text" id="telefono_celular" name="telefono_celular" required value="{{session('shop.usuario.datos.telefono_celular')}}">
                        </label>

                        <label>
                            Teléfono alternativo
                            <input form="form" type="text" id="telefono_alt" name="telefono_alt" value="{{session('shop.usuario.datos.telefono_alt')}}">
                        </label>

                        <label>
                            Correo electrónico
                            <input form="form" type="text" id="email" name="email" required value="{{session('shop.usuario.datos.email')}}">
                        </label>

                        <button form="form" name="form" class="btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>

            <div class="accordion">
                <div class="accordion-header">Cambio de contraseña<span class="arrow"><i class="fa-solid fa-chevron-down"></i></span></div>
                <div class="accordion-panel">
                    <div class="panel-container">

                        <label>
                            Password anterior
                            <input form="form-password" type="password" id="password_old" name="password_old" required>
                        </label>

                        <label>
                            Nuevo password
                            <input form="form-password" type="password" id="password_new" name="password_new" required>
                        </label>

                        <label>
                            Repetir password
                            <input form="form-password" type="password" id="password_repeat" name="password_repeat" required>
                        </label>

                        <button form="form-password" name="form-password" class="btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <form id="form" method="post">@csrf</form>
    <form id="form-password" method="post">@csrf</form>

@endsection