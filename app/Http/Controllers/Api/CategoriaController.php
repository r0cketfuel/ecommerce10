<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categoria\StoreCategoriaRequest;
use App\Http\Requests\Categoria\UpdateCategoriaRequest;

use App\Models\Categoria;

class CategoriaController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        return response()->json(Categoria::all(), 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreCategoriaRequest $request)
    {
        $categoria = new Categoria;

        $categoria = Categoria::make($request->validated());
        $categoria->save();
    
        return response()->json($categoria, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Categoria $categoria)
    {
        return response()->json($categoria, 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $categoria->update($request->all());
    
        return response()->json(['message' => 'Categoría actualizada con éxito']);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Categoria $categoria)
    {
        Categoria::eliminaCategoria($categoria->id);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
