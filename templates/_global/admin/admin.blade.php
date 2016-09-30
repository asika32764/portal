{{-- Part of Admin project. --}}

@extends('_global.admin.admin-wrapper')

@section('content')
<!-- Main section-->
<section>
    <!-- Page content-->
    <div class="content-wrapper">
        @section('banner')
            @include('_global.admin.widget.banner')
        @show

        @section('admin-area')
        <section id="admin-area" class="row">
            <div class="col-xs-12">
                @section('admin-bg')
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @messages

                            @yield('admin-body', 'Admin Body')
                        </div>
                    </div>
                @show
            </div>
        </section>
        @show
    </div>
</section>
@stop
