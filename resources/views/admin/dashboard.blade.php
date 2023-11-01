@extends("admin.layout.master")

@section("title","Dashboard")

@section("css")
    <link rel="stylesheet"	href="{{  config('constants.framework_css') }}widget.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.framework_js') }}counter.js"></script>
@endsection

<style>
.counter {
  transition: all 1.5s ease-in-out; /* Ajusta la duración y la función de temporización según tus preferencias */
}
</style>

@section("body")
    <div class="main-container">

        <h1>Dashboard</h1>

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
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{session("success")}}
            </div>
        @endif

        @if (session("error"))
            <div class="alert danger">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                {{session("error")}}
            </div>
        @endif

        <div class="widget-grid">
            @foreach ($widgets as $widget)
                <div class="dashboard-widget" data-type="{{ $widget['color'] }}">
                    <div class="widget-content">
                        <div class="widget-title">{{ $widget['title'] }}</div>
                        <div class="widget-value">
                            <span class="counter" data-from="0" data-to="{{ $widget['value'] }}">
                                {{ $widget['value'] }}
                            </span>
                        </div>
                        <div class="widget-link">
                            <a href="{{ $widget['link']['url'] }}">{{ $widget['link']['title'] }}</a>
                        </div>
                        <div class="widget-icon">{!! $widget['icon'] !!}</div>
                        <div class="widget-note">{{ $widget['extra'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection