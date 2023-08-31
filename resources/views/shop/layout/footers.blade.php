<footer>
    <div class="top-footer">
        <div class="top-footer-container">
            <div class="footer-section">
                <h3 class="top-footer-title">Acerca de</h3>
                <p>{{session("infoComercio.descripcion")}}</p>
            </div>
            <div class="footer-section">
                <h3 class="top-footer-title">Información</h3>
                <ul class="footer-links">
                    @if(session('infoComercio.telefono_1'))
                        <li><a href="tel:{{session('infoComercio.telefono_1')}}"><span><i class="fa-solid fa-phone"></i></span>{{session("infoComercio.telefono_1")}}</a></li>
                    @endif
                    @if(session('infoComercio.email'))
                        <li><a href="mailto:{{session('infoComercio.email')}}"><span><i class="fa-solid fa-envelope"></i></span>{{session("infoComercio.email")}}</a></li>
                    @endif
                    @if(session('infoComercio.geolocalizacion'))
                    <li><a href="http://www.google.com/maps/place/{{session('infoComercio.geolocalizacion')}}"><span><i class="fa-solid fa-location-dot"></i></span>{{session("infoComercio.direccion")}}</a></li>
                    @endif
                    @if(session('infoComercio.localidad'))
                        <li><span><i class="fa-solid fa-map"></i></span>{{session("infoComercio.localidad")}}, {{session("infoComercio.provincia")}}</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="bottom-footer">
        <div class="bottom-footer-container">
            <div class="footer-payments">
                <img src="{{config('constants.images')}}/medios_pago/visa.png"          alt="visa">
                <img src="{{config('constants.images')}}/medios_pago/mastercard.png"    alt="mastercard">
                <img src="{{config('constants.images')}}/medios_pago/mercadopago.png"   alt="mercadopago">
                <img src="{{config('constants.images')}}/medios_pago/pagofacil.png"     alt="pagofacil">
                <img src="{{config('constants.images')}}/medios_pago/rapipago.png"      alt="rapipago">
            </div>
            <div>
                <a href="#">
                    <img class="afip" src="{{config('constants.images')}}/afip.jpg" alt="afipQR">
                </a>
            </div>
            <div class="copyright"><?=date("Y");?> - FG Design</div>
        </div>
    </div>
</footer>