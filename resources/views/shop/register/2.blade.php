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
                    <input type="text" name="apellidos" value="Apellidos" {{ ($errors->first("apellidos") ? " class=form-error" : "") }}>
                    {!! $errors->first("apellidos", "<p class='field-validation-msg'>:message</p>") !!}
                </label>

                <label>
                    Nombres
                    <input type="text" name="nombres" value="Nombres" {{ ($errors->first("nombres") ? " class=form-error" : "") }}>
                    {!! $errors->first("nombres", "<p class='field-validation-msg'>:message</p>") !!}
                </label>
            </div>

            <div class="flex">
                <label>
                    Fecha de nacimiento
                    <input type="date" name="fecha_nacimiento" max="{{  date('Y-m-d') }}" value="2023-01-01">
                    {!! $errors->first("fecha_nacimiento", "<p class='field-validation-msg'>:message</p>") !!}
                </label>

                <label>
                    Género
                    <select name="genero_id" {{ $errors->first("genero_id") ? "class=form-error" : "" }}>
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->id }}" @selected(1)>{{ $genero->genero }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first("genero_id", "<p class='field-validation-msg'>:message</p>") !!}
                </label>
            </div>

            <label>
                Tipo de documento
                <select name="tipo_documento_id" {{ $errors->first("tipo_documento_id") ? "class=form-error" : "" }}>
                    <option value="" selected disabled>Seleccione</option>
                    @foreach ($tiposDocumentos as $tipoDocumento)
                        <option value="{{ $tipoDocumento->id }}" @selected(1)>{{ $tipoDocumento->tipo }}</option>
                    @endforeach
                </select>
                {!! $errors->first("tipo_documento_id", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Número de documento
                <input type="text"  name="documento_nro" value="31478552" {{ ($errors->first("documento_nro") ? " class=form-error" : "") }}>
                {!! $errors->first("documento_nro", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Cuil
                <input type="text" name="cuil" value="{{ old('cuil') }}" {{ ($errors->first("cuil") ? " class=form-error" : "") }}>
                {!! $errors->first("cuil", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Cuit
                <input type="text" name="cuit" value="{{ old('cuit') }}" {{ ($errors->first("cuit") ? " class=form-error" : "") }}>
                {!! $errors->first("cuit", "<p class='field-validation-msg'>:message</p>") !!}
            </label>
        </div>
    </div>
</div>