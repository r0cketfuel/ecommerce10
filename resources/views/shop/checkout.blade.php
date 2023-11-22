@extends("shop.layout.master")

@php
    $title = "Checkout";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}productCards.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}panel.css">
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}modal.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.shop_js') }}ajax.js"></script>
    <script defer src="{{ config('constants.shop_js') }}cart.js"></script>
    <script defer src="{{ config('constants.shop_js') }}checkout.js"></script>
@endsection

@section("inlineCSS")
    <style>
        .checkout-panels {
            display:                        flex;
            flex-flow:                      row wrap;
            margin:                         0 auto;
            width:                          100%;
            max-width:                      900px;
            gap:                            20px;
        }

        .checkout-panels>div:nth-child(1) {
            flex:                           9999 1;
        }

        .checkout-panels>div:nth-child(2) {
            flex:                           1 1 250px;
        }
    </style>
@endsection

@section("body")

    <!-- Contenido de la página -->
    <div class="main-container">

        @include("shop.modals.addItem")

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/shop"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > Checkout
        </div>

        @if(count($checkout["items"])>0)

            <!-- Paneles -->
            <div class="checkout-panels">
                
                <!-- Paneles izquierda -->
                <div class="flex-col">
            
                    <!-- Panel carrito de compras -->
                    <div class="panel">
                        <div class="panel-title panel-title-underlined">Carrito de compras</div>
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
                    <!-- /Panel carrito de compras -->
            
                    <!-- Panel Medio de pago -->
                    <div class="panel">
                        <div class="panel-title panel-title-underlined">Medio de pago</div>
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
                    <!-- /Panel Medio de pago -->
            
                    <!-- Panel envío -->
                    <div class="panel" id="shipmentPanel" style="display: none;">
                        <div class="panel-title panel-title-underlined">Envío</div>
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
                            <div id="shipmentData" style="display: none;">
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
                    <!-- /Panel envío -->
            
                </div>
                <!-- /Paneles izquierda -->
            
                <!-- Paneles derecha -->
                <div class="flex-col">
            
                    <!-- Panel resumen de compra -->
                    <div class="panel">
                        <div class="panel-title panel-title-underlined">Resumen de compra</div>
                        <div class="panel-content">
                            <div class="flex-col gap1">
                                <div class="flex justify-between">
                                    <div class="text-bold">Subtotal:</div>
                                    <div id="sub-total">{{ $total }}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-bold">Envío:</div>
                                    <div id="envio">{{ _money(0) }}</div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="text-bold">Descuentos:</div>
                                    <div id="descuentos">
                                        <?php
                                            if(isset($_SESSION["shop"]["checkout"]["cupon"]) && count($_SESSION["shop"]["checkout"]["cupon"])>0)
                                            {
                                                if($_SESSION["shop"]["checkout"]["cupon"]["tipoDescuento"]==="%")
                                                {
                                                    $descuento = $checkout["total"] * $_SESSION["shop"]["checkout"]["cupon"]["descuento"] / 100;
                                                    echo _money($descuento);
                                                }
                                            }
                                            else
                                            {
                                                echo _money(0);
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div style="border-bottom: 1px solid; margin: 5px 0;"><div style="flex: 1 1;"></div></div>
            
                                <div class="flex justify-between">
                                    <div class="text-bold">Total:</div>
                                    <div id="total">
                                        <?php
                                            if(isset($_SESSION["shop"]["checkout"]["cupon"]) && count($_SESSION["shop"]["checkout"]["cupon"])>0)
                                            {
                                                echo _money($checkout["total"] - $descuento);
                                            }
                                            else
                                            {
                                                echo _money($checkout["total"]);
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Panel resumen de compra -->
            
                    <!-- Panel cupon de descuento -->
                    <div class="panel">
                        <div class="panel-title panel-title-underlined">Cupon de descuento</div>
                        <div class="panel-content">
                            <div class="flex-col">
                                <input type="text" name="input_coupon">
                                <button id="btn_coupon_submit"><span><i class="fa-solid fa-receipt"></i></span>Aplicar cupón</button>
                            </div>
                        </div>
                    </div>
                    <!-- /Panel cupon de descuento -->
            
                </div>
                <!-- /Paneles derecha -->
            
            </div>
            <!-- /Paneles -->
            
            <div class="checkout-panels">
                <button form="form" class="btn-primary">Continuar</button>
            </div>
            
            <form id="form" method="post" autocomplete="off">@csrf</form>
        @else
            <p>Todavía no agregaste ningún item al carrito de compras</p>
        @endif
    </div>
    
@endsection

@section("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const medioPagoRadios   = document.querySelectorAll('input[name="radio_medioPago"]');
            const panel             = document.getElementById('shipmentPanel');
            
            medioPagoRadios.forEach(function (radio)
            {
                radio.addEventListener("change", function () { if(this.value !== '1') panel.style.display = 'block'; else panel.style.display = 'none'; });
            });

            var medioPagoSeleccionado = document.querySelector('input[name="radio_medioPago"]:checked');
            
            if(medioPagoSeleccionado && medioPagoSeleccionado.value !== '1')
                document.getElementById('shipmentPanel').style.display = 'block';
        });
    </script>
@endsection