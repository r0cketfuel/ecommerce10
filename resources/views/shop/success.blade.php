@extends("shop.layout.master")

@section("title","Compra finalizada")

@section("css")
    <link rel="stylesheet" href="{{config('constants.framework_css')}}panel.css">
@endsection

@section("inlineCSS")
    <style>
        h1, h2 {
            margin: 0;
        }
    </style>
@endsection

@section("js")
@endsection

@section("body")

    <!-- Contenido de la página -->
    <div class="main-container">
        <div class="flex">
            <div class="panel" style="margin: auto; flex: 0 1 500px; padding: 40px;">
                <div class="grid text-center">
                    <h2><span style="color: rgb(100,220,100);"><i class="fa-regular fa-circle-check fa-6x"></i></span><br><br>Muchas gracias por su compra!</h2>
                    <h4>Su pedido se registró bajo el número: {{ $order }}</h4>
                    <h4>Puedes ver los detalles de la compra haciendo click <a href="/shop/details?order={{ $order }}">AQUI</a></h4>
                    <h4>Tambien hemos enviado un correo con los detalles de la compra</h4>
                        <button>Seguir comprando</button>
                </div>
            </div>
        </div>
    </div>

@endsection