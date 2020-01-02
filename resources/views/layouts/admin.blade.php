<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'Admin') }}</title>
    <!-- Fonts -->
    <!-- Styles -->
    @include('layouts.partials.admin._styles')
    @yield('styles')
</head>

<body class="sidebar-mini sidebar-open" style="height: auto;">
  <div class="wrapper">

      @include('layouts.partials.admin._nav')
      @include('layouts.partials.admin._aside')
    
      <div class="content-wrapper" style="min-height: 917px;">
        <!-- Main content -->
        <section class="content" style="padding-top: 20px">
          @yield('content')
        </section>
        <!-- /.content -->
      </div>
  
      @include('layouts.partials.admin._footer')
      {{-- @include('layouts.partials.admin._logoutform') --}}
  </div>
   
  <!-- Scripts -->
  @include('layouts.partials.admin._scripts')
  @stack('scripts')

</body>
</html>