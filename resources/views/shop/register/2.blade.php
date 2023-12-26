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
                    <input type="text" name="apellidos" tabindex="1" {{ ($errors->first("apellidos") ? " class=form-error" : "") }}>
                    {!! $errors->first("apellidos", "<p class='field-validation-msg'>:message</p>") !!}
                </label>

                <label>
                    Nombres
                    <input type="text" name="nombres" tabindex="2" {{ ($errors->first("nombres") ? " class=form-error" : "") }}>
                    {!! $errors->first("nombres", "<p class='field-validation-msg'>:message</p>") !!}
                </label>
            </div>

            <div class="flex">
                <label>
                    Fecha de nacimiento
                    <input type="date" name="fecha_nacimiento" max="{{  date('Y-m-d') }}" tabindex="3">
                    {!! $errors->first("fecha_nacimiento", "<p class='field-validation-msg'>:message</p>") !!}
                </label>

                <label>
                    Género
                    <select name="genero_id" tabindex="4" {{ $errors->first("genero_id") ? "class=form-error" : "" }}>
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first("genero_id", "<p class='field-validation-msg'>:message</p>") !!}
                </label>
            </div>

            <label>
                Tipo de documento
                <select name="tipo_documento_id" tabindex="5" {{ $errors->first("tipo_documento_id") ? "class=form-error" : "" }}>
                    <option value="" selected disabled>Seleccione</option>
                    @foreach ($tiposDocumentos as $tipoDocumento)
                        <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->tipo }}</option>
                    @endforeach
                </select>
                {!! $errors->first("tipo_documento_id", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Número de documento
                <input type="text"  name="documento_nro" tabindex="6" {{ ($errors->first("documento_nro") ? " class=form-error" : "") }}>
                {!! $errors->first("documento_nro", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Cuil
                <input type="text" name="cuil" tabindex="7" {{ ($errors->first("cuil") ? " class=form-error" : "") }}>
                {!! $errors->first("cuil", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Cuit
                <input type="text" name="cuit" tabindex="8" {{ ($errors->first("cuit") ? " class=form-error" : "") }}>
                {!! $errors->first("cuit", "<p class='field-validation-msg'>:message</p>") !!}
            </label>
        </div>
    </div>
</div>