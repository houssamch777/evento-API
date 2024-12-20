<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('index') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-dark-sm.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="28">
            </span>
        </a>

        <a href="{{ route('index') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-light-sm.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="30">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="bx bx-menu align-middle"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!-- Sidebar Menu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bx bxs-dashboard icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin-users.index') }}">
                        <i class="bx bxs-user icon nav-icon"></i>
                        <span class="menu-item" data-key="t-profile">Users</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin-events.index') }}">
                        <i class="bx bx-health icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Events</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.api') }}">
                        <i class="bx bx-code-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Api documentations</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar End -->
    </div>
</div>

<!-- Left Sidebar End -->
