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
    @include('layouts.partials._styles')
</head>
<body>
    @include('layouts.partials._nav')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('layouts.partials._aside')
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                @yield('content')
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->

    @include('layouts.partials._footer')
    <!-- Scripts -->
    @include('layouts.partials._scripts')
</body>
</html>
