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
    @stack('styles')
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
