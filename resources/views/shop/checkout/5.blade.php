<div class="carousel-slide">
    <div class="flex justify-content-between">
        <button class="btnPrev"><i class="fa-solid fa-chevron-left fa-xs"></i> Anterior</button>
        <button class="btnNext">Siguiente <i class="fa-solid fa-chevron-right fa-xs"></i></button>
    </div>
    <br>
    <!-- Contenido -->
    @include("shop.modals.payment")
    <div class="panel" id="user">
        <div class="panel-title panel-title-underlined">3 - Datos de contacto</div>
        <div class="panel-content">
            <div class="input-group">

                <div class="flex gap-3">
                    <label>
                        Localidad
                        <input type="text" name="localidad" value="{{session('shop.usuario.datos.localidad')}}">
                    </label>

                    <label>
                        Código postal
                        <input type="text" name="codigo_postal" pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.codigo_postal')}}">
                    </label>
                </div>

                <label>
                    Domicilio
                    <input type="text" id="domicilio" name="domicilio" value="{{session('shop.usuario.datos.domicilio')}}">
                </label>

                <div class="flex gap-3">
                    <label>
                        Domicilio número
                        <input type="text" id="domicilio_nro" name="domicilio_nro" pattern="[0-9]+" title="Sólo se permiten números" value="{{session('shop.usuario.datos.domicilio_nro')}}">
                    </label>
                    
                    <label>
                        Domicilio piso
                        <input type="text" id="domicilio_piso" name="domicilio_piso" value="{{session('shop.usuario.datos.domicilio_piso')}}">
                    </label>

                    <label>
                        Domicilio depto
                        <input type="text" id="domicilio_depto" name="domicilio_depto" value="{{session('shop.usuario.datos.domicilio_depto')}}">
                    </label>
                </div>
            
            </div>
        </div>
    </div>
</div>