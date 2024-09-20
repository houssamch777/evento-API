<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Starter Page | Evento - Minimal Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">

        <!-- preloader css -->
        <link rel="stylesheet" href="{{asset('css/preloader.min.css')}}" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{asset('css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        @yield('styles')
    </head>

    <body >

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('images/logo-sm.svg')}}" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('images/logo-sm.svg')}}" alt="" height="24"> <span class="logo-txt">Evento</span>
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('images/logo-sm.svg')}}" alt="" height="24">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('images/logo-sm.svg')}}" alt="" height="24"> <span class="logo-txt">Evento</span>
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <button class="btn btn-primary" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="search" class="icon-lg"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
        
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Search Result">

                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="header-lang-img" src="{{asset('images/flags/us.jpg')}}" alt="Header Language" height="16">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="en">
                                    <img src="{{asset('images/flags/us.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                                </a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ar">
                                    <img src="{{asset('images/flags/Saudi_Arabia.svg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Arabic</span>
                                </a>

                            </div>
                        </div>

                        <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                            </button>
                        </div>


                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Auth::user()->profile_picture && Storage::disk('public')->exists(Auth::user()->profile_picture))
                                <img class="rounded-circle header-profile-user" src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="Header Avatar">
                                @else
                                <img class="rounded-circle header-profile-user" src="{{asset('images/users/avatar-1.jpg')}}" alt="Header Avatar">
                                @endif
                                <span class="d-none d-xl-inline-block ms-1 fw-medium">{{Auth::user()->first_name}}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                @if(Route::currentRouteName() !== 'profile')
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="mdi mdi-face-man font-size-16 align-middle me-1"></i> Profile
                                </a>
                                 @endif                                
                                <div class="dropdown-divider"></div>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="mdi mdi-logout font-size-16 align-middle me-1">
                                        </i> Logout
                                    </button>
                                </form>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">
                    @yield('Sidebar')
                    
                </div>
            </div>
            <!-- Left Sidebar End -->

            

                        <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                @yield('page-content')
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Evento.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by <a href="https://witslinks.com/" class="text-decoration-underline">WitsLinksCrew</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
        
        
                <!-- Right Sidebar -->
                <div class="right-bar">
                    <div data-simplebar class="h-100">
                        <div class="rightbar-title d-flex align-items-center p-3">
        
                            <h5 class="m-0 me-2">Theme Customizer</h5>
        
                            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                                <i class="mdi mdi-close noti-icon"></i>
                            </a>
                        </div>
        
                        <!-- Settings -->
                        <hr class="m-0" />
        
                        <div class="p-4">
                            <h6 class="mb-3">Layout</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="layout"
                                    id="layout-vertical" value="vertical">
                                <label class="form-check-label" for="layout-vertical">Vertical</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="layout"
                                    id="layout-horizontal" value="horizontal">
                                <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                            </div>
        
                            <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>
        
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="layout-mode"
                                    id="layout-mode-light" value="light">
                                <label class="form-check-label" for="layout-mode-light">Light</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="layout-mode"
                                    id="layout-mode-dark" value="dark">
                                <label class="form-check-label" for="layout-mode-dark">Dark</label>
                            </div>
        
                            <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>
        
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="layout-width"
                                    id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                                <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="layout-width"
                                    id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                                <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                            </div>
        
                            <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>
        
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="layout-position"
                                    id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                                <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="layout-position"
                                    id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                                <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                            </div>
        
                            <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>
        
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="topbar-color"
                                    id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                                <label class="form-check-label" for="topbar-color-light">Light</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="topbar-color"
                                    id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                                <label class="form-check-label" for="topbar-color-dark">Dark</label>
                            </div>
        
                            <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>
        
                            <div class="form-check sidebar-setting">
                                <input class="form-check-input" type="radio" name="sidebar-size"
                                    id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                                <label class="form-check-label" for="sidebar-size-default">Default</label>
                            </div>
                            <div class="form-check sidebar-setting">
                                <input class="form-check-input" type="radio" name="sidebar-size"
                                    id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                                <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                            </div>
                            <div class="form-check sidebar-setting">
                                <input class="form-check-input" type="radio" name="sidebar-size"
                                    id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                                <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                            </div>
        
                            <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>
        
                            <div class="form-check sidebar-setting">
                                <input class="form-check-input" type="radio" name="sidebar-color"
                                    id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                                <label class="form-check-label" for="sidebar-color-light">Light</label>
                            </div>
                            <div class="form-check sidebar-setting">
                                <input class="form-check-input" type="radio" name="sidebar-color"
                                    id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                                <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                            </div>
                            <div class="form-check sidebar-setting">
                                <input class="form-check-input" type="radio" name="sidebar-color"
                                    id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                                <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                            </div>
        
                            <h6 class="mt-4 mb-3 pt-2">Direction</h6>
        
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="layout-direction"
                                    id="layout-direction-ltr" value="ltr">
                                <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="layout-direction"
                                    id="layout-direction-rtl" value="rtl">
                                <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                            </div>
        
                        </div>
        
                    </div> <!-- end slimscroll-menu-->
                </div>
                <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{asset('libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('libs/feather-icons/feather.min.js')}}"></script>
        <!-- pace js -->
        <script src="{{asset('libs/pace-js/pace.min.js')}}"></script>

        <script src="{{asset('js/app.js')}}"></script>
        @yield('scripts')
    </body>
</html>
