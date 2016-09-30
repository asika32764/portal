<?php
/**
 * @var $helper \Main\Helper\MenuHelper
 * @var $router \Windwalker\Core\Router\PackageRouter
 */
?>
<!-- sidebar-->
<aside class="aside">
    <!-- START Sidebar (left)-->
    <div class="aside-inner">
        <nav data-sidebar-anyclick-close="" class="sidebar">

            <!-- START sidebar nav-->
            <ul class="nav">

                <li class="has-user-block">
                    <div id="user-block" class="collapse in" aria-expanded="true">
                        <div class="item user-block">
                            <!-- User picture-->
                            <div class="user-block-picture">
                                <div class="user-block-status">
                                    <img src="{{ $user->avatar }}" alt="Avatar" width="60" height="60" class="img-thumbnail img-circle hoverZoomLink">
                                    <div class="circle circle-success circle-lg"></div>
                                </div>
                            </div>
                            <!-- Name and Job-->
                            <div class="user-block-info">
                                <span class="user-block-name">{{ $user->name }}</span>
                                <span class="user-block-role">工程師</span>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-heading">
                    <span>功能選單</span>
                </li>

                <li class="{{ $helper->menu->active('dashboard') }}">
                    <a href="{{ $router->route('home') }}">
                        <span class="fa fa-fw fa-dashboard"></span>
                        <span>首頁</span>
                    </a>
                </li>

                <li class="{{ $helper->menu->active('pipelines') }}">
                    <a href="{{ $router->route('pipelines') }}">
                        <span class="fa fa-fw fa-list"></span>
                        <span>Pipeline</span>
                    </a>
                </li>

                @if (WINDWALKER_DEBUG)
                <li class="{{ $helper->menu->active('categories', ['type' => 'article']) }}">
                    <a href="{{ $router->route('categories', ['type' => 'article']) }}">
                        @translate($luna->langPrefix . 'categories.title')
                    </a>
                </li>

                <li class="{{ $helper->menu->active('articles') }}">
                    <a href="{{ $router->route('articles') }}">
                        @translate($luna->langPrefix . 'articles.title')
                    </a>
                </li>

                <li class="{{ $helper->menu->active('tags') }}">
                    <a href="{{ $router->route('tags') }}">
                        @translate($luna->langPrefix . 'tags.title')
                    </a>
                </li>

                <li class="{{ $helper->menu->active('comments') }}">
                    <a href="{{ $router->route('comments', array('type' => 'article')) }}">
                        @translate($luna->langPrefix . 'comments.title')
                    </a>
                </li>

                <li class="{{ $helper->menu->active('languages') }}">
                    <a href="{{ $router->route('languages') }}">
                        @translate($luna->langPrefix . 'languages.title')
                    </a>
                </li>

                <li class="{{ $helper->menu->active('modules') }}">
                    <a href="{{ $router->route('modules') }}">
                        @translate($luna->langPrefix . 'modules.title')
                    </a>
                </li>

                <li class="{{ $helper->menu->active('users') }}">
                    <a href="{{ $router->route('users') }}">
                        @translate($warder->langPrefix . 'users.title')
                    </a>
                </li>
                @endif

                {{--<li class=" ">--}}
                {{--<a href="#menuid" title="Menu" data-toggle="collapse">--}}
                {{--<em class="icon-folder"></em>--}}
                {{--<span data-localize="sidebar.nav.menu.MENU">Menu</span>--}}
                {{--</a>--}}
                {{--<ul id="menuid" class="nav sidebar-subnav collapse">--}}
                {{--<li class="sidebar-subnav-header">Menu</li>--}}
                {{--<li class=" ">--}}
                {{--<a href="submenu.html" title="Sub Menu">--}}
                {{--<span data-localize="sidebar.nav.menu.SUBMENU">Sub Menu</span>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
            </ul>
            <!-- END sidebar nav-->
        </nav>
    </div>
    <!-- END Sidebar (left)-->
</aside>
<!-- offsidebar-->
<aside class="offsidebar hide">
    <!-- START Off Sidebar (right)-->
    <nav>
        <div role="tabpanel">
            <!-- Nav tabs-->
            <ul role="tablist" class="nav nav-tabs nav-justified">
                <li role="presentation" class="active">
                    <a href="#app-settings" aria-controls="app-settings" role="tab" data-toggle="tab">
                        <em class="icon-equalizer fa-lg"></em>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#app-chat" aria-controls="app-chat" role="tab" data-toggle="tab">
                        <em class="icon-user fa-lg"></em>
                    </a>
                </li>
            </ul>
            <!-- Tab panes-->
            <div class="tab-content">
                <div id="app-settings" role="tabpanel" class="tab-pane fade in active">
                    <h3 class="text-center text-thin">Tab 1</h3>
                </div>
                <div id="app-chat" role="tabpanel" class="tab-pane fade">
                    <h3 class="text-center text-thin">Tab 2</h3>
                </div>
            </div>
        </div>
    </nav>
    <!-- END Off Sidebar (right)-->
</aside>

