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
            @can('read '.$menu->url)
            @if($menu->sort !== 0)
            @can('admin')
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
            @else
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
            @endif
            @endcan
            @endforeach

            <!-- @can('read imports')
            <li class="{{ request()->segment(1) == 'imports' ? 'active open' : '' }}">
                <a href="" class="main-menu has-dropdown">
                    <i class="ti-desktop"></i>
                    <span>Import Data</span>
                </a>
                <ul class="sub-menu {{ request()->segment(1) == 'imports' ? 'expand' : '' }}">
                    @can('read imports/datapc')
                    <li class="{{ request()->segment(1) == 'imports' && request()->segment(2) == 'datapc' ? 'active' : '' }}">
                        <a href="{{ route('datapc.index') }}" class="link"><span>Import PC Data</span></a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan -->

        </ul>
    </div>
</nav>