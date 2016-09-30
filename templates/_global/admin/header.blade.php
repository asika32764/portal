{{-- Part of phoenix project. --}}
<?php
/**
 * @var  $router  \Windwalker\Core\Router\PackageRouter
 */
?>

@php(\Phoenix\Script\BootstrapScript::tooltip())

<!-- top navbar-->
<header class="topnavbar-wrapper">
    <!-- START Top Navbar-->
    <nav role="navigation" class="navbar topnavbar">
        <!-- START navbar header-->
        <div class="navbar-header">
            <a href="#/" class="navbar-brand">
                <div class="brand-logo">
                    {{--<img src="img/logo.png" alt="App Logo" class="img-responsive">--}}
                    <span style="color: white">Portal</span>
                </div>
                <div class="brand-logo-collapsed">
                    {{--<img src="img/logo-single.png" alt="App Logo" class="img-responsive">--}}
                    <span style="color: white">Portal</span>
                </div>
            </a>
        </div>
        <!-- END navbar header-->
        <!-- START Nav wrapper-->
        <div class="nav-wrapper">
            <!-- START Left navbar-->
            <ul class="nav navbar-nav">
                <li>
                    <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                    <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                        <em class="fa fa-navicon"></em>
                    </a>
                    <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                    <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                        <em class="fa fa-navicon"></em>
                    </a>
                </li>
            </ul>
            <!-- END Left navbar-->
            <!-- START Right Navbar-->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ $uri->path }}admin/school/form.html" class="hasTooltip" title="學校設定" data-placement="bottom">
                        <em class="fa fa-gear"></em>
                    </a>
                </li>
                <li>
                    <a href="#" class="hasTooltip" title="登出" data-placement="bottom">
                        <em class="fa fa-sign-out"></em>
                    </a>
                </li>

            {{--<!-- Search icon-->--}}
            {{--<li>--}}
            {{--<a href="#" data-search-open="">--}}
            {{--<em class="icon-magnifier"></em>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<!-- START Offsidebar button-->--}}
            {{--<li>--}}
            {{--<a href="#" data-toggle-state="offsidebar-open" data-no-persist="true">--}}
            {{--<em class="icon-notebook"></em>--}}
            {{--</a>--}}
            {{--</li>--}}
            <!-- END Offsidebar menu-->
            </ul>
            <!-- END Right Navbar-->
        </div>
        <!-- END Nav wrapper-->
        <!-- START Search form-->
    {{--<form role="search" action="search.html" class="navbar-form">--}}
    {{--<div class="form-group has-feedback">--}}
    {{--<input type="text" placeholder="Type and hit enter ..." class="form-control">--}}
    {{--<div data-search-dismiss="" class="fa fa-times form-control-feedback"></div>--}}
    {{--</div>--}}
    {{--<button type="submit" class="hidden btn btn-default">Submit</button>--}}
    {{--</form>--}}
    <!-- END Search form-->
    </nav>
    <!-- END Top Navbar-->
</header>

