@extends("shop.layout.master")

@php
    $title = "Página de pruebas";
@endphp

@section("title", $title)

@section("css")

@endsection

@section("inlineCSS")
	<style>
	</style>
@endsection

@section("body")
    <div class="main-container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/shop"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > {{ $title }}
        </div>

    </div>
@endsection

@section("scripts")
	<script>
		document.addEventListener("DOMContentLoaded", function() {

		});
    </script>
@endsection
