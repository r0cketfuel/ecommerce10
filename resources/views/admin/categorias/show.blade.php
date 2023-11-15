@extends("admin.layout.master")

@section("title", "Detalle banner")

@section("body")
    <h1>Editar categoría</h1>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="/admin"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > Editar categoría
    </div>

    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Link</th>
                <th>Valido Desde</th>
                <th>Valido Hasta</th>
                <th>Activo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="{{ $banner->imagen }}" alt="{{ $banner->descripcion }}" width="100"></td>
                <td>{{ $banner->descripcion }}</td>
                <td><a href="/{{ $banner->link }}">/{{ $banner->link }}</a></td>
                <td>{{ $banner->valido_desde }}</td>
                <td>{{ $banner->valido_hasta }}</td>
                <td>{{ $banner->activo }}</td>
            </tr>
        </tbody>
    </table>
@endsection