<div class="carousel-slide">
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    <div class="panel" id="shipmentPanel">
        <div class="panel-title panel-title-underlined">5 - Envío</div>
        <div class="panel-content">
            <div class="input-group">
                @foreach($mediosEnvioListado as $envio)
                    <div class="radio-fix">
                        @if($medioEnvioSeleccionado == $envio["id"])
                            <input form="form" type="radio" required name="radio_medioEnvio" id="radio_medioEnvio_{{ $envio['id'] }}" value="{{ $envio['id'] }}" checked>
                        @else
                            <input form="form" type="radio" required name="radio_medioEnvio" id="radio_medioEnvio_{{ $envio['id'] }}" value="{{ $envio['id'] }}">
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
                        <input form="form" type="text" name="input_codigoPostal" value="{{ session('shop.usuario.datos.codigo_postal') }}">
                    </label>
                    <label>
                        Ciudad:
                        <input form="form" type="text" name="input_ciudad" value="{{ session('shop.usuario.datos.localidad') }}">
                    </label>
                    <label>
                        Domicilio
                        <input form="form" type="text" name="input_domicilio" value="{{ session('shop.usuario.datos.domicilio') }}">
                    </label>
                    <div class="flex">
                        <label>
                            Número
                            <input form="form" name="input_domicilioNro" value="{{ session('shop.usuario.datos.domicilio_nro') }}">
                        </label>
                        <label>
                            Piso
                            <input form="form" name="input_domicilioPiso" value="{{ session('shop.usuario.datos.domicilio_piso') }}">
                        </label>
                        <label>
                            Departamento
                            <input form="form" name="input_domicilioDepto" value="{{ session('shop.usuario.datos.domicilio_depto') }}">
                        </label>
                    </div>
                    <label>
                        Instrucciones de entrega
                        <textarea form="form" name="textarea_aclaraciones">{{ session('shop.usuario.datos.domicilio_aclaraciones') }}</textarea>
                    </label>
                </div>
            </div>
            <!-- /Datos envío -->

        </div>
    </div>
</div>