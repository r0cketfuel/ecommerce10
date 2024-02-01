<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ShoppingCartService;

use App\Models\Articulo;
use App\Models\AtributoArticulo;
use App\Models\Newsletter;
use App\Models\MedioEnvio;
use App\Services\FavoritosService;

class AjaxController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function infoItem(Request $request)
    {
        //========================================================//
        // Método que devuelve la información básica del artículo //
        //========================================================//
        
        $id = json_decode($request->id, true);
        
        return response()->json(Articulo::info($id));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function atributosItem(Request $request)
    {
        //================================================================//
        // Método que devuelve registros segun los parámetros solicitados //
        //================================================================//

        $id = json_decode($request->input("articulo_id"),true);

        $opciones = array();
        if($request->input("opciones") != NULL)
            $opciones = json_decode($request->input("opciones"),true);
        
        return response()->json(AtributoArticulo::search($id, $opciones));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function updateCart(Request $request, ShoppingCartService $shoppingCartService)
    {
        //============================================//
        // Método que actualiza el carrito de compras //
        //============================================//
        
        if($request->filled("id") && $request->filled("atributos_id") && $request->filled("cantidad"))
        {
            $id             = json_decode($request->input("id"),            true);
            $atributosId    = json_decode($request->input("atributos_id"),  true);
            $cantidad       = json_decode($request->input("cantidad"),      true);

            return response()->json($shoppingCartService->updateCart($id, $cantidad, $atributosId));
        }
        else
        {
            return response()->json($shoppingCartService->totalItems());
        }
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function suscribe(Request $request)
    {
        //=============================================//
        // Método que suscribe un correo al newsletter //
        //=============================================//

        $email      = $request->input("email");
        $newsletter = new Newsletter;
        $response   = $newsletter->suscribe($email);

        return response()->json($response);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function agregaFavorito(Request $request, FavoritosService $favoritoService)
    {
        //===================================================//
        // Método que agrega un item al listado de favoritos //
        //===================================================//

        $response   = array(
            "success"       => false,
            "data"          => array(
                "message"   => "Algo salió mal"
            ),
        );

        $articuloId = $request->input("articulo_id");
        $response   = $favoritoService->addItem(Auth::id(), $articuloId);

        return response()->json($response);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function eliminaFavorito(Request $request)
    {
        //===================================================//
        // Método que agrega un item al listado de favoritos //
        //===================================================//

        $response   = array(
            "success"       => false,
            "data"          => array(
                "message"   => "Algo salió mal"
            ),
        );

        $articulo_id        = $request->input("articulo_id");
        $favoritoService    = new FavoritosService;

        $response = $favoritoService->removeItem(Auth::id(), $articulo_id);

        return response()->json($response);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function aplicaCupon(Request $request)
    {
        //========================================//
        // Método que aplica un cupón a la compra //
        //========================================//

        return response()->json("");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function costoEnvio(Request $request)
    {
        return response()->json(MedioEnvio::costo($request->input("medio_id")));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function getItemInfoAndAttributes($id) {
        $articulo = Articulo::with('atributos')->find($id);

        return response()->json(['itemInfo' => $articulo]);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

}
