@extends("admin.layout.master")

@php
    $title = "Listado de órdenes";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
@endsection

@php
    $breadcrumbs = [
    ];
@endphp

@section("body")
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
