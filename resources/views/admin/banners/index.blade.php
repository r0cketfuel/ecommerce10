@extends("admin.layout.master")

@php
    $title = "Banners";
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
@endsection