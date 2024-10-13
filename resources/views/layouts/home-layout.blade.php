<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>ُHome | Evento</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
        
        <!-- plugin css -->
        <link href="{{asset('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />

        <!-- preloader css -->
        <link rel="stylesheet" href="{{asset('css/preloader.css')}}" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="{{asset('css/bootstrap.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('css/app.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        @yield('styles')
    </head>

    <body data-layout="horizontal">

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

                        <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->

                    </div>

                    <div class="d-flex">



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
                            <button type="button" class="btn header-item noti-icon position-relative" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="bell" class="icon-lg"></i>
                                <span class="badge bg-danger rounded-pill">5</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small text-reset text-decoration-underline"> Unread (3)</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="{{asset('images/users/avatar-3.jpg')}}"
                                                class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hour ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-sm me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="bx bx-cart"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your order is placed</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-sm me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Your item is shipped</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="#!" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="{{asset('images/users/avatar-6.jpg')}}"
                                                class="me-3 rounded-circle avatar-sm" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Salena Layfield</h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hours ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span> 
                                    </a>
                                </div>
                            </div>
                        </div>



                        <div class="dropdown d-inline-block">
                            @if(Auth::check())
                            <!-- If user is logged in -->
                            <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @if(Auth::user()->profile_picture && Storage::disk('public')->exists(Auth::user()->profile_picture))
                                <img class="rounded-circle header-profile-user" src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="Header Avatar">
                                @else
                                <img class="rounded-circle header-profile-user" src="{{asset('images/users/avatar-1.jpg')}}" alt="Header Avatar">
                                @endif
                                <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::user()->first_name }}</span>
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
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout
                                    </button>
                                </form>
                            </div>
                            @else
                            <!-- If user is not logged in -->
                            <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium">Login / Register</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="mdi mdi-login font-size-16 align-middle me-1"></i> Login
                                </a>
                                <a class="dropdown-item" href="{{ route('register') }}">
                                    <i class="mdi mdi-account-plus font-size-16 align-middle me-1"></i> Create Account
                                </a>
                            </div>
                            @endif
                        </div>
                        
            
                    </div>
                </div>
            </header>
    
            <div class="topnav">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="index.html" id="topnav-dashboard" role="button">
                                        <i data-feather="home"></i><span data-key="t-dashboards">Dashboard</span>
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button">
                                        <i data-feather="briefcase"></i>
                                        <span data-key="t-elements">Elements</span> 
                                        <div class="arrow-down"></div>
                                    </a>

                                    <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                                        <div class="ps-2 p-lg-0">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div>
                                                        <div class="menu-title">Elements</div>
                                                        <div class="row g-0">
                                                            <div class="col-lg-5">
                                                                <div>
                                                                    <a href="ui-alerts.html" class="dropdown-item" data-key="t-alerts">Alerts</a>
                                                                    <a href="ui-buttons.html" class="dropdown-item" data-key="t-buttons">Buttons</a>
                                                                    <a href="ui-cards.html" class="dropdown-item" data-key="t-cards">Cards</a>
                                                                    <a href="ui-carousel.html" class="dropdown-item" data-key="t-carousel">Carousel</a>
                                                                    <a href="ui-dropdowns.html" class="dropdown-item" data-key="t-dropdowns">Dropdowns</a>
                                                                    <a href="ui-grid.html" class="dropdown-item" data-key="t-grid">Grid</a>
                                                                    <a href="ui-images.html" class="dropdown-item" data-key="t-images">Images</a>
                                                                    <a href="ui-modals.html" class="dropdown-item" data-key="t-modals">Modals</a>
                                                                    <a href="ui-offcanvas.html" class="dropdown-item" data-key="t-offcanvas">Offcanvas</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                <div>
                                                                    <a href="ui-progressbars.html" class="dropdown-item" data-key="t-progress-bars">Progress Bars</a>
                                                                    <a href="ui-placeholders.html" class="dropdown-item" data-key="t-progress-bars">Placeholders</a>
                                                                    <a href="ui-tabs-accordions.html" class="dropdown-item" data-key="t-tabs-accordions">Tabs & Accordions</a>
                                                                    <a href="ui-typography.html" class="dropdown-item" data-key="t-typography">Typography</a>
                                                                    <a href="ui-toasts.html" class="dropdown-item" data-key="t-toasts">Toasts</a>
                                                                    <a href="ui-video.html" class="dropdown-item" data-key="t-video">Video</a>
                                                                    <a href="ui-general.html" class="dropdown-item" data-key="t-general">General</a>
                                                                    <a href="ui-colors.html" class="dropdown-item" data-key="t-colors">Colors</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div class="col-lg-4">
                                                    <div>
                                                        <div class="menu-title">Extended</div>
                                                        <div>
                                                            <a href="extended-lightbox.html" class="dropdown-item" data-key="t-lightbox">Lightbox</a>
                                                            <a href="extended-rangeslider.html" class="dropdown-item" data-key="t-range-slider">Range Slider</a>
                                                            <a href="extended-sweet-alert.html" class="dropdown-item" data-key="t-sweet-alert">SweetAlert 2</a>
                                                            <a href="extended-session-timeout.html" class="dropdown-item" data-key="t-session-timeout">Session Timeout</a>
                                                            <a href="extended-rating.html" class="dropdown-item" data-key="t-rating">Rating</a>
                                                            <a href="extended-notifications.html" class="dropdown-item" data-key="t-notifications">Notifications</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                        <i data-feather="grid"></i><span data-key="t-apps">Apps</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                        <a href="apps-calendar.html" class="dropdown-item" data-key="t-calendar">Calendar</a>
                                        <a href="apps-chat.html" class="dropdown-item" data-key="t-chat">Chat</a>
                            
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                                role="button">
                                                <span data-key="t-email">Email</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-email">
                                                <a href="apps-email-inbox.html" class="dropdown-item" data-key="t-inbox">Inbox</a>
                                                <a href="apps-email-read.html" class="dropdown-item" data-key="t-read-email">Read Email</a>
                                            </div>
                                        </div>
                            
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoice"
                                                role="button">
                                                <span data-key="t-invoices">Invoices</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-invoice">
                                                <a href="apps-invoices-list.html" class="dropdown-item" data-key="t-invoice-list">Invoice List</a>
                                                <a href="apps-invoices-detail.html" class="dropdown-item" data-key="t-invoice-detail">Invoice Detail</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-contact"
                                                role="button">
                                                <span data-key="t-contacts">Contacts</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                                <a href="apps-contacts-grid.html" class="dropdown-item" data-key="t-user-grid">User Grid</a>
                                                <a href="apps-contacts-list.html" class="dropdown-item" data-key="t-user-list">User List</a>
                                                <a href="apps-contacts-profile.html" class="dropdown-item" data-key="t-profile">Profile</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle d-flex justify-content-between align-items-center" href="#" id="topnav-contact"
                                                role="button">
                                                <span data-key="t-contacts" class="">Blog</span> 
                                                <span class="badge bg-danger-subtle text-danger">New</span>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                                <a href="apps-blog-grid.html" class="dropdown-item" data-key="t-blog-grid">Blog Grid</a>
                                                <a href="apps-blog-list.html" class="dropdown-item" data-key="t-blog-list">Blog List</a>
                                                <a href="apps-blog-detail.html" class="dropdown-item" data-key="t-blog-details">Blog Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button">
                                        <i data-feather="box"></i><span data-key="t-components">Components</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-components">
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                                role="button">
                                                <span data-key="t-forms">Forms</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-form">
                                                <a href="form-elements.html" class="dropdown-item" data-key="t-form-elements">Basic Elements</a>
                                                <a href="form-validation.html" class="dropdown-item" data-key="t-form-validation">Validation</a>
                                                <a href="form-advanced.html" class="dropdown-item" data-key="t-form-advanced">Advanced Plugins</a>
                                                <a href="form-editors.html" class="dropdown-item" data-key="t-form-editors">Editors</a>
                                                <a href="form-uploads.html" class="dropdown-item" data-key="t-form-upload">File Upload</a>
                                                <a href="form-wizard.html" class="dropdown-item" data-key="t-form-wizard">Wizard</a>
                                                <a href="form-mask.html" class="dropdown-item" data-key="t-form-mask">Mask</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                                role="button">
                                                <span data-key="t-tables">Tables</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-table">
                                                <a href="tables-basic.html" class="dropdown-item" data-key="t-basic-tables">Bootstrap Basic</a>
                                                <a href="tables-datatable.html" class="dropdown-item" data-key="t-data-tables">Data Tables</a>
                                                <a href="tables-responsive.html" class="dropdown-item" data-key="t-responsive-table">Responsive</a>
                                                <a href="tables-editable.html" class="dropdown-item" data-key="t-editable-table">Editable</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                                role="button">
                                                <span data-key="t-charts">Charts</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                                <a href="charts-apex.html" class="dropdown-item" data-key="t-apex-charts">Apex charts</a>
                                                <a href="charts-echart.html" class="dropdown-item" data-key="t-e-charts">E charts</a>
                                                <a href="charts-chartjs.html" class="dropdown-item" data-key="t-chartjs-charts">Chartjs</a>
                                                <a href="charts-knob.html" class="dropdown-item" data-key="t-knob-charts">Jquery Knob</a>
                                                <a href="charts-sparkline.html" class="dropdown-item" data-key="t-sparkline-charts">Sparkline</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                                role="button">
                                                <span data-key="t-icons">Icons</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                                <a href="icons-boxicons.html" class="dropdown-item" data-key="t-boxicons">Boxicons</a>
                                                <a href="icons-materialdesign.html" class="dropdown-item" data-key="t-material-design">Material Design</a>
                                                <a href="icons-dripicons.html" class="dropdown-item" data-key="t-dripicons">Dripicons</a>
                                                <a href="icons-fontawesome.html" class="dropdown-item" data-key="t-font-awesome">Font Awesome 5</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map" role="button">
                                                <span data-key="t-maps">Maps</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-map">
                                                <a href="maps-google.html" class="dropdown-item" data-key="t-g-maps">Google</a>
                                                <a href="maps-vector.html" class="dropdown-item" data-key="t-v-maps">Vector</a>
                                                <a href="maps-leaflet.html" class="dropdown-item" data-key="t-l-maps">Leaflet</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                                        <i data-feather="file-text"></i><span data-key="t-extra-pages">Extra Pages</span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-more">

                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button">
                                                <span data-key="t-authentication">Authentication</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                                <a href="auth-login.html" class="dropdown-item" data-key="t-login">Login</a>
                                                <a href="auth-register.html" class="dropdown-item" data-key="t-register">Register</a>
                                                <a href="auth-recoverpw.html" class="dropdown-item" data-key="t-recover-password">Recover Password</a>
                                                <a href="auth-lock-screen.html" class="dropdown-item" data-key="t-lock-screen">Lock Screen</a>
                                                <a href="auth-logout.html" class="dropdown-item" data-key="t-logout">Log Out</a>
                                                <a href="auth-confirm-mail.html" class="dropdown-item" data-key="t-confirm-mail">Confirm Mail</a>
                                                <a href="auth-email-verification.html" class="dropdown-item" data-key="t-email-verification">Email verification</a>
                                                <a href="auth-two-step-verification.html" class="dropdown-item" data-key="t-two-step-verification">Two step verification</a>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility" role="button">
                                                <span data-key="t-utility">Utility</span> <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                                <a href="pages-starter.html" class="dropdown-item" data-key="t-starter-page">Starter Page</a>
                                                <a href="pages-maintenance.html" class="dropdown-item" data-key="t-maintenance">Maintenance</a>
                                                <a href="pages-comingsoon.html" class="dropdown-item" data-key="t-coming-soon">Coming Soon</a>
                                                <a href="pages-timeline.html" class="dropdown-item" data-key="t-timeline">Timeline</a>
                                                <a href="pages-faqs.html" class="dropdown-item" data-key="t-faqs">FAQs</a>
                                                <a href="pages-pricing.html" class="dropdown-item" data-key="t-pricing">Pricing</a>
                                                <a href="pages-404.html" class="dropdown-item" data-key="t-error-404">Error 404</a>
                                                <a href="pages-500.html" class="dropdown-item" data-key="t-error-500">Error 500</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="layouts-horizontal.html" role="button">
                                        <i data-feather="layout"></i><span data-key="t-horizontal">Horizontal</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        @yield('page-content')
                        


                    </div> <!-- container-fluid -->
                </div>
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

        <!-- apexcharts -->
        <script src="{{asset('libs/apexcharts/apexcharts.min.js')}}"></script>

        <!-- Plugins js-->
        <script src="{{asset('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- dashboard init -->
        <script src="{{asset('js/pages/dashboard.init.js')}}"></script>

        <script src="{{asset('js/app.js')}}"></script>
        @yield('scripts')
    </body>
</html>
