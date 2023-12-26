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
                <input type="text" id="username" name="username" value="usuario1234" {{ ($errors->first("username") ? " class=form-error" : "") }} autocomplete="off">
                {!! $errors->first("username", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Password
                <input type="password" id="password" name="password" value="password" {{ ($errors->first("password") ? " class=form-error" : "") }}>
                {!! $errors->first("password", "<p class='field-validation-msg'>:message</p>") !!}
            </label>

            <label>
                Repetir password
                <input type="password" id="password_repeat" name="password_repeat" value="password" {{ ($errors->first("password_repeat") ? " class=form-error" : "") }}>
                {!! $errors->first("password_repeat", "<p class='field-validation-msg'>:message</p>") !!}
            </label>
        </div>
    </div>
</div>