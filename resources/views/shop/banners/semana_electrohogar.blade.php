@extends("shop.layout.master")

@php
    $title = "Semana Electrohogar";
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

@section("body")
    <div class="main-container">
        @include("shop.layout.breadcrumb")
    </div>
@endsection