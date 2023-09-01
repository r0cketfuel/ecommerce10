<div class="newsletter">
    <div class="newsletter-container" id="newsletter-container">
        <p>Suscribite a nuestro <strong>NEWSLETTER</strong> para enterarte de nuestras últimas novedades</p>

		<div class="newsletter-suscription-bar" id="newsletter-suscription-bar">
			<input 	form="form-suscribe" type="email" id="suscribe" name="email" placeholder="Correo electrónico">
			<button form="form-suscribe" class="newsletter-btn">Suscribirse</button>
		</div>
        <div id="newsletter-suscription-msg" style="display: none;">
            <p></p>
        </div>

		@if (session("infoComercio.facebook") || session("infoComercio.twitter") || session("infoComercio.instagram") || session("infoComercio.pinterest"))
			<p>También podes seguirnos en nuestras redes:</p>
			<div class="newsletter-follow">
				@if(session("infoComercio.facebook")  != "") <div><a href="{{session('infoComercio.facebook') }}"><i class="fa-brands fa-facebook"></i></a></div>@endif
				@if(session("infoComercio.twitter")   != "") <div><a href="{{session('infoComercio.twitter')  }}"><i class="fa-brands fa-twitter"></i></a></div>@endif
				@if(session("infoComercio.instagram") != "") <div><a href="{{session('infoComercio.instagram')}}"><i class="fa-brands fa-instagram"></i></a></div>@endif
				@if(session("infoComercio.pinterest") != "") <div><a href="{{session('infoComercio.pinterest')}}"><i class="fa-brands fa-pinterest"></i></a></div>@endif
			</div>
		@endif
	</div>
</div>
<form id="form-suscribe" method="post" action="/suscribe">@csrf</form>