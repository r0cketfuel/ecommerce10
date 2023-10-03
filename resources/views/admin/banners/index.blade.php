@extends("admin.layout.master")

@section("title","Banners")

@section("body")
    <div class="main-container">

        <h1>Banners Home</h1>

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
            <a class="btn-link btn-link-primary" href="banners/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>
        </div>

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
                    <td>{{ $banner->valido_desde }}</td>
                    <td>{{ $banner->valido_hasta }}</td>
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