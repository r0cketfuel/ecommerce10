<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usuario\StoreUsuarioRequest;
use App\Http\Requests\Usuario\UpdateUsuarioRequest;

use App\Models\TipoDocumento;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        $usuarios           = Usuario::all();
        $tiposDocumentos    = TipoDocumento::all();

        return view("admin.usuarios.index", compact('usuarios', 'tiposDocumentos'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function create()
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreUsuarioRequest $request)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Usuario $usuario)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function edit(Usuario $usuario)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        $usuario->update($request->all());

        return view("admin.usuarios.edit", compact('usuario'))->with("success", "Usuario actualizado exitosamente");
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Usuario $usuario)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
