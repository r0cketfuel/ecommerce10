@extends("admin.layout.master")

@section("title", "Nueva categoría")

@section("css")
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}panel.css">
@endsection

@section("body")    
    <h1>Nueva categoría</h1>

    <div class="panel">
        <div class="panel-content">
            <button form="form" class="btn-primary">Guardar</button>
        </div>
    </div>
    
    <form id="form" method="post"  enctype="multipart/form-data" action="{{ route('banners.store') }}">@csrf</form>
@endsection
