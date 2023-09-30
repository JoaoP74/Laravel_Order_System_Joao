<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
</head>

<body>
    @include('includes.header')
    <div>
        @if (Session::has('danger'))
            <p class="alert alert-danger" style="text-align: center;">
                {{ Session::get('danger') }}
            </p>
        @endif
    </div>
    <div class="main-content-wrapper">
        @if (auth()->user())
            @include('includes.sidebar')
        @endif
        @yield('content')
    </div>

    <div class="overlay"></div>
    @include('includes.footer')
</body>

</html>
