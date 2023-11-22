<?php

    namespace App\Services;

    use App\Models\Articulo;
    use App\Models\AtributoArticulo;

    class ShoppingCartService
    {
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
		public function __construct()
		{
            if(!session()->has("shop.usuario.carrito"))
                session()->put("shop.usuario.carrito", array());
		}
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
		public function clear(): int
		{
			//=========================================//
			// Método que limpia el carrito de compras //
			//=========================================//
            session()->put("shop.usuario.carrito", array());

            return($this->totalItems());
		}
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function itemIndex(int $id, array $opciones = array()): int
        {
            //==============================================================//
            // Método que devuelve el índice del arreglo donde esta el item //
            //==============================================================//

            for($i=0;$i<count(session("shop.usuario.carrito"));$i++)
                if(session("shop.usuario.carrito.$i.id") == $id)
                    if(empty(array_diff_assoc(session("shop.usuario.carrito.$i.opciones"), $opciones)))
                        return($i);
            
            return(-1);
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function updateCart(int $id, int $cantidad, array $opciones = array())
        {
            //============================================//
            // Método que actualiza el carrito de compras //
            //============================================//
            
            if($id>0 && $cantidad>=0)
            {
                $atributoArticulo   = new AtributoArticulo;
                $limiteCompra       = $atributoArticulo->maximoCompra($id, $opciones);
                
                $index = $this->itemIndex($id, $opciones);

                if($index<0)
                {
                    //----------------------------------------//
                    // ITEM NO EXISTE EN EL CARRITO - AGREGAR //
                    //----------------------------------------//
                    if($cantidad<=$limiteCompra && $cantidad>0)
                        $this->addItem($id, $cantidad, $opciones);
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

            return($this->totalItems());
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function addItem(int $id, int $cantidad, array $opciones = array())
        {
            //=====================================================//
            // Método que inserta un item en el carrito de compras //
            //=====================================================//

            $info = Articulo::info($id);

            session()->push("shop.usuario.carrito", array(
                "id" 		=> $id,
                "cantidad"	=> $cantidad,
                "precio"	=> $info["precio"],
                "subtotal"	=> $info["precio"] * $cantidad,
                "opciones"  => $opciones
            ));
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function updateItem(int $index, int $cantidad)
        {
            //======================================================================//
            // Método que actualiza la cantidad de un item en el carrito de compras //
            //======================================================================//

            session()->put("shop.usuario.carrito.$index.cantidad", $cantidad);
        }
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function removeItem(int $index)
        {
            //===================================================//
            // Método que elimina un item del carrito de compras //
            //===================================================//

            array_splice(session("shop.usuario.carrito"), $index, 1);
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
		public function checkOut(): array
		{
			//=========================================================================================//
			// Método que devuelve un array con los items del carrito, información, total y subtotales //
			//=========================================================================================//

			$chekOutArray = array(
				"items"	=> session("shop.usuario.carrito"),
				"total"	=> $this->total()
			);

			return($chekOutArray);
		}
		//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
		public function total(): float
		{
            //==========================================================//
			// Método que calcula el monto total del carrito de compras //
			//==========================================================//

			$total = 0;
			for($i=0;$i<count(session("shop.usuario.carrito"));++$i)
				$total  = $total + session("shop.usuario.carrito.$i.subtotal");

			return($total);
		}
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function itemQuantity(int $id, array $opciones = array()): int
        {
            //==========================================================================//
			// Método que devuelve la cantidad de un determinado artículo en el carrito //
			//==========================================================================//

            $index = $this->itemIndex($id, $opciones);
            if($index>=0)
                return(session("shop.usuario.carrito.$index.cantidad"));

			return(-1);
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function totalItems(): int
        {
            //====================================================//
            // Método que retorna el total de items en el carrito //
            //====================================================//

            $total = 0;
            for($i=0;$i<count(session("shop.usuario.carrito"));++$i)
                $total += session("shop.usuario.carrito.$i.cantidad");

            return($total);
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    }