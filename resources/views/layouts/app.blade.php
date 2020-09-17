<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,400;0,700;1,200;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <div id="app" class="wrapper">
        @include('layouts.partials._app_sidebar')

        <div class="main-panel" id="main-panel">
            @include('layouts.partials._app_navbar')

            <x-panel-header></x-panel-header>

            <main class="content">
                @yield('content')
            </main>

            @include('layouts.partials._app_footer')
        </div>
    </div>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5f39d1764c7806354da6d63b/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();

    </script>
    <!--End of Tawk.to Script-->

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

    @stack('scripts')
</body>

</html>
