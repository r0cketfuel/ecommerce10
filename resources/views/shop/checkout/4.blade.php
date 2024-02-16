<div class="carousel-slide">
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    <div class="panel" id="shipmentPanel">
        <div class="panel-title panel-title-underlined">4 - Envío</div>
        <div class="panel-content">
            <div class="input-group">
                @foreach($mediosEnvioListado as $envio)
                    <div class="radio-fix">
                        @if($medioEnvioSeleccionado == $envio["id"])
                            <input type="radio" name="radio_medioEnvio" id="radio_medioEnvio_{{ $envio['id'] }}" value="{{ $envio['id'] }}" checked>
                        @else
                            <input type="radio" name="radio_medioEnvio" id="radio_medioEnvio_{{ $envio['id'] }}" value="{{ $envio['id'] }}">
                        @endif
                        <label for="radio_medioEnvio_{{ $envio['id'] }}">{{ $envio["medio"] }} @if(isset($envio["costo"])) ({{ _money($envio["costo"]) }}) @endif</label>
                    </div>
                @endforeach
            </div>

            <!-- Datos envío -->
            <div id="shipmentData">
                <br>
                <div class="input-group">
                    <label>
                        Código Postal:
                        <input type="text" name="codigo_postal">
                    </label>
                    <label>
                        Ciudad:
                        <input type="text" name="localidad">
                    </label>
                    <label>
                        Domicilio
                        <input type="text" name="domicilio">
                    </label>
                    <div class="flex gap-3">
                        <label>
                            Número
                            <input name="domicilio_nro">
                        </label>
                        <label>
                            Piso
                            <input name="domicilio_piso">
                        </label>
                        <label>
                            Departamento
                            <input name="domicilio_depto">
                        </label>
                    </div>
                    <label>
                        Instrucciones de entrega
                        <textarea name="domicilio_aclaraciones"></textarea>
                    </label>
                </div>
            </div>
            <!-- /Datos envío -->

        </div>
    </div>
</div>