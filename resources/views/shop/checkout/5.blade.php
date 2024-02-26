<div class="carousel-slide">
    <div class="flex justify-content-start">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
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
                <div class="grid grid-cols-2">
                    <p class="text-bold">Banco:</p><p>{{ $cuentaBancaria["banco"] }}</p>
                    <p class="text-bold">Cuit:</p><p>{{ $cuentaBancaria["cuit"] }}</p>
                    <p class="text-bold">Titular:</p><p>{{ $cuentaBancaria["titular"] }}</p>
                    <p class="text-bold">Cuenta:</p><p>{{ $cuentaBancaria["cuenta"] }}</p>
                    <p class="text-bold">CBU:</p><p>{{ $cuentaBancaria["cbu"] }}</p>
                    <p class="text-bold">Alias:</p><p>{{ $cuentaBancaria["alias"] }}</p>
                </div>
                <button form='form-checkout' class='btn-primary' type='submit'>Confirmar compra</button>
            @endif

            <!-- Tarjeta de crédito o débito mercadopago -->
            @if(session("shop.checkout.medio_pago.id")==3)
                @include("shop.checkout.cardForm")
            @endif

            <!-- Pagofácil o Rapipago mercadopago -->
            @if(session("shop.checkout.medio_pago.id")==4 || session("shop.checkout.medio_pago.id")==5)
                <button form="form-checkout" type="submit">Pagar</button>
            @endif

        </div>
    </div>
</div>