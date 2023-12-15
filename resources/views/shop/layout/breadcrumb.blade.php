@if(isset($breadcrumbs))
    <div class="breadcrumb">
        <a href="/shop"><i class="fa-solid fa-house-chimney fa-sm"></i> Home</a>

        @foreach($breadcrumbs as $breadcrumb)
            <i class="fa-solid fa-chevron-right fa-sm"></i> <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['title'] }}</a>
        @endforeach

        <i class="fa-solid fa-chevron-right fa-sm"></i> {{ $title }}
    </div>
@endif

<h1>{{ $title }}</h1>
