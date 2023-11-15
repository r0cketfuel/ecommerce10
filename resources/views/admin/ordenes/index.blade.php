@extends("admin.layout.master")

@php
    $title = "Listado de ordenes";
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

    <table>
        <thead>
            <tr>
                <th class="text-center">id</th>
                <th class="text-center">estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordenes as $orden)
                <tr>
                    <td class="text-center">{{ $orden->id }}</td>
                    <td class="text-center">{{ $orden->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
