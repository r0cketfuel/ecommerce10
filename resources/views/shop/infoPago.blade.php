@extends("shop.layout.master")

@php
    $title = "Información sobre un pago";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.framework_css') }}panel.css">
@endsection

@section("body")

    <!-- Contenido de la página -->
    <div class="main-container">
        <div class="panel w500px">
            <div class="panel-title panel-title-underlined">Info</div>
            <div class="panel-content">
                <div class="flex justify-between">
                    <div class="text-bold">Medio de pago:</div>
                    <div>{{ $estado->payment_method_id }}</div>
                </div>

                @if(isset($estado->card->cardholder->name))
                    <div class="flex justify-between">
                        <div class="text-bold">Titular de la tarjeta:</div>
                        <div>{{ $estado->card->cardholder->name }}</div>
                    </div>
                    <div class="flex justify-between">
                        <div class="text-bold">Dni titular de la tarjeta:</div>
                        <div>{{ $estado->card->cardholder->identification->number }}</div>
                    </div>
                    <div class="flex justify-between">
                        <div class="text-bold">Cuotas:</div>
                        <div>{{ $estado->installments }}</div>
                    </div>
                @endif

                <div class="flex justify-between">
                    <div class="text-bold">Fecha de creación:</div>
                    <div>
                        @if(isset($estado->card->date_created))
                            {{ _date(explode("T",$estado->card->date_created)[0]) }}
                        @else
                            {{ _date(explode("T",$estado->date_created)[0]) }}
                        @endif
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="text-bold">Total:</div>
                    <div>{{ _money($estado->transaction_details->total_paid_amount) }}</div>
                </div>
                <div class="flex justify-between">
                    <div class="text-bold">Estado:</div>
                    <div>{{ $estado->status }}</div>
                </div>
                <div class="flex justify-between">
                    <div class="text-bold">Descripción:</div>
                    <div>{{ $estado->status_detail }}</div>
                </div>
                @if(isset($estado->transaction_details->barcode["content"]))
                    <div class="text-bold">Código de barras:</div>
                    <div class="text-center" style="border: 1px solid rgb(200,200,200); padding: 10px;">
                        <div>
                            <img src="data:image/png;base64,{{ $image }}">
                        </div>
                        {{ $estado->transaction_details->barcode["content"] }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection