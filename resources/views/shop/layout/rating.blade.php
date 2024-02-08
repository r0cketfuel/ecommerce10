<div class="product-rating">
    <div class="product-stars">
        @for($i=1;$i<=(int)($item->rating->promedio);$i++)
            <span><i class='fa-solid fa-star'></i></span>
        @endfor
        @for($i=(int)($item->rating->promedio+1);$i<=5;$i++)
            <span><i class='fa-regular fa-star'></i></span>
        @endfor
        <div class="product-average">{{ _number($item->rating->promedio) }} / {{ _number(5) }}</div>
    </div>
    <div class="product-votes">{{ $item->rating->puntuaciones }} {{ __('general.votes') }}</div>
</div>