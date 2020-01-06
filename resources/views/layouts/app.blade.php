<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <!-- Styles -->
    <script>
        var user = {!! auth()->user() !!};
    </script>
    @include('layouts.partials._styles')
</head>
<body>
    <div id="app">
        @include('layouts.partials._nav')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @include('layouts.partials._footer')
    <!-- Scripts -->
    @include('layouts.partials._scripts')
</body>
</html>
