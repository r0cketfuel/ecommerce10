<div class="carousel-slide">
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    <div class="panel">
        <div class="panel-title panel-title-underlined">2 - Datos facturación</div>
        <div class="panel-content">
            <div class="flex gap-3">
                <label>
                    Apellidos
                    <input type="text" name="apellidos" pattern="[a-zA-Z]+" title="Sólo se permiten letras" value="{{session('shop.usuario.datos.apellidos')}}">
                </label>

                <label>
                    Nombres
                    <input type="text" name="nombres" pattern="[a-zA-Z]+" title="Sólo se permiten letras" value="{{session('shop.usuario.datos.nombres')}}">
                </label>
            </div>
            <div class="flex gap-3">
                <label>
                    Tipo de documento
                    <select name="tipo_documento_id">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach($tiposDocumentos as $tipoDocumento)
                            <option value="{{$tipoDocumento->id}}" @if(session('shop.usuario.datos.tipo_documento_id') == $tipoDocumento->id) selected @endif>{{$tipoDocumento->tipo}}</option>
                        @endforeach
                    </select>
                </label>

                <label>
                    Número de documento
                    <input type="text" name="documento_nro" pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.documento_nro')}}">
                </label>
            </div>
            <div class="flex gap-3">
                <label>
                    Teléfono celular
                    <input type="text" name="telefono_celular" pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.telefono_celular')}}">
                </label>

                <label>
                    Teléfono alternativo
                    <input type="text" name="telefono_alt" pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.telefono_alt')}}">
                </label>
            </div>

            <label>
                Correo electrónico
                <input type="email" name="email" value="{{session('shop.usuario.datos.email')}}" autocomplete="off">
            </label>
        </div>
    </div>
</div>