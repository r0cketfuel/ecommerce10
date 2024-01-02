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
            <div class="flex">
                <label>
                    Apellidos
                    <input type="text" name="apellidos">
                </label>

                <label>
                    Nombres
                    <input type="text" name="nombres">
                </label>
            </div>

            <div class="flex">
                <label>
                    Fecha de nacimiento
                    <input type="date" name="fecha_nacimiento" max="{{ date('Y-m-d') }}">
                </label>

                <label>
                    Género
                    <select name="genero_id">
                        <option value="" selected disabled>Seleccione</option>
                        @foreach ($generos as $genero)
                            <option value="{{ $genero->id }}">{{ $genero->genero }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <label>
                Tipo de documento
                <select name="tipo_documento_id">
                    <option value="" selected disabled>Seleccione</option>
                    @foreach ($tiposDocumentos as $tipoDocumento)
                        <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->tipo }}</option>
                    @endforeach
                </select>
            </label>

            <label>
                Número de documento
                <input type="text" name="documento_nro">
            </label>

            <label>
                Cuil
                <input type="text" name="cuil">
            </label>

            <label>
                Cuit
                <input type="text" name="cuit">
            </label>
        </div>
    </div>
</div>