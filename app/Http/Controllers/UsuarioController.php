<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Usuario\StoreUsuarioRequest;
use App\Http\Requests\Usuario\UserLoginRequest;

use App\Models\Usuario;
use App\Models\Newsletter;

use App\Services\FavoritosService;

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
                    "username"          => ["required","unique:usuarios,username","min:5","max:16","regex:#^[a-zA-Z0-9]*$#"],
                    "password"          => ["required","min:8","max:16"],
                    "password_repeat"   => ["same:password"],
                ];

                break;
            }


            case(2):
            {
                $rules = [
                    "apellidos"         => ["required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                    "nombres"           => ["required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"],
                    "tipo_documento_id" => ["required","integer","min:1", "exists:tipos_documentos,id"],
                    "documento_nro"     => ["required","unique:usuarios,documento_nro","integer","min:6","max:99999999"],
                    "genero_id"         => ["integer","min:1","exists:generos,id"],
                    "cuil"              => ["nullable","numeric","digits:11"],
                    "cuit"              => ["nullable","numeric","digits:11"],
                    "fecha_nacimiento"  => ["required","date"],
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
                    "email"             => ["required","unique:usuarios,email"],
                ];

                break;
            }
        }

        // Validar campos y manejar errores
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);

        if($currentStep == 4)
        {
            $usuario = Usuario::make($request->all());
            $usuario->save();

            //return response()->json(['success' => true, 'redirect_url' => '/shop/login']);
        }

        // Lógica adicional según el paso actual
        return response()->json(['success' => true]);
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function recovery(Request $request)
	{
        if($request->filled("email") && $request->filled("telefono_celular"))
        {
            // Buscar un modelo que coincida con la información ingresada
            $usuario = Usuario::where("email",$request->get("email"))->where("telefono_celular",$request->get("telefono_celular"))->first();

            if($usuario)
            {
                // Enviar correo

                return view("shop.recovery", ["success" => 1]);
            }
            else
            {
                return view("shop.recovery", ["success" => 2]);
            }
        }

        return view("shop.recovery", ["success" => 0]);
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function login(UserLoginRequest $request, FavoritosService $favoritos)
	{
        // Almacena usuario y contraseña despues de la validación
        $credentials = $request->getCredentials();

        // Verificación de credenciales
        if(!Auth::validate($credentials))
            return redirect()->back()->withErrors(trans("auth.failed"));

        // Ejecuta Login y session
        if(Auth::attempt($credentials, $request->input("check_remember")))
        {
            $user = Auth::user();

            // Verifica si el usuario está confirmado
            if($user->estado == 0)
            {
                Auth::logout();
                return redirect()->back()->withErrors(trans("auth.unconfirmed"));
            }

            // Carga los favoritos del usuario
            $favoritos->load(Auth::id());
    
            // Carga los datos del usuario en sesión
            $usuario = Usuario::find(Auth::id())->toArray();
    
            foreach($usuario as $key => $value)
                session()->put("shop.usuario.datos.$key", $value);

            if(Newsletter::where('email', $usuario['email'])->count())
                session()->put("shop.newsletter", $usuario['email']);

            return redirect()->back();
        }
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
