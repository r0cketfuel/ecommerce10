<div class="panel">
    <div class="panel-title panel-title-underlined">Cómo vas a abonar tu compra?</div>
    <div class="panel-content">
        <div class="input-group">
            @foreach($mediosPagoListado as $medio)
                <div class="radio-fix">
                    @if($medioPagoSeleccionado == $medio["id"])
                        <input form="form" type="radio" required name="radio_medioPago" id="radio_medioPago_{{ $medio['id'] }}" value="{{ $medio['id'] }}" checked>
                    @else
                        <input form="form" type="radio" required name="radio_medioPago" id="radio_medioPago_{{ $medio['id'] }}" value="{{ $medio['id'] }}">
                    @endif
                    <label for="radio_medioPago_{{ $medio['id'] }}">{{ $medio["medio"] }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>