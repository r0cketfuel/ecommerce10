<div class="carousel-slide">
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    <div class="panel" id="payment">
        <div class="panel-title panel-title-underlined">Pago</div>
        <div class="panel-content">

            <!-- Efectivo -->
            @if(session("shop.checkout.medio_pago.id")==1)
                <button form='form-checkout' class='btn-primary' type='submit'>Confirmar compra</button>
            @endif

            <!-- Transferencia bancaria -->
            @if(session("shop.checkout.medio_pago.id")==2)
                <div class="grid" style="grid-template-columns: auto 1fr; gap: 20px;">
                    <div class="text-bold">Banco:</div>
                    <div>{{$cuentaBancaria["banco"]}}</div>
                    <div class="text-bold">Cuit:</div>
                    <div>{{$cuentaBancaria["cuit"]}}</div>
                    <div class="text-bold">Titular:</div>
                    <div>{{$cuentaBancaria["titular"]}}</div>
                    <div class="text-bold">Cuenta:</div>
                    <div>{{$cuentaBancaria["cuenta"]}}</div>
                    <div class="text-bold">CBU:</div>
                    <div>{{$cuentaBancaria["cbu"]}}</div>
                    <div class="text-bold">Alias:</div>
                    <div>{{$cuentaBancaria["alias"]}}</div>
                </div>
                <button form='form-checkout' class='btn-primary' type='submit'>Confirmar compra</button>
            @endif

            <!-- Tarjeta de crédito o débito mercadopago -->
            @if(session("shop.checkout.medio_pago.id")==3)
                <script defer src="https://sdk.mercadopago.com/js/v2"></script>
                <script defer src="/assets/js/shop/mercadoPago.js"></script>

                <div>5031 7557 3453 0604</div>

                <label>Número de tarjeta<div id="form-checkout__cardNumber"         class="container"></div></label>
                <label>Fecha de expiración<div id="form-checkout__expirationDate"   class="container"></div></label>
                <label>Código de seguridad<div id="form-checkout__securityCode"     class="container"></div></label>
                <label>Titular de la tarjeta<input id="form-checkout__cardholderName"></label>
                <label>Banco emisor<select id="form-checkout__issuer"></select></label>
                <label>Cuotas<select id="form-checkout__installments"></select></label>
                <progress value="0" class="progress-bar">Cargando...</progress>
                <button id="prueba" form="form-checkout" class="btn-primary" type="submit" id="form-checkout__submit">Confirmar compra</button>
            @endif

            <!-- Pagofácil o Rapipago mercadopago -->
            @if(session("shop.checkout.medio_pago.id")==4 || session("shop.checkout.medio_pago.id")==5)
                <button form="form-checkout" type="submit">Pagar</button>
            @endif

        </div>
    </div>
</div>