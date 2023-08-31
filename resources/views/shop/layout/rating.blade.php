<div class="product-rating">
    <div class="product-stars">
        @for($i=1;$i<=$rating->stars;$i++)
            <span><i class='fa-solid fa-star'></i></span>
        @endfor
        @for($i=$rating->stars+1;$i<=5;$i++)
            <span style='color: grey;'><i class='fa-solid fa-star'></i></span>
        @endfor
        <div class="product-average">{{$rating->promedio}}/5,00</div>
    </div>
    <div class="product-votes">{{$rating->puntuaciones}} votos</div>
</div>