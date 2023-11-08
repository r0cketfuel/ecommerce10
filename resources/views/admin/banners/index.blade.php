@extends("admin.layout.master")

@section("title","Banners")

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

        <h1>Listado de banners</h1>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/admin">Home</a> > Listado de banners
        </div>

        <a class="btn-link btn-link-primary w100px" href="banners/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>

        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>Link</th>
                    <th>Valido Desde</th>
                    <th>Valido Hasta</th>
                    <th>Activo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $banner)
                <tr>
                    <td><img src="{{ $banner->imagen }}" alt="{{ $banner->descripcion }}" width="100"></td>
                    <td>{{ $banner->descripcion }}</td>
                    <td><a href="/{{ $banner->link }}">/{{ $banner->link }}</a></td>
                    <td>{{ _dateTime($banner->valido_desde) }}</td>
                    <td>{{ _dateTime($banner->valido_hasta) }}</td>
                    <td class="text-center">
                        <label class="switch">
                            <input type="checkbox" id="{{ $banner->id }}" @if($banner->activo) checked @endif>
                            <div class="slider round"></div>
                        </label>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection