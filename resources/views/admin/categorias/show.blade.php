@extends("admin.layout.master")

@php
    $title = "Detalle categoría";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
@endsection

@section("body")
    @php
        $breadcrumbs = [
            ['link' => '/admin/categorias', 'title' => 'Categorías'],
        ];
    @endphp
@endsection