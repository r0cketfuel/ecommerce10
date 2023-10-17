<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articulo\StoreArticuloRequest;
use App\Http\Requests\Articulo\UpdateArticuloRequest;

use App\Models\Articulo;

class ArticuloController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        return response()->json(Articulo::all(), 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreArticuloRequest $request)
    {
        $articulo = new Articulo;

        $articulo = Articulo::make($request->validated());
        $articulo->save();
    
        return response()->json($articulo, 201, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Articulo $articulo)
    {
        return response()->json($articulo, 200, ['Content-type'=>'application/json;charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateArticuloRequest $request, Articulo $articulo)
    {        
        $articulo->update($request->all());
    
        return response()->json(['message' => 'Artículo actualizado con éxito']);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Articulo $articulo)
    {
        Articulo::eliminaArticulo($articulo->id);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
