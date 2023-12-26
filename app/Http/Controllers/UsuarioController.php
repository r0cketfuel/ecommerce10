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

        $rules      = [];
        $messages   = [];

        if($currentStep == 1)
        {
            $rules = [
                "username"          => array("required","unique:usuarios,username","min:5","max:16","regex:#^[a-zA-Z0-9]*$#"),
                "password"          => array("required","min:8","max:16"),
                "password_repeat"   => array("same:password"),
            ];

            $messages = [
                // Mensajes de error específicos para la pantalla 1
            ];
        }

        if($currentStep == 2)
        {
            $rules = [
                "apellidos"         => array("required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"),
                "nombres"           => array("required","min:4","max:50","regex:#^[a-zA-ZñÑáÁéÉíÍóÓúÚüÜ\s]*$#"),
                "tipo_documento_id" => array("required","integer","min:1", "exists:tipos_documentos,id"),
                "documento_nro"     => array("required","unique:usuarios,documento_nro","min:1","max:99999999"),
                "genero_id"         => array("integer","min:1","exists:generos,id"),
                "cuil"              => array("nullable","numeric","digits:11"),
                "cuit"              => array("nullable","numeric","digits:11"),
                "fecha_nacimiento"  => array("required","date"),
            ];
            
            $messages = [
                // Mensajes de error específicos para la pantalla 2
            ];
        }

        if($currentStep == 3)
        {
            $rules = [
            ];
            
            $messages = [
                // Mensajes de error específicos para la pantalla 3
            ];
        }

        if($currentStep == 4)
        {
            $rules = [
                "telefono_fijo"     => array("nullable","numeric","max:999999999999999"),
                "telefono_celular"  => array("required","numeric","max:999999999999999"),
                "telefono_alt"      => array("nullable","numeric","max:999999999999999"),
                "email"             => array("required","unique:usuarios,email"),
            ];
            
            $messages = [
                // Mensajes de error específicos para la pantalla 4
            ];
        }

        // Validar campos y manejar errores
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
            return response()->json(['errors' => $validator->errors()], 422);

        if($currentStep == 4)
        {
            $usuario = Usuario::make($request->all());
            $usuario->save();

            //return redirect("shop/login")->with("success", "Cuenta creada exitosamente");
            return response()->json(['success' => true, 'redirect_url' => '/shop/login']);
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
