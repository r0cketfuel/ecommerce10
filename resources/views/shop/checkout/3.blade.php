<div class="carousel-slide">
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    <div class="panel">
        <div class="panel-title panel-title-underlined">3 - Forma de pago</div>
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
</div>