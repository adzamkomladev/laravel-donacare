<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" class="wrapper">
        @include('layouts.partials._app_sidebar')

        <div class="main-panel" id="main-panel">
            @include('layouts.partials._app_navbar')

            <div class="panel-header panel-header-sm"></div>

            <main class="content">
                @yield('content')
            </main>

            @include('layouts.partials._app_footer')
        </div>
    </div>

    @auth
        <script>
            window.authState = @json(['user' => Auth::user()])

        </script>
    @endauth
    @guest
        <script>
            window.authState = @json(['user' => []])

        </script>
    @endguest
</body>

</html>
