@include('layouts.header')
@include('layouts.sidebar')
@include('layouts.navbar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('page')</h1>
                </div>
                <div class="col-sm-6">
                    {{-- <ol class="breadcrumb float-sm-right">
                        <!-- RTL left -->
                        @foreach (Request::segments() as $segment)
                            <li class="breadcrumb-item"><a href="{{ $segment }}">{{ ucwords($segment) }}</a></li>
                        @endforeach
                    </ol> --}}
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            {{-- <x-view.alerts /> --}}
            @yield('content')
        </div>
    </section>

    @include('layouts.footer')
