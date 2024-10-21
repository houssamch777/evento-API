<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{route('index')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-dark-sm.png') }}" alt="" height="26">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="28">
            </span>
        </a>

        <a href="{{route('index')}}" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="30">
            </span>
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-light-sm.png') }}" alt="" height="26">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
        <i class="bx bx-menu align-middle"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>
                <li>
                    <a href="{{route('dashboard')}}">
                        <i class="bx bxs-dashboard icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('profile')}}">
                        <i class="bx bxs-user icon nav-icon"></i>
                        <span class="menu-item" data-key="t-profile">Profile</span>
                    </a>
                </li>
                <li class="menu-title" data-key="t-skills-assets">Skills & Assets</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-wrench icon nav-icon"></i>
                        <span class="menu-item" data-key="t-multi-level">Skills & Assets</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        
                        <li><a href="javascript: void(0);" data-key="t-level-1.1">Assets</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow" data-key="t-level-1.2">Skills</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('skills.index')}}" data-key="t-level-2.1">My Skills</a></li>
                                <li><a href="{{route('skills.create')}}" data-key="t-level-2.2">New Skill</a></li>
                                <li class="disabled"><a href="#" data-key="t-disabled-item">Edit Skill</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->