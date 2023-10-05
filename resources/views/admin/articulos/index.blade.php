@extends("admin.layout.master")

@section("title","Artículos")

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}alert.css">
@endsection

@section("body")
    <div class="main-container">

        <h1>Listado de artículos</h1>

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

        <a class="btn-link btn-link-primary w100px" href="articulos/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>

        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Moneda</th>
                    <th>Categoría</th>
                    <th>Subcategoría</th>
                    <th>Visualizaciones</th>
                    <th>Foto 1</th>
                    <th>Foto 2</th>
                    <th>Foto 3</th>
                    <th>Foto 4</th>
                    <th>Foto 5</th>
                    <th>Foto 6</th>
                    <th>Foto 7</th>
                    <th>Foto 8</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articulos as $articulo)
                    <tr>
                        <td>{{ $articulo->codigo }}</td>
                        <td>{{ $articulo->nombre }}</td>
                        <td>{{ $articulo->descripcion }}</td>
                        <td>{{ _money($articulo->precio) }}</td>
                        <td>{{ $articulo->moneda }}</td>
                        <td>
                            @if(isset($articulo->categoria))
                                {{ $articulo->categoria->nombre }}
                            @endif
                        </td>
                        <td>
                            @if(isset($articulo->subcategoria))
                                {{ $articulo->subcategoria->nombre }}
                            @endif
                        </td>
                        <td>{{ $articulo->visualizaciones }}</td>
                        <td>{{ $articulo->foto_1 }}</td>
                        <td>{{ $articulo->foto_2 }}</td>
                        <td>{{ $articulo->foto_3 }}</td>
                        <td>{{ $articulo->foto_4 }}</td>
                        <td>{{ $articulo->foto_5 }}</td>
                        <td>{{ $articulo->foto_6 }}</td>
                        <td>{{ $articulo->foto_7 }}</td>
                        <td>{{ $articulo->foto_8 }}</td>
                        <td class="text-center">
                            <label class="switch">
                                <input type="checkbox" id="{{ $articulo->id }}" @if($articulo->estado) checked @endif>
                                <div class="slider round"></div>
                            </label>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection