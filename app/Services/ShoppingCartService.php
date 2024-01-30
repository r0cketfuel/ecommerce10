<?php

    namespace App\Services;

    use App\Models\Articulo;
    use App\Models\AtributoArticulo;

    class ShoppingCartService
    {
        const SESSION_CART_KEY                  = "shop.usuario.carrito";
        const SESSION_CART_ITEMS_KEY            = "shop.usuario.carrito.items";
        
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function __construct()
        {
            if(!session()->has(self::SESSION_CART_KEY))
                $this->init();
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function init(): int
        {
			//=========================================//
			// Método que limpia el carrito de compras //
			//=========================================//

            session()->put(self::SESSION_CART_KEY,          []);
            session()->put(self::SESSION_CART_ITEMS_KEY,    []);

            return $this->totalItems();
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function itemIndex(int $id, array $opciones = []): int
        {
            //==============================================================//
            // Método que devuelve el índice del arreglo donde esta el item //
            //==============================================================//

            for($i=0;$i<count(session(self::SESSION_CART_ITEMS_KEY));$i++)
                if(session(self::SESSION_CART_ITEMS_KEY)[$i]["id"] == $id && empty(array_diff_assoc(session(self::SESSION_CART_ITEMS_KEY)[$i]["opciones"], $opciones)))
                    return $i;

            return -1;
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function updateCart(int $id, int $cantidad, array $opciones = [])
        {
            //============================================//
            // Método que actualiza el carrito de compras //
            //============================================//

            if($id>0 && $cantidad>=0)
            {
                $articulo           = Articulo::find($id);
                $atributoArticulo   = AtributoArticulo::search($id, $opciones)->first();
                $limiteCompra       = $atributoArticulo->maximoCompra($atributoArticulo);

                $index = $this->itemIndex($id, $opciones);

                if($index<0)
                {
                    //----------------------------------------//
                    // ITEM NO EXISTE EN EL CARRITO - AGREGAR //
                    //----------------------------------------//
                    if($cantidad<=$limiteCompra && $cantidad>0)
                    {
                        $this->addItem($articulo, $atributoArticulo, $cantidad);
                    }
                }
                else
                {
                    //---------------------------------------------------//
                    // ITEM EXISTE EN EL CARRITO - ACTUALIZAR O ELIMINAR //
                    //---------------------------------------------------//
                    if($cantidad<=$limiteCompra && $cantidad>0)
                    {
                        $this->updateItem($index, $cantidad);
                    }
                    else
                    {
                        $this->removeItem($index);
                    }
                }
            }

            return $this->totalItems();
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function addItem($articulo, $atributoArticulo, int $cantidad)
        {
            //=====================================================//
            // Método que inserta un item en el carrito de compras //
            //=====================================================//
            
            session()->push(self::SESSION_CART_ITEMS_KEY, [
                "id"             => $articulo->id,
                "atributos_id"   => $atributoArticulo->id,
                "cantidad"       => $cantidad
            ]);
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function updateItem(int $index, int $cantidad)
        {
            //======================================================================//
            // Método que actualiza la cantidad de un item en el carrito de compras //
            //======================================================================//

            session()->put(self::SESSION_CART_ITEMS_KEY . ".$index.cantidad", $cantidad);
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function removeItem(int $index)
        {
            //===================================================//
            // Método que elimina un item del carrito de compras //
            //===================================================//

            array_splice(session(self::SESSION_CART_ITEMS_KEY), $index, 1);
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function checkOut(): array
        {
			//=========================================================================================//
			// Método que devuelve un array con los items del carrito, información, total y subtotales //
			//=========================================================================================//

            $chekOutArray = [
                "items" => session(self::SESSION_CART_ITEMS_KEY),
                "total" => $this->total()
            ];

            for($i=0;$i<count($chekOutArray["items"]);$i++)
            {
                $articulo   = Articulo::find(session(self::SESSION_CART_ITEMS_KEY)[$i]["id"]);
                $precio     = Articulo::precio($articulo->id);
                $cantidad   = session(self::SESSION_CART_ITEMS_KEY)[$i]["cantidad"];
                $subtotal   = $precio * $cantidad;

                $chekOutArray["items"][$i]["precio"]    = $precio;
                $chekOutArray["items"][$i]["subtotal"]  = $subtotal;
                $chekOutArray["items"][$i]["opciones"]  = [];
            }

            return $chekOutArray;
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function total(): float
        {
            //==========================================================//
			// Método que calcula el monto total del carrito de compras //
			//==========================================================//

            $total = 0;

            for($i=0;$i<count(session(self::SESSION_CART_ITEMS_KEY));$i++)
            {
                $articulo   = Articulo::find(session(self::SESSION_CART_ITEMS_KEY)[$i]["id"]);
                $precio     = Articulo::precio($articulo->id);
                $cantidad   = session(self::SESSION_CART_ITEMS_KEY)[$i]["cantidad"];
                $subtotal   = $precio * $cantidad;
                $total      = $total + $subtotal;
            }

            return $total;
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function itemQuantity(int $id, array $opciones = []): int
        {
            //==========================================================================//
			// Método que devuelve la cantidad de un determinado artículo en el carrito //
			//==========================================================================//

            $index = $this->itemIndex($id, $opciones);
            if($index>=0)
                return session(self::SESSION_CART_ITEMS_KEY)[$index]["cantidad"];

            return -1;
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function totalItems(): int
        {
            //====================================================//
            // Método que retorna el total de items en el carrito //
            //====================================================//

            $total = 0;
            for($i=0;$i<count(session(self::SESSION_CART_ITEMS_KEY));$i++)
                $total += session(self::SESSION_CART_ITEMS_KEY)[$i]["cantidad"];

            return $total;
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    }