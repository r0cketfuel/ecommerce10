@extends("admin.layout.master")

@section("title","Categorías")

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

        <h1>Listado de categorías</h1>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/admin">Home</a> > Listado de categorías
        </div>

        <a class="btn-link btn-link-primary w100px" href="categorias/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
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
    </div>
@endsection