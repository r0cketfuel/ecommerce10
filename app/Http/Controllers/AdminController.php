<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;

use App\Models\Administrador;

class AdminController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        return view("admin.index");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function login(AdminLoginRequest $request)
	{
        // Almacena usuario y contraseña despues de la validación
        $credentials = $request->getCredentials();
        
        // Verificación de credenciales
        if(!Auth::guard("admin")->validate($credentials))
            return redirect()->back()->withErrors(trans("auth.failed"));

        // Ejecuta Login y session
        Auth::guard("admin")->attempt($credentials, $request->input("check_remember"));

        // Carga los datos del usuario en sesión
        $usuario = Administrador::find(Auth::guard("admin")->id())->toArray();

        foreach($usuario as $key => $value)
            session()->put("admin.usuario.datos.$key", $value);

        return redirect()->intended("admin/dashboard");
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function dashboard()
	{
        return view("admin.dashboard");
	}
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function logout(Request $request)
    {
        Auth::guard("admin")->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
    
        return redirect()->route('admin.login');
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
