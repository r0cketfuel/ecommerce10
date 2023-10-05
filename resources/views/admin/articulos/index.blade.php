@extends("admin.layout.master")

@section("title","Artículos")

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
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

        <h1>Listado de artículos</h1>

        <a class="btn-link btn-link-primary w100px" href="articulos/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>

        <table>
            <thead>
                <tr>
                    <th class="text-center">Código</th>
                    <th class="text-left">Nombre</th>
                    <th class="text-left">Descripción</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">Moneda</th>
                    <th class="text-left">Categoría</th>
                    <th class="text-left">Subcategoría</th>
                    <th class="text-center">Visualizaciones</th>
                    <th class="text-left">Foto 1</th>
                    <th class="text-left">Foto 2</th>
                    <th class="text-left">Foto 3</th>
                    <th class="text-left">Foto 4</th>
                    <th class="text-left">Foto 5</th>
                    <th class="text-left">Foto 6</th>
                    <th class="text-left">Foto 7</th>
                    <th class="text-left">Foto 8</th>
                    <th class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articulos as $articulo)
                    <tr>
                        <td class="text-center">{{ $articulo->codigo }}</td>
                        <td class="text-left">{{ $articulo->nombre }}</td>
                        <td class="text-left">{{ $articulo->descripcion }}</td>
                        <td class="text-right">{{ _money($articulo->precio) }}</td>
                        <td class="text-center">{{ $articulo->moneda }}</td>
                        <td class="text-left">
                            @if(isset($articulo->categoria))
                                {{ $articulo->categoria->nombre }}
                            @endif
                        </td>
                        <td class="text-left">
                            @if(isset($articulo->subcategoria))
                                {{ $articulo->subcategoria->nombre }}
                            @endif
                        </td>
                        <td class="text-right">{{ $articulo->visualizaciones }}</td>
                        <td class="text-left">{{ $articulo->foto_1 }}</td>
                        <td class="text-left">{{ $articulo->foto_2 }}</td>
                        <td class="text-left">{{ $articulo->foto_3 }}</td>
                        <td class="text-left">{{ $articulo->foto_4 }}</td>
                        <td class="text-left">{{ $articulo->foto_5 }}</td>
                        <td class="text-left">{{ $articulo->foto_6 }}</td>
                        <td class="text-left">{{ $articulo->foto_7 }}</td>
                        <td class="text-left">{{ $articulo->foto_8 }}</td>
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