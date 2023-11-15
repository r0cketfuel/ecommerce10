@extends("admin.layout.master")

@section("title", "Categorías")

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
@endsection

@section("body")
    <h1>Listado de categorías</h1>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="/admin"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > Listado de categorías
    </div>

    <a class="btn-link btn-link-primary w100px" href="categorias/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>

    <table>
        <thead>
            <tr>
                <th class="text-left">Nombre</th>
                <th class="text-left">Descripción</th>
                <th class="text-center">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td class="text-center">
                    <label class="switch">
                        <input type="checkbox" id="{{ $categoria->id }}" @if($categoria->activo) checked @endif>
                        <div class="slider round"></div>
                    </label>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection