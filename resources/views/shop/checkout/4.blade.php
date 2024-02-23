<div class="carousel-slide">
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    <div class="panel" id="payment">
        <div class="panel-title panel-title-underlined">Resumen de compra</div>
        <div class="panel-content">

            <!-- Contenido -->
            <div class="panel">
                <div class="panel-title panel-title-underlined">1 - Carrito de compras</div>
                <div class="panel-content">
                    @for($i=0;$i < count($checkout["items"]);++$i)

                        @php
                            $id             = $checkout["items"][$i]["id"];
                            $atributosId    = $checkout["items"][$i]["atributos_id"];
                            $descripcion    = $checkout["items"][$i]["descripcion"];
                            $precio         = $checkout["items"][$i]["precio"];
                            $imagen         = $checkout["items"][$i]["imagen"] ? $checkout["items"][$i]["imagen"] : asset('images/content/no-image.png');
                            $cantidad 	    = $checkout["items"][$i]["cantidad"];
                            $subtotal       = $checkout["items"][$i]["subtotal"];
                            $total          = $checkout["total"];

                            $precio         = _money($precio);
                            $subtotal       = _money($subtotal);
                            $total          = _money($total);

                            $opciones       = $checkout["items"][$i]["opciones"];
                            $talle_id       = $checkout["items"][$i]["opciones"]["talle_id"]    ?? null;
                            $color          = $checkout["items"][$i]["opciones"]["color"]       ?? null;
                        @endphp

                        <ul class="product-checkout-card" data-id="{{ $id }}">
                            <li>{{ $cantidad }} x <span>{{ $descripcion }}</span></li>
                            <li>
                                <img src="{{ $imagen }}" alt="imagen">
                            </li>
                            <li>Talle</li>
                            <li>{{ $talle_id }}</li>
                            <li>Color</li>
                            <li>{{ $color }}</li>
                            <li>Precio</li>
                            <li>{{ $precio }}</li>
                            <li>Subtotal</li>
                            <li>{{ $subtotal }}</li>
                            <div class="product-checkout-card-extra">
                                <button class="btn-link" data-id="{{ $id }}" data-atributos_id="{{ $atributosId }}" onclick="itemRemove(this.dataset)"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        </ul>
                    @endfor
                </div>
            </div>

            <!-- Contenido -->
            <div class="panel">
                <div class="panel-title panel-title-underlined">Datos facturación</div>
                <div class="panel-content">
                    <div class="grid grid-cols-2">
                        <p>Apellidos:</p><p>Apellidos</p>
                        <p>Nombres:</p><p>Nombres</p>
                        <p>Tipo de documento:</p><p>Tipo de documento</p>
                        <p>Número de documento:</p><p>Número de documento</p>
                        <p>Teléfono celular:</p><p>Teléfono celular</p>
                        <p>Correo electrónico:</p><p>Correo electrónico</p>
                    </div>
                </div>
            </div>

            <!-- Contenido -->
            <div class="panel">
                <div class="panel-title panel-title-underlined">Forma de pago y envío</div>
                <div class="panel-content">
                    <div class="grid grid-cols-2">
                        <p>Forma de pago:</p><p>Forma de pago</p>
                        <p>Envío:</p><p>Envío</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>