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

        <a class="btn-link btn-link-primary w100px" href="{{ route('usuarios.create') }}"><span><i class="fa-solid fa-plus"></i></span>Nuevo</a>

        <table>
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-left">Username</th>
                    <th class="text-left">Nombre</th>
                    <th class="text-center">Documento</th>
                    <th class="text-center">Cuit</th>
                    <th class="text-center">Cuil</th>
                    <th class="text-center">Fecha de Nacimiento</th>
                    <th class="text-center">Género</th>
                    <th class="text-center">Domicilio</th>
                    <th class="text-center">Domicilio Nro</th>
                    <th class="text-center">Domicilio Piso</th>
                    <th class="text-center">Domicilio Depto</th>
                    <th class="text-center">Domicilio Aclaraciones</th>
                    <th class="text-center">Localidad</th>
                    <th class="text-center">Código Postal</th>
                    <th class="text-center">Teléfono Fijo</th>
                    <th class="text-center">Teléfono Celular</th>
                    <th class="text-center">Teléfono Alternativo</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Creado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td class="text-center">{{ $usuario->id }}</td>
                        <td class="text-left">{{ $usuario->username }}</td>
                        <td class="text-left">{{ $usuario->apellidos }},<br>{{ $usuario->nombres }}</td>
                        <td class="text-center">
                            @if($usuario->tipoDocumento)
                                {{ $usuario->tipoDocumento->tipo }}
                            @endif
                            {{ $usuario->documento_nro }}
                        </td>
                        <td class="text-center">{{ $usuario->cuit }}</td>
                        <td class="text-center">{{ $usuario->cuil }}</td>
                        <td class="text-center">{{ _date($usuario->fecha_nacimiento) }}</td>
                        <td class="text-left">
                            @if($usuario->genero)
                                {{ $usuario->genero->genero }}
                            @endif
                        </td>
                        <td class="text-left">{{ $usuario->domicilio }}</td>
                        <td class="text-center">{{ $usuario->domicilio_nro }}</td>
                        <td class="text-center">{{ $usuario->domicilio_piso }}</td>
                        <td class="text-center">{{ $usuario->domicilio_depto }}</td>
                        <td class="text-left">{{ $usuario->domicilio_aclaraciones }}</td>
                        <td class="text-left">{{ $usuario->localidad }}</td>
                        <td class="text-center">{{ $usuario->codigo_postal }}</td>
                        <td class="text-right">{{ $usuario->telefono_fijo }}</td>
                        <td class="text-right">{{ $usuario->telefono_celular }}</td>
                        <td class="text-right">{{ $usuario->telefono_alt }}</td>
                        <td class="text-left">{{ $usuario->email }}</td>
                        <td class="text-center">
                            <label class="switch">
                                <input type="checkbox" id="{{ $usuario->id }}" @if($usuario->estado) checked @endif>
                                <div class="slider round"></div>
                            </label>
                        </td>
                        <td class="text-center">{{ _dateTime($usuario->creado) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
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
