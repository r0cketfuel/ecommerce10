@extends("admin.layout.master")

@section("title","Nueva subcategoría")

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

        <h1>Nueva subcategoría</h1>

        <div class="panel">
            <div class="panel-content">
                <button form="form" class="btn-primary">Guardar</button>
            </div>
        </div>
        
        <form id="form" method="post"  enctype="multipart/form-data" action="{{ route('banners.store') }}">@csrf</form>

    </div>
@endsection
