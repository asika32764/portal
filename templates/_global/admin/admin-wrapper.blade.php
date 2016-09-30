{{-- Part of phoenix project. --}}

@extends('_global.admin.html')

@section('body')
    <div class="wrapper">
        @section('header')
            @include('_global.admin.header')
        @show

        @include('_global.admin.widget.submenu')

        @yield('content', 'Content Section')

        @section('copyright')
            @include('_global.admin.copyright')
        @show
    </div>
@stop
