<div class="carousel-slide">
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    @include("shop.modals.payment")
    <div class="panel" id="user">
        <div class="panel-title panel-title-underlined">Datos personales</div>
        <div class="panel-content">
            <div class="input-group">

                <label>
                    Apellidos
                    <input form="form-checkout" type="text" id="apellidos" name="apellidos" required pattern="[a-zA-Z]+" title="Sólo se permiten letras" value="{{session('shop.usuario.datos.apellidos')}}">
                </label>

                <label>
                    Nombres
                    <input  form="form-checkout" type="text" id="nombres" name="nombres" required pattern="[a-zA-Z]+" title="Sólo se permiten letras" value="{{session('shop.usuario.datos.nombres')}}">
                </label>
                
                <label>
                    Tipo de documento
                    <select form="form-checkout" id="tipo_documento_id" name="tipo_documento_id" required>
                        <option value="" selected disabled>Seleccione</option>
                        @foreach($tiposDocumentos as $tipoDocumento)
                            <option value="{{$tipoDocumento->id}}" @if(session('shop.usuario.datos.tipo_documento_id') == $tipoDocumento->id) selected @endif>{{$tipoDocumento->tipo}}</option>
                        @endforeach
                    </select>
                </label>

                <label>
                    Número de documento
                    <input form="form-checkout" type="text" id="documento_nro" name="documento_nro" required pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.documento_nro')}}">
                </label>

                <label>
                    Localidad
                    <input form="form-checkout" type="text" id="localidad" name="localidad" required value="{{session('shop.usuario.datos.localidad')}}">
                </label>

                <label>
                    Codigo postal
                    <input form="form-checkout" type="text" id="codigo_postal" name="codigo_postal" required pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.codigo_postal')}}">
                </label>

                <label>
                    Domicilio
                    <input form="form-checkout" type="text" id="domicilio" name="domicilio" required value="{{session('shop.usuario.datos.domicilio')}}">
                </label>

                <div class="flex">
                    <label>
                        Domicilio número
                        <input form="form-checkout" type="text" id="domicilio_nro" name="domicilio_nro" required pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.domicilio_nro')}}">
                    </label>
                    
                    <label>
                        Domicilio piso
                        <input form="form-checkout" type="text" id="domicilio_piso" name="domicilio_piso" value="{{session('shop.usuario.datos.domicilio_piso')}}">
                    </label>

                    <label>
                        Domicilio depto
                        <input form="form-checkout" type="text" id="domicilio_depto" name="domicilio_depto" value="{{session('shop.usuario.datos.domicilio_depto')}}">
                    </label>
                </div>

                <label>
                    Teléfono celular
                    <input form="form-checkout" type="text" id="telefono_celular" name="telefono_celular" required pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.telefono_celular')}}">
                </label>
                <label>
                    Teléfono alternativo
                    <input form="form-checkout" type="text" id="telefono_alt" name="telefono_alt" pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.telefono_alt')}}">
                </label>
                <label>
                    Correo electrónico
                    <input form="form-checkout" type="email" id="email" name="email" required value="{{session('shop.usuario.datos.email')}}">
                </label>
            
            </div>
        </div>
    </div>
</div>