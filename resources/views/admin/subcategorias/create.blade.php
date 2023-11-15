@extends("admin.layout.master")

@php
    $title = "Nueva subcategoría";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
@endsection

@section("body")
    <h1>{{ $title }}</h1>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="/admin"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > Subcategorías > {{ $title }}
    </div>

    <div class="panel">
        <div class="panel-content">
            <button form="form" class="btn-primary">Guardar</button>
        </div>
    </div>
    
    <form id="form" method="post"  enctype="multipart/form-data" action="{{ route('banners.store') }}">@csrf</form>
@endsection
