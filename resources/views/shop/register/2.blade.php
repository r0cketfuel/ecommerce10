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
                    <input type="text" name="apellidos" tabindex="1">
                </label>

                <label>
                    Nombres
                    <input type="text" name="nombres" tabindex="2">
                </label>
            </div>

            <div class="flex">
                <label>
                    Fecha de nacimiento
                    <input type="date" name="fecha_nacimiento" max="{{ date('Y-m-d') }}" tabindex="3">
                </label>

                <label>
                    Género
                    <select name="genero_id" tabindex="4">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <label>
                Tipo de documento
                <select name="tipo_documento_id" tabindex="5">
                    <option value="" selected disabled>Seleccione</option>
                    @foreach ($tiposDocumentos as $tipoDocumento)
                        <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->tipo }}</option>
                    @endforeach
                </select>
            </label>

            <label>
                Número de documento
                <input type="text"  name="documento_nro" tabindex="6">
            </label>

            <label>
                Cuil
                <input type="text" name="cuil" tabindex="7">
            </label>

            <label>
                Cuit
                <input type="text" name="cuit" tabindex="8">
            </label>
        </div>
    </div>
</div>