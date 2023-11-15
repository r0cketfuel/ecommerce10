@extends("admin.layout.master")

@php
    $title = "Listado de subcategorías";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
@endsection

@section("body")
    <h1>{{ $title }}</h1>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="/admin"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > {{ $title }}
    </div>

    <a class="btn-link btn-link-primary w100px" href="banners/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>

    <table>
        <thead>
            <tr>
                <th class="text-left">Categoría</th>
                <th class="text-left">Nombre</th>
                <th class="text-left">Descripción</th>
                <th class="text-center">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcategorias as $subcategoria)
            <tr>
                <td>{{ $subcategoria->categoria->nombre }}</td>
                <td>{{ $subcategoria->nombre }}</td>
                <td>{{ $subcategoria->descripcion }}</td>
                <td class="text-center">
                    <label class="switch">
                        <input type="checkbox" id="{{ $subcategoria->id }}" @if($subcategoria->activo) checked @endif>
                        <div class="slider round"></div>
                    </label>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection