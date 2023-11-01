<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;

use App\Models\Administrador;
use App\Models\Usuario;

class AdminController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        // Usuario autenticado, redirigir a la página dashboard
        if(Auth::guard("admin")->check())
            return redirect("/admin/dashboard");

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
        $widgets = [
            [
                "title" => "Usuarios",
                "color" => "green",
                "value" => Usuario::all()->count(),
                "link"  => ["url" => "/admin/usuarios", "title" => "Listado"],
                "icon"  => "<i class='fa-solid fa-user'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 2",
                "color" => "orange",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 2"],
                "icon"  => "<i class='fa-solid fa-star'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 3",
                "color" => "blue",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 3"],
                "icon"  => "<i class='fa-solid fa-bell'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 4",
                "color" => "green",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 4"],
                "icon"  => "<i class='fa-solid fa-bolt'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 5",
                "color" => "yellow",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 5"],
                "icon"  => "<i class='fa-solid fa-paperclip'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 6",
                "color" => "blue",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 6"],
                "icon"  => "<i class='fa-solid fa-user'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 7",
                "color" => "green",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 7"],
                "icon"  => "<i class='fa-solid fa-truck-fast'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 8",
                "color" => "red",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 8"],
                "icon"  => "<i class='fa-solid fa-bell'></i>",
                "extra" => "",
            ],
            [
                "title" => "Widget 9",
                "color" => "orange",
                "value" => rand(0,999),
                "link"  => ["url" => "/admin", "title" => "Link 9"],
                "icon"  => "<i class='fa-solid fa-bolt'></i>",
                "extra" => "",
            ]
        ];

        return view("admin.dashboard", compact("widgets"));
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
