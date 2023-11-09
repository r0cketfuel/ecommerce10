@extends("admin.layout.master")

@section("title", "Usuarios")

@section("css")
    <link rel="stylesheet" href="{{ config('constants.admin_css') }}table.css">
    <link rel="stylesheet" href="{{ config('constants.framework_css') }}alert.css">
@endsection

@section("body")
    <div class="main-container">

        @if ($errors->any())
            <div class="alert danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session("success"))
            <div class="alert success">
                {{ session("success") }}
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        @if (session("error"))
            <div class="alert danger">
                {{ session("error") }}
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
        @endif

        <h1>Listado de usuarios</h1>

        <table>
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-left">Nombre</th>
                    <th class="text-center">Documento</th>
                    <th class="text-center">Domicilio</th>
                    <th class="text-center">Localidad</th>
                    <th class="text-center">Teléfonos</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Creado</th>
                    <th class="text-center">Alta</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td class="text-center">{{ $usuario->id }}</td>
                        <td class="text-left">{{ $usuario->apellidos }}<br>{{ $usuario->nombres }}</td>
                        <td class="text-left">{{ $usuario->tipoDocumento->tipo }}<br>{{ $usuario->documento_nro }}</td>
                        <td class="text-left">{{ $usuario->domicilio }} {{ $usuario->domicilio_nro }}<br>{{ $usuario->domicilio_piso }} {{ $usuario->domicilio_depto }}</td>
                        <td class="text-left">{{ $usuario->localidad }}<br>{{ $usuario->codigo_postal }}</td>
                        <td class="text-left">
                            <div class="flex justify-between"><div>Fijo:</div><div>{{ $usuario->telefono_fijo }}</div></div>
                            <div class="flex justify-between"><div>Celular:</div><div>{{ $usuario->telefono_celular }}</div></div>
                            <div class="flex justify-between"><div>Alt:</div><div>{{ $usuario->telefono_alt }}</div></div>
                        </td>
                        <td class="text-left">{{ $usuario->email }}</td>
                        <td class="text-center">
                            <label class="switch">
                                <input type="checkbox" id="{{ $usuario->id }}" @if($usuario->estado) checked @endif>
                                <div class="slider round"></div>
                            </label>
                        </td>
                        <td class="text-center">{{ _dateTime($usuario->creado) }}</td>
                        <td class="text-center">
                            @if ($usuario->alta)
                                {{ _dateTime($usuario->alta) }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const switches = [...document.querySelectorAll("input[type='checkbox']")];

            for (let i = 0; i < switches.length; ++i) {
                switches[i].addEventListener("change", function () {
                    const userId = switches[i].getAttribute('id');
                    const newState = switches[i].checked ? 1 : 0;
                    ajaxUserDisable(userId, newState);
                    return false;
                });
            }
        });

        async function ajaxUserDisable(userId, newState) {
            try {
                const response = await fetch(`/api/usuarios/${userId}`, {
                    method: "PUT",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ estado: newState })
                });

                if (response.ok) {
                    // Actualización exitosa, puedes realizar acciones adicionales aquí
                } else {
                    // Manejar errores si es necesario
                    console.error('Error al cambiar el estado del usuario');
                }
            } catch (error) {
                console.error('Error en la solicitud:', error);
            }
        }
    </script>
@endsection
