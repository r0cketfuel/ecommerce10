<ul class="tabs">
    <li class="tab active">Información</li>
    <li class="tab">Reseñas({{ count($reviews) }})</li>
</ul>

<div class="tab-content">
    @if($detalle)
        {!!$detalle->detalle!!}
    @else
        <p>El artículo no tiene detalle</p>
    @endif
</div>

<div class="tab-content">
    @for($i=0;$i<count($reviews);$i++)
        <div class="user-review">
            <div>
                <div class="user-review-picture"><i class="fa-solid fa-user fa-2x"></i></div>
                <div>
                    <div><b>{{ $reviews[$i]["username"] }}</b></div>
                    <div>{{ $reviews[$i]["fecha"] }}</div>
                </div>
            </div>
            <b>{{ $reviews[$i]["titulo"] }}</b>
            {{ $reviews[$i]["texto"] }}
        </div>
    @endfor
</div>
