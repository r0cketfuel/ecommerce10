@extends("shop.layout.master")

@section("title","Favoritos")

@section("css")
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}productCards.css">
    <link rel="stylesheet"	href="{{ config('constants.shop_css') }}breadcrumb.css">
@endsection

@section("js")
    <script defer src="{{config('constants.shop_js')}}ajax.js"></script>
@endsection

@section("body")

    <!-- Contenido de la página -->
    <div class="main-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/shop">Home</a> > Favoritos
        </div>

        @if($favoritosItemQty)
            <ul class="favourites-list">
                @foreach($items as $item)
                    <li class="favourite-card">
                        <div>{{ $item["descripcion"] }}</div>
                        <div class="favourite-card-image">
                            @if ($item->imagenes->isNotEmpty())
                                <img loading="lazy" src="{{ $item->imagenes[0]->ruta }}" alt="{{ $item->imagenes[0]->descripcion }}">
                            @else
                                <img loading="lazy" src="{{ asset('images/content/no-image.png') }}" alt="imagen">
                            @endif
                        </div>
                        <div>{{ _money($item["precio"]) }}</div>
                        <div><button class="btn-danger" value="{{ $item->id }}"><span><i class="fa-solid fa-trash"></i></span>{{ __('buttons.delete') }}</button></div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No tienes añadido ningún item en la lista de deseos
        @endif

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const buttons = document.querySelectorAll(".btn-danger");
            buttons.forEach(button => {
                button.addEventListener("click", () => removeFavorite(button.value));
            });
        });

        function removeFavorite(id)
        {
            const url           = "/shop/ajax/eliminaFavorito";
            const parameters    = "articulo_id=" + id;
            const promise       = ajax(url, parameters);

            promise.then((data) => {

                const icon = document.getElementById("heart");
                icon.innerHTML = data["data"]["itemQty"];
                
                // Encuentra el elemento li padre de la tarjeta
                const card = document.querySelector(`.btn-danger[value="${id}"]`).closest("li");

                if(card)
                {
                    card.classList.add("fade-out");

                    // Espera a que termine la transición de opacidad antes de eliminar la tarjeta
                    card.addEventListener("transitionend", () => {
                        card.remove();
                    });
                }
            }).catch(error => {
                console.error("Error:", error);
            });
        }
    </script>

@endsection