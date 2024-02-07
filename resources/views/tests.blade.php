@php
    $title = "Página de pruebas";
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title }}</title>

        <!-- Hojas de estilo -->
        <link rel="stylesheet" href="{{ config('constants.framework_css') }}normalize.css">
        <link rel="stylesheet" href="{{ config('constants.shop_css') }}headers.css">
        <link rel="stylesheet" href="{{ config('constants.framework_css') }}links.css">

            <!-- Font awesome -->
            <link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body id="top">

    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
    
        });
    </script>
</html>