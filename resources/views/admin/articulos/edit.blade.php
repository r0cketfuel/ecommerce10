@extends("admin.layout.master")

@php
    $title = "Editar artículo";
@endphp

@section("title", $title)


@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}alert.css">
@endsection

@section("body")
    <div class="main-container">

        @if ($errors->any())
            <div class="alert danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session("success"))
            <div class="alert success">
                {{session("success")}}
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        @if (session("error"))
            <div class="alert danger">
                {{session("error")}}
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        <h1>{{ $title }}</h1>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/admin"><i class="fa-solid fa-house fa-sm"></i> Home</a> > <a href="/admin/articulos">Artículos</a> > {{ $title }}
        </div>

        <div class="panel">
            <div class="panel-content">
                <label>
                    Nombre del Artículo
                    <input form="form" type="text" name="nombre" class="form-control" value="{{ $articulo->nombre }}">
                </label>
        
                <label>
                    Descripción
                    <textarea form="form" name="descripcion" class="form-control">{{ $articulo->descripcion }}</textarea>
                </label>
                
                <label>
                    Categoría
                    <select form="form" name="categoria" class="form-control">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $articulo->categoria_id == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </label>
        
                <label>Subcategoría
                    <select form="form" name="subcategoria" class="form-control">
                        @foreach ($subcategorias as $subcategoria)
                            <option value="{{ $subcategoria->id }}" {{ $articulo->subcategoria_id == $subcategoria->id ? 'selected' : '' }}>
                                {{ $subcategoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </label>
        
                <label>
                    Talle
                    <select form="form" name="talle" class="form-control">
                        @foreach ($talles as $talle)
                            <option value="{{ $talle->id }}" {{ $articulo->talle_id == $talle->id ? 'selected' : '' }}>
                                {{ $talle->talle }}
                            </option>
                        @endforeach
                    </select>
                </label>
        
                <button form="form" type="submit" class="btn btn-primary">Actualizar Artículo</button>
            </div>
        </div>


    </div>

    <form id="form" method="POST" action="{{ route('articulos.update', $articulo) }}">@csrf @method('PUT')</form>
@endsection