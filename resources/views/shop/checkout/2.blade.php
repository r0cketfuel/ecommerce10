<div class="carousel-slide">
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    <div class="panel">
        <div class="panel-title panel-title-underlined">Datos personales</div>
        <div class="panel-content">
            <div class="flex gap-3">
                <label>
                    Apellidos
                    <input type="text" id="apellidos" name="apellidos" required pattern="[a-zA-Z]+" title="Sólo se permiten letras" value="{{session('shop.usuario.datos.apellidos')}}">
                </label>

                <label>
                    Nombres
                    <input  form="form-checkout" type="text" id="nombres" name="nombres" required pattern="[a-zA-Z]+" title="Sólo se permiten letras" value="{{session('shop.usuario.datos.nombres')}}">
                </label>
            </div>
            <div class="flex gap-3">
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
            </div>

            <label>
                Correo electrónico
                <input form="form-checkout" type="email" id="email" name="email" required value="{{session('shop.usuario.datos.email')}}" autocomplete="off">
            </label>
        </div>
    </div>
</div>