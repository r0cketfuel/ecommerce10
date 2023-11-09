@extends("admin.layout.master")

@section("title","Ordenes")

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

        <h1>Listado de ordenes</h1>

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="/admin">Home</a> > Listado de ordenes
        </div>

        <table>
            <thead>
                <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordenes as $orden)
                    <tr>
                        <td class="text-center">{{ $orden->id }}</td>
                        <td class="text-center">{{ $orden->estado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection
