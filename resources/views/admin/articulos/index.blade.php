@extends("admin.layout.master")

@section("title","Artículos")

@section("body")
    <div class="main-container">

        <h1>Artículos Home</h1>

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
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{session("success")}}
            </div>
        @endif

        @if (session("error"))
            <div class="alert danger">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{session("error")}}
            </div>
        @endif

        <div class="flex">
            <div style="width: 100px"><a class="btn-link btn-link-primary" href="articulos/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a></div>
        </div>

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
                        <td>{{ $articulo->precio }}</td>
                        <td>{{ $articulo->moneda }}</td>
                        <td>{{ $articulo->categoria_id }}</td>
                        <td>{{ $articulo->subcategoria_id }}</td>
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