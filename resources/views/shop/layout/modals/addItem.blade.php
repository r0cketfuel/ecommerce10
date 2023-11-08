<div class="modal" id="modal-add">
    <div class="modal-container" style="width: 600px">
        <div class="modal-header">
            <div class="modal-title">
                <h1>{{ __('general.additemtocart') }}</h1>
            </div>
            <span class="modal-close" onclick="this.parentElement.parentElement.parentElement.style.display='none'">X</span>
        </div>

        <div class="modal-addItem" style="padding-top: 50px;">
                <img id="image" src="{{ config('constants.product_images') . '/no-image.png' }}" alt="imagen" style="height: 25%; width: 25%;">
                <div class="grid" style="flex: 1 1; grid-auto-rows: 1fr">

                    <!-- Precio -->
                    <div class="flex justify-between align-center">
                        <div>{{ __('general.price') }}:</div>
                        <div id="precio">-</div>
                    </div>
                    <!-- /Precio -->

                    <!-- Atributo Tamaño -->
                    <div class="flex justify-between align-center">
                        <div>{{ __('general.sizes') }}:</div>
                        <div style="display: flex;">
                            <select id="sizes">
                                <option value="" disabled selected>{{ __('general.select_option') }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- /Atributo Tamaño -->
                    
                    <!-- Atributo Color -->
                    <div class="flex justify-between align-center">
                        <div>{{ __('general.colors') }}:</div>
                        <div style="display: flex;">
                            <select id="colors">
                                <option value="" disabled selected>{{ __('general.select_option') }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- /Atributo Color -->

                    <!-- Stock disponible -->
                    <div class="flex justify-between align-center">
                        <div>{{ __('general.stock_available') }}:</div>
                        <div id="stock">-</div>
                    </div>                         
                    <!-- /Stock disponible -->

                    <!-- Cantidad -->
                    <div id="qtyControl" class="flex justify-between align-center">
                        <div>{{ __('general.quantity') }}:</div>
                        <div style="display: flex; max-width: 120px;">
                            <button id="minusButton"><i class="fa-solid fa-minus"></i></button>
                            <input 	id="addToCartQty" type="number">
                            <button id="plusButton"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>

                    <!-- subtotal -->
                    <div class="flex justify-between align-center">
                        <div>{{ __('general.subtotal') }}:</div>
                        <div id="subtotal">-</div>
                    </div>

                    <button id="button_addToCart" class="btn-primary"><span><i class="fa-solid fa-cart-plus"></i></span>{{ __('buttons.addToCart') }}</button>
                </div>

        </div>
    </div>
</div>