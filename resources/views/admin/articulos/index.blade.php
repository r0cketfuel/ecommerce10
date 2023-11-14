@extends("admin.layout.master")

@php
    $title = "Listado de artículos";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{config('constants.admin_css')}}table.css">
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
            </div>
        @endif

        @if (session("success"))
            <div class="alert success">
                {{session("success")}}
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        @if (session("error"))
            <div class="alert danger">
                {{session("error")}}
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        <h1>{{ $title }}</h1>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/admin"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a> > {{ $title }}
        </div>

        <a class="btn-link btn-link-primary w100px" href="articulos/create"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>

        <table>
            <thead>
                <tr>
                    <th class="text-center">Código</th>
                    <th class="text-left">Nombre</th>
                    <th class="text-left">Descripción</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">Moneda</th>
                    <th class="text-left">Categoría</th>
                    <th class="text-left">Subcategoría</th>
                    <th class="text-center">Visualizaciones</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articulos as $articulo)
                    <tr>
                        <td class="text-center">{{ $articulo->codigo }}</td>
                        <td class="text-left">{{ $articulo->nombre }}</td>
                        <td class="text-left">{{ $articulo->descripcion }}</td>
                        <td class="text-right">{{ _money($articulo->precio) }}</td>
                        <td class="text-center">{{ $articulo->moneda }}</td>
                        <td class="text-left">
                            @if(isset($articulo->categoria))
                                {{ $articulo->categoria->nombre }}
                            @endif
                        </td>
                        <td class="text-left">
                            @if(isset($articulo->subcategoria))
                                {{ $articulo->subcategoria->nombre }}
                            @endif
                        </td>
                        <td class="text-right">{{ $articulo->visualizaciones }}</td>
                        <td class="text-center">
                            <label class="switch">
                                <input type="checkbox" id="{{ $articulo->id }}" @if($articulo->estado) checked @endif>
                                <div class="slider round"></div>
                            </label>
                        </td>
                        <td class="text-center">
                            <button type="button" class="deleteButton" id="{{ $articulo->id }}"><i class="fa-solid fa-trash"></i></button>
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const switches = [...document.querySelectorAll("input[type='checkbox']")];

            for (let i = 0; i < switches.length; ++i)
            {
                switches[i].addEventListener("change", function () {
                    const articleId = switches[i].getAttribute('id');
                    const newState = switches[i].checked ? 1 : 0;
                    ajaxItemDisable(articleId, newState);
                    return false;
                });
            }

            const buttons = [...document.querySelectorAll("button[type='button']")];

            for (let i = 0; i < buttons.length; ++i)
            {
                buttons[i].addEventListener("click", function () {
                    const articleId = buttons[i].getAttribute('id');
                    ajaxItemDelete(articleId);
                    return false;
                });
            }

        });

        async function ajaxItemDisable(articleId, newState)
        {
            try {
                const response = await fetch(`/api/articulos/${articleId}`, {
                    method: "PUT",
                    headers: {
                        'Accept':       'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ estado: newState })
                });

                if (response.ok)
                {
                    console.log('Se cambió el estado del artículo');
                }
                else
                {
                    console.error('Error al cambiar el estado del artículo');
                }
            }
            catch (error)
            {
                console.error('Error en la solicitud:', error);
            }
        }

        async function ajaxItemDelete(articleId)
        {
            try {
                const response = await fetch(`/api/articulos/${articleId}`, {
                    method: "DELETE",
                    headers: {
                        'Accept':       'application/json',
                        'Content-Type': 'application/json',
                    },
                });

                if (response.ok)
                {
                    console.log('Artículo eliminado');
                }
                else
                {
                    console.error('Error al eliminar el artículo');
                }
            }
            catch (error)
            {
                console.error('Error en la solicitud:', error);
            }
        }
    </script>

@endsection
