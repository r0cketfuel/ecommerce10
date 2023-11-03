<?php

    namespace App\Services;

    use App\Models\Favorito;

    class FavoritosService
    {
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function __construct()
		{
            if(!session()->has("shop.usuario.favoritos"))
                session()->put("shop.usuario.favoritos", array());
		}
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function totalItems(): int
        {
            //============================================================//
            // Método que retorna el total de items agregados a favoritos //
            //============================================================//

            return(count(session("shop.usuario.favoritos")));
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function load(int $usuario_id): void
        {
            //============================================================//
            // Método que carga en sesión los items agregados a favoritos //
            //============================================================//

            session()->put("shop.usuario.favoritos", Favorito::where("usuario_id", $usuario_id)->get()->toArray());
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function addItem(int $usuario_id, int $articulo_id): array
        {
            //===================================================//
            // Método que agrega un item al listado de favoritos //
            //===================================================//

            $favorito = new Favorito;

            // Verificar si el item ya se encontraba agregado a favoritos
            if(Favorito::all()->where("usuario_id", $usuario_id)->where("articulo_id", $articulo_id)->count())
            {
                $response   = array(
                    "success"       => false,
                    "data"          => array(
                        "message"   => "El item ya se encontraba agregado a favoritos"
                    ),
                );
                
                return($response);
            }
            
            $favorito->usuario_id   = $usuario_id;
            $favorito->articulo_id  = $articulo_id;
            $favorito->fecha        = timestamp();

            if($favorito->save())
            {
                session()->push("shop.usuario.favoritos", $favorito->all()->where("usuario_id", $usuario_id)->where("articulo_id", $articulo_id)->first());

                $response = array(
                    "success"       => true,
                    "data"          => array(
                        "message"   => "El item se agregó correctamente",
                        "itemQty"   => $this->totalItems()
                    )
                );

                return($response);
            }
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
        public function removeItem(int $usuario_id, int $articulo_id): array
        {
            //=====================================================//
            // Método que elimina un item del listado de favoritos //
            //=====================================================//

            $response = array(
                "success"       => false,
                "data"          => array(
                    "message"   => "No se pudo eliminar el item"
                )
            );

            for($i=0;$i<count(session("shop.usuario.favoritos"));$i++)
                if(session("shop.usuario.favoritos.$i.usuario_id")==$usuario_id && session("shop.usuario.favoritos.$i.articulo_id")==$articulo_id)
                {
                    $favorito = new Favorito;

                    if($favorito->where("usuario_id", $usuario_id)->where("articulo_id", $articulo_id)->delete())
                    {
                        // Recargar todos los favoritos
                        session()->forget("shop.usuario.favoritos");
                        $this->load($usuario_id);
                        
                        $response = array(
                            "success"       => true,
                            "data"          => array(
                                "message"   => "El item se eliminó correctamente"
                            )
                        );
    
                        break;
                    }
                }
            
            return($response);
        }
        //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    }