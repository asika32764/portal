{{-- Part of phoenix project. --}}
<div class="content-heading">
    @section('toolbar')
        <div class="pull-right">

            @yield('toolbar-buttons')

        </div>
    @show

    {{--@section('back-button')--}}
    {{--<a href="javascript:window.history.back()">--}}
    {{--<span class="fa fa-chevron-left"></span>--}}
    {{--</a>--}}
    {{--@show--}}

    {{ \Phoenix\Html\HtmlHeader::getTitle() }}
    <small>Home / Page</small>
</div>