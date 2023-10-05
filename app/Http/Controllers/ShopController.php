<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ShoppingCartService;
use App\Services\Barcode128;

use App\Models\Articulo;
use App\Models\Banner;
use App\Models\Categoria;
use App\Models\CuentaBancaria;
use App\Models\DetalleArticulo;
use App\Models\Genero;
use App\Models\MedioPago;
use App\Models\MedioEnvio;
use App\Models\Rating;
use App\Models\Review;
use App\Models\Subcategoria;
use App\Models\TipoDocumento;
use App\Models\MercadoPago;

class ShopController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	public function index(Request $request)
	{
        // Banners con las promociones vigentes
        $banners = Banner::vigentes();
        
        // Sistema de búsqueda de artículos
        $busqueda = array(
            "titulo"    => "Todos los artículos",
            "searchbar" => "",
            "params"    => array()
        );

        if($request->filled("busqueda"))
        {
            $busqueda["titulo"]     = "Resultados de la búsqueda: '" . $request->input("busqueda") . "'";
            $busqueda["searchbar"]  = $request->input("busqueda");
            $busqueda["params"]     = array("query" => $request->input("busqueda"));
        }
        else
        {
            if($request->filled("categoria"))
            {
                $busqueda["titulo"] = Categoria::find($request->input("categoria"))["nombre"];
                $busqueda["params"] = array("categoria" => $request->input("categoria"));
            }
            else
            {
                if($request->filled("subcategoria"))
                {
                    $subcategoria   = Subcategoria::find($request->input("subcategoria"));
                    $categoria      = Categoria::find($subcategoria["categoria_id"]);

                    $busqueda["titulo"] = $categoria["nombre"] . " > " . $subcategoria["nombre"];
                    $busqueda["params"] = array("subcategoria" => $request->input("subcategoria"));
                }
            }
        }
        
        // Listado de artículos
        $items = Articulo::search($busqueda["params"])->appends(request()->query());

        return view("shop.index",compact("busqueda","banners","items"));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function item($id)
	{
        if(is_numeric($id) && $id>0)
        {
            // Información básica del artículo
            $item = Articulo::info($id);
            
            if($item)
            {
                Articulo::incrementaVisualizacion($id);

                $rating     = Rating::getRatingArticulo($id);
                $detalle    = DetalleArticulo::detalle($id);
                $reviews    = Review::reviews($id);
                
                return view("shop.item", compact("item","rating","detalle","reviews"));
            }
        }

        return redirect("shop");
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function banners(string $link)
	{
        return view("shop.banners.$link");
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function checkout(ShoppingCartService $shoppingCart, Request $request)
	{
        $checkout = $shoppingCart->checkOut();

        if($request->isMethod("post"))
        {
            // Falta seguir mirando esto...
            
            session()->put("shop.checkout.total", $checkout["total"]);

            if($request->has("radio_medioPago") && is_numeric($request->input("radio_medioPago")) && (int)$request->input("radio_medioPago")>0)
                if((int)$request->input("radio_medioPago")<=MedioPago::count())
                {
                    $medio = MedioPago::find($request->input("radio_medioPago"));
                    session()->put("shop.checkout.medio_pago.id",    $medio["id"]);
                    session()->put("shop.checkout.medio_pago.medio", $medio["medio"]);
                }

            if($request->has("radio_medioEnvio") && is_numeric($request->input("radio_medioEnvio")) && (int)$request->input("radio_medioEnvio")>0)
                if((int)$request->input("radio_medioEnvio")<=MedioEnvio::count())
                {
                    $medio = MedioEnvio::find($request->input("radio_medioEnvio"));
                    session()->put("shop.checkout.medio_envio.id",      $medio["id"]);
                    session()->put("shop.checkout.medio_envio.medio",   $medio["medio"]);
                    session()->put("shop.checkout.medio_envio.costo",   $medio["costo"]);
                }

            if(session("shop.checkout.medio_envio.id")==2)
            {
                if($request->has("input_codigoPostal"))     session()->put("shop.checkout.envio.codigo_postal",       $request->input("input_codigoPostal"));
                if($request->has("input_ciudad"))           session()->put("shop.checkout.envio.ciudad",              $request->input("input_ciudad"));
                if($request->has("input_domicilio"))        session()->put("shop.checkout.envio.domicilio",           $request->input("input_domicilio"));
                if($request->has("input_domicilioNro"))     session()->put("shop.checkout.envio.domicilio_nro",       $request->input("input_domicilioNro"));
                if($request->has("input_domicilioPiso"))    session()->put("shop.checkout.envio.domicilio_piso",      $request->input("input_domicilioPiso"));
                if($request->has("input_domicilioDepto"))   session()->put("shop.checkout.envio.domicilio_depto",     $request->input("input_domicilioDepto"));
                if($request->has("textarea_aclaraciones"))  session()->put("shop.checkout.envio.aclaraciones",        $request->input("textarea_aclaraciones"));
            }

            return redirect("/shop/payment");
        }
        else
        {
            // Medios de pago activos
            $mediosPagoListado = MedioPago::activos();
            
            // Medios de envío activos
            $mediosEnvioListado = MedioEnvio::activos();

            // Seleccionar el primer medio de pago por defecto
            $medioPagoSeleccionado = $mediosPagoListado[0]["id"];

            // Seleccionar el medio de pago guardado en sesión
            if(session()->has("shop.checkout.medio_pago"))
                $medioPagoSeleccionado = session("shop.checkout.medio_pago.id");
            
            // Seleccionar el primer medio de envío por defecto
            $medioEnvioSeleccionado = $mediosEnvioListado[0]["id"];

            // Seleccionar el medio de envío guardado en sesión
            if(session()->has("shop.checkout.medio_pago"))
                $medioEnvioSeleccionado = session("shop.checkout.medio_envio.id");

            return view("shop.checkout", compact("checkout","mediosPagoListado","mediosEnvioListado","medioPagoSeleccionado","medioEnvioSeleccionado"));
        }
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function payment()
	{
        $tiposDocumentos    = TipoDocumento::All();
        $cuentaBancaria     = CuentaBancaria::first();

        return view("shop.payment", compact("tiposDocumentos","cuentaBancaria"));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function favoritos()
	{
        $items = session("shop.usuario.favoritos");
        for($i=0;$i<count($items);++$i)
        {
            $info = Articulo::info(session("shop.usuario.favoritos.$i.articulo_id"))->toArray();

            $items[$i]["miniatura_1"]   = $info["miniatura_1"];
            $items[$i]["descripcion"]   = $info["descripcion"];
            $items[$i]["precio"]        = $info["precio"];
        }

        return view("shop.favoritos",compact("items"));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function login()
    {
        // Usuario autenticado, redirigir a la página cuenta de usuario
        if(Auth::check())
            return redirect("/shop/account");
        
        return view("shop.login");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function register()
    {
        // Usuario autenticado, redirigir a la página de inicio
        if(Auth::check())
            return view("shop");

        $generos            = Genero::all();
        $tiposDocumentos    = TipoDocumento::all();
    
        return view("shop.register", compact("generos", "tiposDocumentos"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function recovery()
    {
        // Usuario autenticado, redirigir a la página de inicio
        if(Auth::check())
            return redirect("/shop");
            
        return view("shop.recovery");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function infoPago($id)
    {
        //Pagos de pruebas: 
        //1314307973 -> Tarjeta de crédito
        //1314307973 -> Pagofácil
        //1314307973 -> Rapipago

        $mercadoPago    = new MercadoPago;
        $estado         = $mercadoPago->infoPago($id);
        
        $barcode = new Barcode128;
        $barcode->setData($estado["barcode"]["content"]);
        $barcode->setDimensions(350, 50);
        $barcode->draw();
        $image = $barcode->base64();

        return view("shop.infoPago", compact("estado", "image"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function account()
    {
        $generos            = Genero::all();
        $tiposDocumentos    = TipoDocumento::all();

        return view("shop.account", compact("generos", "tiposDocumentos"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function success()
    {
        return view("shop.success");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function logout(UserController $user)
    {
        $user->logout();

        session()->flush();
    
        return redirect("/shop");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

}
