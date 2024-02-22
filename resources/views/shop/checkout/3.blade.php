<div class="carousel-slide">
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    <div class="panel">
        <div class="panel-title panel-title-underlined">Forma de pago</div>
        <div class="panel-content">
            <div class="input-group">
                @foreach($mediosPagoListado as $medio)
                    <div class="radio-fix">
                        @if($medioPagoSeleccionado == $medio["id"])
                            <input type="radio" required name="radio_medioPago" id="radio_medioPago_{{ $medio['id'] }}" value="{{ $medio['id'] }}" checked>
                        @else
                            <input type="radio" required name="radio_medioPago" id="radio_medioPago_{{ $medio['id'] }}" value="{{ $medio['id'] }}">
                        @endif
                        <label for="radio_medioPago_{{ $medio['id'] }}">{{ $medio["medio"] }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <!-- Contenido -->
    <div class="panel" id="shipmentPanel">
        <div class="panel-title panel-title-underlined">Envío</div>
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
                        <input type="text" id="codigo_postal" name="codigo_postal" value="8000">
                    </label>
                    <label>
                        Ciudad:
                        <input type="text" id="localidad" name="localidad" value="Bahía Blanca">
                    </label>
                    <label>
                        Domicilio
                        <input type="text" id="domicilio" name="domicilio" value="Sócrates">
                    </label>
                    <div class="flex gap-3">
                        <label>
                            Número
                            <input type="text" id="domicilio_nro" name="domicilio_nro" value="1234">
                        </label>
                        <label>
                            Piso
                            <input type="text" id="domicilio_piso" name="domicilio_piso" value="PB">
                        </label>
                        <label>
                            Departamento
                            <input type="text" id="domicilio_depto" name="domicilio_depto" value="3">
                        </label>
                    </div>
                    <label>
                        Instrucciones de entrega
                        <textarea name="domicilio_aclaraciones">Portón blanco</textarea>
                    </label>
                </div>
            </div>
            <!-- /Datos envío -->

        </div>
    </div>
</div>