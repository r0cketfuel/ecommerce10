@extends("admin.layout.master")

@php
    $title = "Detalle de banner";
@endphp

@section("title", $title)

@section("body")
    <div class="main-container">

        <h1>{{ $title }}</h1>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/admin"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > <a href="/admin/banners">Banners</a> > {{ $title }}
        </div>

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
                <tr>
                    <td><img src="{{ $banner->imagen }}" alt="{{ $banner->descripcion }}" width="100"></td>
                    <td>{{ $banner->descripcion }}</td>
                    <td><a href="/{{ $banner->link }}">/{{ $banner->link }}</a></td>
                    <td>{{ $banner->valido_desde }}</td>
                    <td>{{ $banner->valido_hasta }}</td>
                    <td>{{ $banner->activo }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection