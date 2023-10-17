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
        $subcategoria = new Subcategoria;

        $subcategoria = Subcategoria::make($request->validated());
        $subcategoria->save();
    
        return response()->json($subcategoria, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }    
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Subcategoria $subcategoria)
    {
        return response()->json($subcategoria, 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateSubcategoriaRequest $request, Subcategoria $subcategoria)
    {
        $subcategoria->update($request->all());
    
        return response()->json(['message' => 'Subcategoría actualizada con éxito']);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Subcategoria $subcategoria)
    {
        Subcategoria::eliminaSubcategoria($subcategoria->id);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
