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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">

</head>
<body>
    <div id="root">
        <app-header
        :logged-in='false'
        login-route="{{ route('login') }}"
        register-route="{{ route('register') }}"
        >
        </app-header>

        <main class="py-4">
            @yield('content')
        </main>

        <app-footer></app-footer>
    </div>
    @stack('script')
    {{-- Vue  --}}
    <script src="{{ asset('js/front.js') }}"></script>
</body>
</html>
