@extends("shop.layout.master")

@php
    $title = "Mis compras";
@endphp

@section("title", $title)

@php
    $breadcrumbs = [
    ];
@endphp

@section("css")
@endsection

@section("js")
@endsection

@section("inlineCSS")
@endsection

@section("body")
    <div class="main-container">
        @include("shop.layout.breadcrumb")

    </div>
@endsection

@section("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            
        });
    </script>
@endsection