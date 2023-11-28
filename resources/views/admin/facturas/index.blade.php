@extends("admin.layout.master")

@php
    $title = "Listado de facturas";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
    <link rel="stylesheet"	href="{{config('constants.framework_css')}}modal.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.framework_js') }}modal.js"></script>
@endsection

@section("inlineCSS")
    <style>
        .input-container {
            position:   relative;
            display: 	inline-block;
            width: 		100%;
        }
    </style>
@endsection

@php
    $breadcrumbs = [
    ];
@endphp

@section("body")
    @includeIf('admin.facturas.modals.filter')

    <div class="alert"></div>

    <div class="flex justify-between">
        <div class="input-container">
            <input form="form-search" type="text" name="busqueda" value="{{ isset($busqueda['searchbar']) ? $busqueda['searchbar'] : '' }}" placeholder="{{ __('general.search') }}...">
            <button form="form-search" type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <button class="filterButton" id="boton_filtros"><i class="fa-solid fa-filter"></i></button>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">Número</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Tipo</th>
                <th class="text-left">Apellidos</th>
                <th class="text-left">nombres</th>
                <th class="text-left">Documento</th>
                <th class="text-left">Cuil</th>
                <th class="text-center">Cuit</th>
                <th class="text-center">Domicilio</th>
                <th class="text-center">Total</th>
                <th class="text-center">Medio Pago</th>
                <th class="text-center">Medio Envío</th>
                <th class="text-center">CAE</th>
                <th class="text-center">CAE Vto</th>
                <th class="text-center">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
                <tr>
                    <td class="text-center">{{ $factura->numero }}</td>
                    <td class="text-center">{{ _datetime($factura->fecha) }}</td>
                    <td class="text-center">{{ $factura->tipo->tipo }}</td>
                    <td class="text-left">{{ $factura->apellidos }}</td>
                    <td class="text-left">{{ $factura->nombres }}</td>
                    <td class="text-center">{{ $factura->documento_nro }}</td>
                    <td class="text-right">{{ $factura->cuil }}</td>
                    <td class="text-right">{{ $factura->cuit }}</td>
                    <td class="text-right">{{ $factura->domicilio }}</td>
                    <td class="text-right">{{ _money($factura->total) }}</td>
                    <td class="text-right">{{ $factura->medioPago->medio }}</td>
                    <td class="text-right">{{ $factura->medioEnvio->medio }}</td>
                    <td class="text-right">{{ $factura->cae }}</td>
                    <td class="text-right">{{ _date($factura->cae_vto) }}</td>
                    <td class="text-right">{{ $factura->estado->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection