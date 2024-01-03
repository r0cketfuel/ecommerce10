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
        @if(count($items))
            @foreach($items as $item)

            @endforeach
        @else
            <p>{{ __("general.empty_purchase_list") }}</p>
        @endif
    </div>
@endsection

@section("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            
        });
    </script>
@endsection