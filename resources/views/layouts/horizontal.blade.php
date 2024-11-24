<header class="ishorizontal-topbar">
    <div class="navbar-header">
        <div class="d-flex">
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
                    <span class="logo-sm">
                        <img src="{{ URL::asset('build/images/logo-light-sm.png') }}" alt="" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="30">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 d-lg-none header-item" data-bs-toggle="collapse"
                data-bs-target="#topnav-menu-content">
                <i class="bx bx-menu align-middle"></i>
            </button>

            <!-- start page title -->
            <div class="page-title-box align-self-center d-none d-md-block">
                <h4 class="page-title mb-0">@yield('page-title')</h4>
            </div>
            <!-- end page title -->

        </div>

        <div class="d-flex">
<!--
            <div class="dropdown d-inline-block language-switch ms-2 ms-xl-3">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img class="header-lang-img" src="{{ URL::asset('build/images/flags/us.jpg') }}"
                        alt="Header Language" height="18">
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="eng">
                        <img src="{{ URL::asset('build/images/flags/us.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">English</span>
                    </a>

                    
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="bx bx-search icon-sm align-middle"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                    <form class="p-2">
                        <div class="search-box">
                            <div class="position-relative">
                                <input type="text" class="form-control rounded bg-light border-0"
                                    placeholder="Search...">
                                <i class="bx bx-search search-icon"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
--><!-- item-->

            <button type="button" class="btn header-item" id="theme-toggle-btn">
                <i class="mdi mdi-theme-light-dark"></i> <!-- Toggle icon -->
            </button>

            @if(Auth::check())
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown-v"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell icon-sm align-middle"></i>
                    <span class="noti-dot bg-danger rounded-pill">{{ auth()->user()->unreadNotifications->count() }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown-v">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="m-0 font-size-15"> Notifications </h5>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('markAllAsRead') }}" class="small fw-semibold text-decoration-underline"> Mark all
                                    as
                                    read</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 250px;">
            
                        @forelse (Auth::user()->unreadNotifications as $notification)
                        <a href="#!" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    @if(isset($notification->data['image']))
                                    <img src="{{ URL::asset('storage/' . $notification->data['image']) }}"
                                        class="rounded-circle avatar-sm" alt="Notification Image">
                                    @else
                                    <span class="avatar-title bg-primary rounded-circle font-size-18">
                                        <i class="bx bx-bell"></i>
                                    </span>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <p class="text-muted font-size-13 mb-0 float-end">{{ $notification->created_at->diffForHumans()
                                        }}</p>
                                    <h6 class="mb-1">{{ $notification->data['title'] ?? 'Notification' }}</h6>
                                    <div>
                                        <p class="mb-0">{{ $notification->data['message'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        <p class="text-center p-3">No new notifications</p>
                        @endforelse
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                            <i class="uil-arrow-circle-right me-1"></i> <span>View More..</span>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    @if(Auth::check())
                        <img class="rounded-circle header-profile-user"
                            src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : URL::asset('build/images/users/avatar-3.jpg') }}" 
                            alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-2 fw-medium font-size-15">{{ Auth::user()->first_name }}</span>
                    @else
                        <i class="mdi mdi-account-circle text-muted font-size-16"></i>
                        <span class="d-none d-xl-inline-block ms-2 fw-medium font-size-15">Login / Sign Up</span>
                    @endif
                </button>
                
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    @if(Auth::check())
                        <div class="p-3 border-bottom">
                            <h6 class="mb-0">{{ Auth::user()->first_name }}</h6>
                            <p class="mb-0 font-size-11 text-muted">{{ Auth::user()->email }}</p>
                        </div>
                        <a class="dropdown-item" href="{{ route('profile') }}"><i
                                class="mdi mdi-account-circle text-muted font-size-16 align-middle me-2"></i> <span
                                class="align-middle">Profile</span></a>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard') }}"><i
                                    class="mdi mdi-view-dashboard text-muted font-size-16 align-middle me-2"></i> <span
                                    class="align-middle me-3">Dashboard</span><span
                                    class="badge bg-success-subtle text-success ms-auto">New</span></a>
                        <a class="dropdown-item" href="javascript:void(0);"><i
                                class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-2"></i> <span
                                class="align-middle">Messages</span></a>
                        <a class="dropdown-item" href="{{route('help')}}"><i
                                class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-2"></i> <span
                                class="align-middle">Help</span></a>
                                <form action="{{ route('manual.lock') }}" method="POST" id="lockForm">
                                    @csrf
                                    <button class="dropdown-item" type="submit" ><i
                                        class="mdi mdi-lock text-muted font-size-16 align-middle me-2"></i> <span
                                        class="align-middle">Lock screen</span></button>
                                </form>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0);"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="mdi mdi-logout text-muted font-size-16 align-middle me-2"></i> <span
                                class="align-middle">Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a class="dropdown-item" href="{{ route('login') }}"><i
                                class="mdi mdi-login text-muted font-size-16 align-middle me-2"></i> <span
                                class="align-middle">Login</span></a>
                        <a class="dropdown-item" href="{{ route('register') }}"><i
                                class="mdi mdi-account-plus text-muted font-size-16 align-middle me-2"></i> <span
                                class="align-middle">Create Account</span></a>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    <div class="topnav">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{route('index')}}" id="topnav-dashboard"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-home-alt icon nav-icon"></i>
                                <span data-key="t-dashboards">Home</span>
                            </a>
                        </li>
                        @if(Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more"
                                role="button">
                                <i class='bx bx-calendar nav-icon'></i>
                                <span data-key="t-pages">events</span>
                                <div class="arrow-down"></div>
                            </a>
                            
                            <div class="dropdown-menu" aria-labelledby="topnav-more">

                                <a href="#" class="dropdown-item"
                                    data-key="t-horizontal">Events feed</a>
                                <a href="#" class="dropdown-item"
                                    data-key="t-horizontal">Find Event</a>
                            </div>
                            
                        </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more"
                                    role="button">
                                    <i class='bx bx-calendar nav-icon'></i>
                                    <span data-key="t-pages">Find Event</span>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{route('market.index')}}" id="topnav-more"
                                role="button">
                                <i class='bx bx-store nav-icon'></i>
                                <span data-key="t-pages">Skills Market</span>
                            </a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more"
                                role="button">
                                <i class='bx bx-map nav-icon'></i>
                                <span data-key="t-pages">Evanto Map</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
