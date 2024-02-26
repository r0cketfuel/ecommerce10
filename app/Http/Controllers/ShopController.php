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
use App\Models\Banner;
use App\Models\CuentaBancaria;
use App\Models\Genero;
use App\Models\MedioPago;
use App\Models\MedioEnvio;
use App\Models\Rating;
use App\Models\TipoDocumento;
use App\Services\FavoritosService;

class ShopController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	public function index()
	{
        $banners = Banner::vigentes();

        return view("shop.index", compact("banners"));
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function item($id)
	{
        $validator = Validator::make(["id" => $id], [
            "id" => "required|numeric|min:1|exists:articulos,id",
        ]);
    
        if($validator->fails())
            return redirect("shop")->withErrors($validator->errors());

        $item = Articulo::info($id);
        
        if($item && $item->estado == 1)
        {
            // Incrementar y obtener las calificaciones del artículo
            $ratings = Rating::incrementaVisualizacion($id);

            return view("shop.item.index", compact("item", "ratings"));
        }

        return redirect("shop");
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function banners(string $link)
	{
        return view("shop.banners.$link");
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
        $response       = $mercadoPago->infoPago($id);

        if($response["success"] == True)
        {
            $estado = $response["data"]["payment"];
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

        return redirect("shop")->withErrors("Pago no encontrado");
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
    public function checkout(ShoppingCartService $shoppingCart, Request $request)
	{
        $checkout = $shoppingCart->checkOut();

        if($request->isMethod("post"))
        {
            $currentStep = (int)$request->input("currentStep");

            switch($currentStep)
            {
                case(1):
                {
                    session()->put("shop.checkout.confirmation", now());
                    session()->put("shop.checkout.total", $checkout["total"]);

                    return response()->json(['success' => true]);
                    
                    break;
                }

                case(2):
                {
                    $rules = [
                        "apellidos"         => ["required","alpha","min:4","max:50"],
                        "nombres"           => ["required","alpha","min:4","max:50"],
                        "documento_nro"     => ["required","integer","between:1000000,99999999",'regex:/^\d{7,8}$/'],
                        "telefono_celular"  => ["required","integer","between:1000000000,999999999999999",'regex:/^\d{10,15}$/'],
                        "telefono_alt"      => ["nullable","integer","between:1000000000,999999999999999",'regex:/^\d{10,15}$/'],
                        "email"             => ["required",'email:rfc,dns',"min:12","max:50"],
                    ];

                    // Validar campos y manejar errores
                    $validator = Validator::make($request->all(), $rules);

                    // Manejar los errores de validación
                    if($validator->fails())
                        return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
                    
                    session()->put("shop.checkout.datos.apellidos",         $validator->valid()["apellidos"]);
                    session()->put("shop.checkout.datos.nombres",           $validator->valid()["nombres"]);
                    session()->put("shop.checkout.datos.documento_nro",     $validator->valid()["documento_nro"]);
                    session()->put("shop.checkout.datos.telefono_celular",  $validator->valid()["telefono_celular"]);
                    session()->put("shop.checkout.datos.telefono_alt",      $validator->valid()["telefono_alt"]);
                    session()->put("shop.checkout.datos.email",             $validator->valid()["email"]);

                    return response()->json(['success' => true]);
                    
                    break;
                }

                case(3):
                {
                    $rules = [
                        "radio_medioPago"   => ["required","exists:medios_pagos,id"],
                        "radio_medioEnvio"  => ["required","exists:medios_envios,id"],
                    ];

                    // Validar campos y manejar errores
                    $validator = Validator::make($request->all(), $rules);

                    // Manejar los errores de validación
                    if($validator->fails())
                        return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
                    
                    // Información sobre el medio de pago seleccionado
                    $medioPagoSeleccionado = MedioPago::find($request->input('radio_medioPago'));
                    session()->put("shop.checkout.medio_pago.id",    $medioPagoSeleccionado->id);
                    session()->put("shop.checkout.medio_pago.medio", $medioPagoSeleccionado->medio);

                    // Información sobre el medio de envío seleccionado
                    $medioEnvioSeleccionado = MedioEnvio::find($request->input('radio_medioEnvio'));
                    session()->put("shop.checkout.medio_envio.id",      $medioEnvioSeleccionado->id);
                    session()->put("shop.checkout.medio_envio.medio",   $medioEnvioSeleccionado->medio);
                    session()->put("shop.checkout.medio_envio.costo",   $medioEnvioSeleccionado->costo);

                    // Si el usuario ha seleccionado envío, aplicar reglas de validación adicionales
                    if($medioEnvioSeleccionado->id != 1)
                    {
                        // Definir las reglas de validación adicionales
                        $rules = [
                            "codigo_postal"             => ["required","numeric", "between:1000,9999"],
                            "localidad"                 => ["required","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                            "domicilio"                 => ["required","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                            "domicilio_nro"             => ["required","numeric", "min:1","max:99999"],
                            "domicilio_piso"            => ["nullable"],
                            "domicilio_depto"           => ["nullable"],
                            "domicilio_aclaraciones"    => ["nullable"],
                        ];
                    }

                    // Validar campos y manejar errores
                    $validator = Validator::make($request->all(), $rules);

                    // Manejar los errores de validación
                    if($validator->fails())
                        return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

                    if($medioEnvioSeleccionado->id != 1)
                    {
                        $keys = ["codigo_postal", "localidad", "domicilio", "domicilio_nro", "domicilio_piso", "domicilio_depto", "domicilio_aclaraciones"];
                        
                        foreach ($keys as $key)
                            if($request->has($key))
                                session()->put("shop.checkout.envio.$key", $request->input($key));
                    }

                    return response()->json(['success' => true]);

                    break;
                }

                case(4):
                {
                    return response()->json(['success' => true]);

                    break;
                }

                case(5):
                {
                    break;
                }
            }
        }

        //dd(session("shop.checkout"));

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

        return view("shop.checkout.index", compact("checkout", "mediosPagoListado", "mediosEnvioListado", "medioPagoSeleccionado", "medioEnvioSeleccionado", "tiposDocumentos", "cuentaBancaria"));
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
