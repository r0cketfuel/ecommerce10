@extends("admin.layout.master")

@section("title","Nuevo banner")

@section("body")
    <div class="main-container">

        <h1>Banners create</h1>

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

        <div class="panel">
            <div class="panel-content">
                <label>
                    Imágen
                    <input  form="form" type="text" name="imagen" value="{{ old('imagen') }}">
                </label>
    
                <label>
                    Descripción
                    <input  form="form" type="text" name="descripcion" value="{{ old('descripcion') }}">
                </label>
    
                <label>
                    Link
                    <input  form="form" type="text" name="link" value="{{ old('link') }}">
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
                    Activo
                    <input form="form" type="checkbox" name="activo" value="1" @if(old('activo')) checked @endif>
                </label>
    
                <button form="form" class="btn-primary">Guardar</button>
            </div>
        </div>
        
        <form id="form" method="post" action="{{ route('banners.store') }}">@csrf</form>

    </div>
@endsection
