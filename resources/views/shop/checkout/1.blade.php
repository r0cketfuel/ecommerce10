<div class="carousel-slide">
    <div class="flex justify-end">
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    <div class="panel">
        <div class="panel-title panel-title-underlined">Usuario y contraseña</div>
        <div class="panel-content">

            @for($i=0;$i < count($checkout["items"]);++$i)

                @php
                    $id             = $checkout["items"][$i]["id"];
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
                        <ul>
                            <li><button class="btn-link" data-id="{{ $id }}" data-talle_id="{{ $talle_id }}" data-color="{{ $color }}" onclick="modalUpdateItem(this.dataset)"><i class="fa-solid fa-pen"></i></button></li>
                            <li><button class="btn-link" data-id="{{ $id }}" data-talle_id="{{ $talle_id }}" data-color="{{ $color }}" onclick="itemRemove(this.dataset)"><i class="fa-solid fa-xmark"></i></button></li>
                        </ul>
                    </div>
                </ul>
            @endfor

        </div>
    </div>
</div>