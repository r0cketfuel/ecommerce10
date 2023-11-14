@extends("admin.layout.master")

@php
    $title = "Nuevo banner";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
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
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        <h1>{{ $title }}</h1>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/admin"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > <a href="/admin/banners">Banners</a> > {{ $title }}
        </div>
        
        <div class="panel">
            <div class="panel-content">
                <label>
                    Imágen
                    <input  form="form" type="file" name="imagen" value="{{ old('imagen') }}">
                </label>
    
                <label>
                    Descripción
                    <input  form="form" type="text" name="descripcion" value="{{ old('descripcion') }}" placeholder="Breve descripción del banner">
                </label>
    
                <label>
                    Link
                    <input  form="form" type="text" name="link" value="{{ old('link') }}" placeholder="Página a donde lleva el banner">
                </label>
    
                <label>
                    Válido desde
                    <input  form="form" type="date" name="valido_desde" value="{{ old('valido_desde') }}">
                </label>
    
                <label>
                    Válido hasta
                    <input  form="form" type="date" name="valido_hasta" value="{{ old('valido_hasta') }}">
                </label>
    
                <label>
                    <div class="radio-fix"><input form="form" type="checkbox" name="activo" value="1" @if(old('activo')) checked @endif>Activo</div>
                </label>
    
                <button form="form" class="btn-primary">Guardar</button>
            </div>
        </div>
        
        <form id="form" method="post"  enctype="multipart/form-data" action="{{ route('banners.store') }}">@csrf</form>

    </div>
@endsection
