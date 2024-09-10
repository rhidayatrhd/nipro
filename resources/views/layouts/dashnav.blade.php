<nav class="main-sidebar ps-menu">
    <div class="sidebar-toggle action-toggle">
        <a href="#">
            <i class="fas fa-bars"></i>
        </a>
    </div>
    <div class="sidebar-opener action-toggle">
        <a href="#">
            <i class="ti-angle-right"></i>
        </a>
    </div>
    <div class="sidebar-header">
        <div class="text1">NIJ</div>
        <div class="text2">NIPRO INDONESIA</div>
        <div class="close-sidebar action-toggle">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>
            <li class="{{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="link">
                    <i class="ti-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            @foreach(getMenus() as $menu)
            @if($menu->sort === 1)
            @can('admin')
            <li class="{{ request()->segment(1) == $menu->url ? 'active open' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="{{ $menu->icon }}"></i>
                    <span>{{ $menu->name }}</span>
                </a>
                <ul class="sub-menu {{ request()->segment(1) == $menu->url ? 'expand' : '' }}">
                    @foreach($menu->subMenus as $submenu)
                    <li class="{{ request()->segment(1) == explode('/', $submenu->url)[0] && request()->segment(2) == explode('/', $submenu->url)[1] ? 'active' : '' }}">
                        <a href="{{ url($submenu->url) }}" class="link"><span>{{ $submenu->name }}</span></a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endcan
            @elseif($menu->sort === 0)
            @can('read '.$menu->url)
            <li class="{{ request()->segment(1) == $menu->url ? 'active open' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="{{ $menu->icon }}"></i>
                    <span>{{ $menu->name }}</span>
                </a>
                <ul class="sub-menu {{ request()->segment(1) == $menu->url ? 'expand' : '' }}">
                    @foreach($menu->subMenus as $submenu)
                    @can('read '.$submenu->url)
                    <li class="{{ request()->segment(1) == explode('/', $submenu->url)[0] && request()->segment(2) == explode('/', $submenu->url)[1] ? 'active' : '' }}">
                        <a href="{{ url($submenu->url) }}" class="link"><span>{{ $submenu->name }}</span></a>
                    </li>
                    @endcan
                    @endforeach
                </ul>
            </li>
            @endcan
            @elseif($menu->sort === 2)
            <li class="{{ request()->segment(1) == $menu->url ? 'active open' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="{{ $menu->icon }}"></i>
                    <span>{{ $menu->name }}</span>
                </a>
                <ul class="sub-menu {{ request()->segment(1) == $menu->url ? 'expand' : '' }}">
                    @foreach($menu->subMenus as $submenu)
                    <li class="{{ request()->segment(1) == explode('/', $submenu->url)[0] && request()->segment(2) == explode('/', $submenu->url)[1] ? 'active' : '' }}">
                        <a href="{{ url($submenu->url) }}" class="link"><span>{{ $submenu->name }}</span></a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endif

            @endforeach
            <!-- <li class="{{ request()->segment(1) ==  'userguides' ? 'active open' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="ti-bookmark-alt"></i><span>Training Document</span>
                </a>
                <ul class="sub-menu {{ request()->segment(1) == 'userguides' ? 'expand' : '' }}">
                    <li class="{{ request()->segment(1) == 'userguides' && request()->segment(2) == 'sap_userguide' ? 'active' : '' }}">
                        <a href="/userguides/sap_userguide" class="link">
                            <span>SAP Training Material</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->segment(1) ==  'requestforms' ? 'active open' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="ti-layout-tab"></i><span>Form Request</span>
                </a>
                <ul class="sub-menu {{ request()->segment(1) == 'requestforms' ? 'expand' : '' }}">
                    <li class="{{ request()->segment(1) == 'requestforms' && request()->segment(2) == 'it_requestform' ? 'active' : '' }}">
                        <a href="/requestforms/it_requestform" class="link">
                            <span>IT Form Request</span>
                        </a>
                    </li>
                </ul>
            </li> -->

        </ul>
    </div>
</nav>