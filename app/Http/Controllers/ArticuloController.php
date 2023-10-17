<?php

namespace App\Http\Controllers;

use App\Http\Requests\Articulo\StoreArticuloRequest;
use App\Http\Requests\Articulo\UpdateArticuloRequest;

use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Talle;

class ArticuloController extends Controller
{
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function index()
    {
        $articulos = Articulo::all()->where("activo", True);

        return view("admin.articulos.index", compact('articulos'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function create()
    {
        $categorias     = Categoria::all();
        $subcategorias  = Subcategoria::all();

        $talles = Talle::all();

        return view("admin.articulos.create", compact('categorias', 'subcategorias', 'talles'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function store(StoreArticuloRequest $request)
    {
        $articulo = new Articulo;

        $articulo = Articulo::make($request->validated());
        $articulo->save();
    
        return response()->json($articulo, 201);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function show(Articulo $articulo)
    {
        $articulo = Articulo::find($articulo->id);

        return view("admin.articulos.show", compact('articulo'));
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function edit(Articulo $articulo)
    {
        //
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function update(UpdateArticuloRequest $request, Articulo $articulo)
    {        
        $articulo->update($request->all());
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
    public function destroy(Articulo $articulo)
    {
        Articulo::eliminaArticulo($articulo->id);
    }
    //------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
}
