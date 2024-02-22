<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\ShoppingCartService;
use App\Services\Barcode128;
use App\Services\MercadoPago;
use Illuminate\Support\Facades\Hash;


use App\Models\Usuario;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\CuentaBancaria;
use App\Models\Genero;
use App\Models\MedioPago;
use App\Models\MedioEnvio;
use App\Models\Subcategoria;
use App\Models\TipoDocumento;
use App\Services\FavoritosService;

class ShopController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	public function index()
	{
        return view("shop.index");
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function item($id, Request $request)
	{
        $validator = Validator::make(["id" => $id], [
            "id" => "required|numeric|min:1|exists:articulos,id",
        ]);
    
        if($validator->fails())
            return redirect("shop")->withErrors($validator->errors());

        $item = Articulo::info($id);
        
        if($item && $item->estado == 1)
        {
            if($item->promocion)
                $item->precio = $item->precio - ($item->precio * $item->promocion->descuento / 100);
        
            return view("shop.item.index", compact("item"));
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

            return redirect("shop/payment");
        }

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

        return view("shop.checkout", compact("checkout", "mediosPagoListado", "mediosEnvioListado", "medioPagoSeleccionado", "medioEnvioSeleccionado"));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function payment()
	{
        $tiposDocumentos    = TipoDocumento::All();
        $cuentaBancaria     = CuentaBancaria::first();

        return view("shop.payment", compact("tiposDocumentos", "cuentaBancaria"));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function favoritos(FavoritosService $favoritoService)
	{
        $favoritos  = $favoritoService->items();
        $items      = [];

        for($i=0;$i<count($favoritos);++$i)
            array_push($items, Articulo::info($favoritos[$i]["articulo_id"]));

        return view("shop.user.favoritos", compact("items"));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function login()
    {
        // Usuario autenticado, redirigir a la página cuenta de usuario
        if(Auth::check())
            return redirect("shop/account");
        
        return view("shop.login");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function register()
    {
        // Usuario autenticado, redirigir a la página de inicio
        if(Auth::check())
            return redirect("shop");

        $generos            = Genero::all();
        $tiposDocumentos    = TipoDocumento::all();
    
        return view("shop.register.index", compact("generos", "tiposDocumentos"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function recovery()
    {
        // Usuario autenticado, redirigir a la página de inicio
        if(Auth::check())
            return redirect("shop");
            
        return view("shop.recovery");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function infoPago($id)
    {
        //Pagos de pruebas: 
        //1319858771 -> Pagofácil

        $mercadoPago    = new MercadoPago(env('MERCADOPAGO_ACCESS_TOKEN'));
        $estado         = $mercadoPago->infoPago($id);

        if($estado)
        {
            $image = NULL;
            if(isset($estado->transaction_details->barcode["content"]))
            {
                $barcode = new Barcode128;
                $barcode->setData($estado->transaction_details->barcode["content"]);
                $barcode->setDimensions(350, 50);
                $barcode->draw();
                $image = $barcode->base64();
            }
            
            return view("shop.user.infoPago", compact("estado", "image"));
        }

        return redirect("shop");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function account(Request $request)
    {
        if($request->isMethod("post"))
        {
            $user = Usuario::find(Auth::id());

            if($request->has("form1"))
            {
                $user->fill($request->except(['apellidos', 'nombres', 'tipo_documento_id', 'documento_nro', 'email']));
                $user->save();
    
                // Carga los datos del usuario en sesión
                $usuario = Usuario::find(Auth::id())->toArray();
        
                foreach($usuario as $key => $value)
                    session()->put("shop.usuario.datos.$key", $value);
    
                return redirect()->route('user.account')->with('success', trans('messages.profileUpdateSuccess'));
            }

            if($request->has("form2"))
            {
                
            }

            if($request->has("form3"))
            {
                $request->validate([
                    'password_old'     => 'required',
                    'password_new'     => 'required|min:8',
                    'password_repeat'  => 'required|same:password_new',
                ]);

                // Verificar que la contraseña anterior sea válida
                if(!Hash::check($request->input('password_old'), $user->password))
                    return redirect()->back()->with('error', trans('auth.password_old'));
    
                // Actualizar la contraseña del usuario en la base de datos
                $user->password = $request->input('password_new');
                $user->save();
    
                return redirect()->route('user.account')->with('success', trans('messages.passwordChangeSuccess'));
            }
        }

        $generos            = Genero::all();
        $tiposDocumentos    = TipoDocumento::all();

        return view("shop.user.account", compact("generos", "tiposDocumentos"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function success(ShoppingCartService $shoppingCart, $order = null)
    {
        $shoppingCart->init();

        return view("shop.checkout.success", compact("order"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function logout(UsuarioController $user, FavoritosService $favoritosService, ShoppingCartService $shoppingCartService)
    {
        $user->logout();
    
        session()->put("shop.usuario",      []);
        session()->put("shop.newsletter",   []);

        session()->forget("shop.checkout");

        $favoritosService->init();
        $shoppingCartService->init();

        return redirect("shop");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function changeLocale(Request $request)
    {
        /* https://glutendesign.com/posts/detect-and-change-language-on-the-fly-with-laravel */

        $this->validate($request, ['locale' => 'required|in:es,en']);

        Session()->put('locale', $request->locale);

        return redirect()->back();
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function checkoutV2(ShoppingCartService $shoppingCart, Request $request)
	{
        $checkout = $shoppingCart->checkOut();

        foreach ($checkout["items"] as &$item)
        {
            $articulo = Articulo::info($item["id"]);
        
            $item["descripcion"]    = $articulo->descripcion ?? NULL;
            $item["imagen"]         = count($articulo->imagen) ? $articulo->imagen[0]["miniatura"] : NULL;
        }

        if($request->isMethod("post"))
        {
            $currentStep = (int)$request->input("currentStep");
    
            $rules = [];

            switch($currentStep)
            {
                case(1):
                {
                    session()->put("shop.checkout.confirmation", now());

                    break;
                }

                case(2):
                {
                    $rules = [
                        "apellidos"         => ["required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                        "nombres"           => ["required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],

                        "documento_nro"     => ["required","integer","min:6","max:99999999"],
                        "email"             => ["required","email"],
                    ];

                    break;
                }

                case(3):
                {
                    $rules = ["radio_medioPago" => ["required","exists:medios_pagos,id"]];

                    break;
                }

                case(4):
                {
                    $rules = ["radio_medioEnvio" => ["required","exists:medios_envios,id"]];

                    break;
                }

                case(5):
                {
                    break;
                }

                case(6):
                {
                    break;
                }
            }

            // Antes de aplicar las reglas de validación predeterminadas
            $additionalRules = [];

            if($currentStep == 4)
            {
                $selectedOption = $request->input('radio_medioEnvio');

                // Si el usuario ha seleccionado envío y el valor es igual a 2, aplicar reglas de validación adicionales
                if($selectedOption == 2)
                {
                    // Definir las reglas de validación adicionales
                    $additionalRules = [
                        "codigo_postal"             => ["required","min:1000","max:9999"],
                        "localidad"                 => ["required","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                        "domicilio"                 => ["required","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                        "domicilio_nro"             => ["required","min:1","max:99999"],
                        "domicilio_piso"            => ["required","min:1","max:99"],
                        "domicilio_depto"           => ["required"],
                        "domicilio_aclaraciones"    => ["required"],
                    ];

                    // Fusionar las reglas de validación adicionales con las reglas actuales
                    $rules = array_merge($rules, $additionalRules);
                }
            }

            // Validar campos y manejar errores
            $validator = Validator::make($request->all(), $rules);

            // Manejar los errores de validación
            if($validator->fails())
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);




            
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

            return response()->json(['success' => true]);
        }

        $generos            = Genero::all();
        $tiposDocumentos    = TipoDocumento::all();
        $cuentaBancaria     = CuentaBancaria::first();

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

        return view("shop.checkout.index", compact("checkout", "mediosPagoListado", "mediosEnvioListado", "medioPagoSeleccionado", "medioEnvioSeleccionado", "generos", "tiposDocumentos", "cuentaBancaria"));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function compras()
    {
        $usuario = Usuario::find(Auth::id());

        $articulos = [
            [
                "id"    => 1,
            ],
            [
                "id"    => 2,
            ],
            [
                "id"    => 3,
            ],
        ];

        foreach($articulos as $articulo) {
            $items[] = Articulo::info($articulo['id']);
        }

        return view("shop.user.compras", compact("usuario", "items"));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function estadocompras()
    {
        return view("shop.user.order-status");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
