<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserLoginRequest;

use App\Models\Usuario;
use App\Services\FavoritosService;

class UserController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function register(RegisterRequest $request)
	{
        $usuario = Usuario::make($request->validated());
        $usuario->creado = date(now());
        $usuario->save();

        return redirect("shop/login")->with("success", "Cuenta creada exitosamente");
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
    
            return redirect()->intended("shop");
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
