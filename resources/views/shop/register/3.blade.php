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
                <input type="text" name="domicilio" value="{{ old('domicilio') }}" {{ ($errors->first("domicilio") ? " class=form-error" : "") }}>
                {!! $errors->first("domicilio", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Domicilio número
                <input type="text" name="domicilio_nro" value="{{ old('domicilio_nro') }}" {{ ($errors->first("domicilio_nro") ? " class=form-error" : "") }}>
                {!! $errors->first("domicilio_nro", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Domicilio piso
                <input type="text" name="domicilio_piso" value="{{ old('domicilio_piso') }}" {{ ($errors->first("domicilio_piso") ? " class=form-error" : "") }}>
                {!! $errors->first("domicilio_piso", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Domicilio depto
                <input type="text" name="domicilio_depto" value="{{ old('domicilio_depto') }}" {{ ($errors->first("domicilio_depto") ? " class=form-error" : "") }}>
                {!! $errors->first("domicilio_depto", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Localidad
                <input type="text" name="localidad" value="{{ old('localidad') }}" {{ ($errors->first("localidad") ? " class=form-error" : "") }}>
                {!! $errors->first("localidad", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Código postal
                <input type="text" name="codigo_postal" value="{{ old('codigo_postal') }}" {{ ($errors->first("codigo_postal") ? " class=form-error" : "") }}>
                {!! $errors->first("codigo_postal", "<p class='field-validation-msg'>:message</p>") !!}
            </label>
        </div>
    </div>
</div>