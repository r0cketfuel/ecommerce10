@extends("admin.layout.master")

@php
    $title = "Información del comercio";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet" href="{{ config('constants.framework_css') }}panel.css">
    <link rel="stylesheet" href="{{ config('constants.framework_css') }}alert.css">
@endsection

@section("body")
    <div class="main-container">

        @if ($errors->any())
            <div class="alert danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session("success"))
            <div class="alert success">
                {{ session("success") }}
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        @if (session("error"))
            <div class="alert danger">
                {{ session("error") }}
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        <h1>{{ $title }}</h1>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/admin"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > {{ $title }}
        </div>

        <div class="panel" style="padding: 10px;">
            <div class="panel-content">
                @foreach ($comercio->getAttributes() as $campo => $valor)
                    @if ($campo != "id")
                        <label for="{{ $campo }}">{{ ucfirst($campo) }}</label>
                        <input form="form" type="text" id="{{ $campo }}" name="{{ $campo }}" value="{{ $valor }}">
                    @endif
                @endforeach
                <button form="form" class="btn-primary" type="submit">Guardar</button>
            </div>
        </div>

    </div>

    <form id="form" method="post">@csrf</form>

@endsection
