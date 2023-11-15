@extends("admin.layout.master")

@php
    $title = "Detalle usuario";
@endphp

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
@endsection

@section("title", $title)

@section("body")
    @php
        $breadcrumbs = [
            ['link' => '/admin/usuarios', 'title' => 'Usuarios'],
        ];
    @endphp
@endsection