<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subcategoria\StoreSubcategoriaRequest;
use App\Http\Requests\Subcategoria\UpdateSubcategoriaRequest;

use App\Models\Subcategoria;

class SubcategoriaController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        return response()->json(Subcategoria::all(), 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreSubcategoriaRequest $request)
    {
        $categoria = new Subcategoria;

        $categoria = Subcategoria::make($request->validated());
        $categoria->save();
    
        return response()->json($categoria, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Subcategoria $categoria)
    {
        return response()->json($categoria, 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateSubcategoriaRequest $request, Subcategoria $categoria)
    {
        $categoria->update($request->all());
    
        return response()->json(['message' => 'Subcategoría actualizada con éxito']);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Subcategoria $categoria)
    {
        Subcategoria::eliminaSubcategoria($categoria->id);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
