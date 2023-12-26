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
                <input type="text" name="telefono_fijo" value="2914587456" {{ ($errors->first("telefono_fijo") ? " class=form-error" : "") }}>
                {!! $errors->first("telefono_fijo", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Teléfono celular
                <input type="text" name="telefono_celular" value="2914478523" {{ ($errors->first("telefono_celular") ? " class=form-error" : "") }}>
                {!! $errors->first("telefono_celular", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Teléfono alternativo
                <input type="text" name="telefono_alt" value="{{ old('telefono_alt') }}" {{ ($errors->first("telefono_alt") ? " class=form-error" : "") }}>
                {!! $errors->first("telefono_alt", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Correo electrónico
                <input type="email" name="email" value="correo@dominio.com" {{ ($errors->first("email") ? " class=form-error" : "") }} autocomplete="off">
                {!! $errors->first("email", "<p class='field-validation-msg'>:message</p>") !!}
            </label>
                
            <button class="btnNext">Registrarme</button>
        </div>
    </div>
</div>