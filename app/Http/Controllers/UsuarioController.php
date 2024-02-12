<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Usuario\StoreUsuarioRequest;
use App\Http\Requests\Usuario\UserLoginRequest;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use App\Mail\SignUp;
use App\Mail\Recovery;

use App\Models\Usuario;
use App\Models\Newsletter;

class UsuarioController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function register(Request $request)
	{
        $currentStep = $request->input("currentStep");

        $rules = [];

        switch($currentStep)
        {
            case(1):
                {
                    $rules = [
                        "apellidos"         => ["required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                        "nombres"           => ["required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                        "tipo_documento_id" => ["required","integer","min:1", "exists:tipos_documentos,id"],
                        "documento_nro"     => ["required","unique:usuarios,documento_nro","integer","min:6","max:99999999"],
                        "email"             => ["required","unique:usuarios,email"],
                    ];
    
                    break;
                }

            case(2):
            {
                $rules = [
                    "username"          => ["required","unique:usuarios,username","min:5","max:16","regex:#^[a-zA-Z0-9]*$#"],
                    "password"          => ["required","min:8","max:16"],
                    "password_repeat"   => ["same:password"],
                ];

                break;
            }

            case(3):
            {
                $rules = [
                ];

                break;
            }

            case(4):
            {
                $rules = [
                    "telefono_fijo"     => ["nullable","numeric","max:999999999999999"],
                    "telefono_celular"  => ["required","numeric","max:999999999999999"],
                    "telefono_alt"      => ["nullable","numeric","max:999999999999999"],
                ];

                break;
            }
        }

        // Validar campos y manejar errores
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        if($currentStep == 2)
        {
            $usuario = Usuario::make($request->all());
            $usuario->token_verificacion_email = Str::random(32);
            $usuario->save();

            if($request->input("check_suscribe"))
            {
                $newsletter = new Newsletter;
                $newsletter->suscribe($usuario->email);
            }

            Mail::to($usuario->email)->send(new SignUp($usuario->apellidos, $usuario->nombres, "http://ecommerce.dell/shop/activate/" . $usuario->token_verificacion_email));
        }

        // Lógica adicional según el paso actual
        return response()->json(['success' => true]);
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function recovery(Request $request)
	{
        if($request->filled("email") && $request->filled("telefono_celular"))
        {
            $telefono   = $request->input("telefono_celular");
            $email      = strtolower($request->input("email"));

            $usuario = Usuario::where("email", $email)->where("telefono_celular", $telefono)->first();

            if($usuario)
            {
                Mail::to($usuario->email)->send(new Recovery($usuario->apellidos, $usuario->nombres));

                return redirect()->route("user.login")->with("success", "Se ha enviado un correo a su casilla de correos");
            }
            else
            {
                return redirect()->back()->withErrors(trans("auth.failed"));
            }
        }

        return view("shop.recovery", ["success" => 0]);
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function login(UserLoginRequest $request)
	{
        // Almacena usuario y contraseña despues de la validación
        $credentials = $request->getCredentials();

        if(!Auth::attempt($credentials, $request->input("check_remember")))
            return redirect()->back()->withErrors(trans("auth.failed"));

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Verifica si la cuenta de usuario se encuentra verificada
        if($user->alta == NULL)
        {
            Auth::logout();
            return redirect()->back()->withErrors(trans("auth.unconfirmed"));
        }

        // Carga los datos del usuario en sesión
        session()->put("shop.usuario.datos", $user->toArray());

        if(Newsletter::where('email', session("shop.usuario.datos.email"))->count())
            session()->put("shop.newsletter", session("shop.usuario.datos.email"));

        return redirect()->back();
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function loginGuest()
    {
        session()->put("shop.usuario.datos.id", -1);
        session()->put("shop.usuario.datos.username", 'invitado');

        return redirect()->intended("shop");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function logout()
    {
        Auth::logout();
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
