@extends('layouts.app')
   @section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('layouts.partials._aside')
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                @yield('page')
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    @endsection
