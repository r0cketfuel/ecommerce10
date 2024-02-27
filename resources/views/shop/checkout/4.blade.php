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
            @for($i=0;$i < count($checkout["items"]);++$i)

                @php
                    $id             = $checkout["items"][$i]["id"];
                    $atributosId    = $checkout["items"][$i]["atributos_id"];
                    $nombre         = $checkout["items"][$i]["nombre"];
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

                <div class="grid grid-cols-2">
                    <p>Artículo:</p><p>{{ $nombre }}</p>
                    <p>Cantidad:</p><p>{{ $cantidad }}</p>
                    <p>Talle:</p><p>{{ $talle_id }}</p>
                    <p>Color:</p><p>{{ $color }}</p>
                    <p>Precio:</p><p>{{ $precio }}</p>
                    <p>Subtotal:</p><p>{{ $subtotal }}</p>
                </div>
            @endfor

            <!-- Contenido -->
            <div class="panel-title panel-title-underlined">Datos facturación</div>
            <div class="grid grid-cols-2">
                <p>Apellidos:</p><p>{{ session('shop.checkout.datos.apellidos') }}</p>
                <p>Nombres:</p><p>{{ session('shop.checkout.datos.nombres') }}</p>
                <p>Número de documento:</p><p>{{ session('shop.checkout.datos.documento_nro') }}</p>
                <p>Correo electrónico:</p><p>{{ session('shop.checkout.datos.email') }}</p>
            </div>

            <!-- Contenido -->
            <div class="panel-title panel-title-underlined">Forma de pago y envío</div>
            <div class="grid grid-cols-2">
                <p>Forma de pago:</p><p>{{ session('shop.checkout.medio_pago.medio') }}</p>
                <p>Envío:</p><p>{{ session('shop.checkout.medio_envio.medio') }}</p>
            </div>
        </div>
    </div>
</div>