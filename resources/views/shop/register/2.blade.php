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