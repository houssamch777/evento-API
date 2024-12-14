@extends('layouts.master-without-nav')
@section('title', 'Home')
@section('page-title', 'Home')
@section('css')
<style>
    /* Full-Screen Hero Section */
    .hero-section {
        height: calc(100vh - 177px);
        /* Full viewport minus header height */
        /* Full screen height */
        display: flex;
        align-items: center;
        justify-content: center;
        /* Light background */
        position: relative;
    }

    .hero-text {
        max-width: 600px;
    }

    .scroll-indicator {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 1.5rem;

        cursor: pointer;
    }

    .scroll-indicator:hover {
        color: #f7931e;
    }

    .client-carousel {
        max-width: 800px;
        margin: 0 auto;
    }

    .client-logo {
        max-width: 100px;
        max-height: 100px;
        margin: auto;
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 50px;
        height: 50px;
        background-color: #0056b300;
        border: none;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background-color: #0056b300;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(1);
    }
</style>
<style>
    .boosted-events {
        border-top: 4px solid #4BB543;
    }

    .boosted-events .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }

    .boosted-events .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .boosted-events .section-title h2 {
        color: #4BB543;
        font-weight: bold;
    }
</style>
@endsection
@section('body')

<body data-layout="horizontal" data-layout-scrollable="false" data-layout-size="boxed">
    @endsection
    @section('content')
    <!-- Full-Screen Hero Section -->
    <!-- Full-Screen Hero Section -->
    <div class="container-fluid hero-section text-center text-md-start">
        <div class="row align-items-center w-100 mx-3">
            <!-- Text Section -->
            <div class="col-md-6">
                <div class="hero-text">
                    <h5 class="text-success">Algeria events in one place</h5>
                    <h1 class="display-4 fw-bold">Search, Book, and Enjoy</h1>
                    <p class="text-muted">Our platform provides an innovative event management service, allowing users
                        to
                        book and create events seamlessly. Explore upcoming cultural, recreational, and volunteer
                        events.</p>
                    <div class="d-flex gap-3 mt-4 justify-content-center justify-content-md-start">
                        <a href="#" class="btn btn-success btn-lg">Book Events</a>
                        <a href="#" class="btn btn-outline-success btn-lg">Add Your Event</a>
                    </div>
                </div>
            </div>
            <!-- Image Section -->
            <div class="col-md-6 text-center">
                <h1 class="fw-bold mb-4 text-success">Upcoming Events</h1>
                <!-- Event Cards Carousel -->
                <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($topEvents as $index => $event)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="card">
                                <img src="{{ asset('storage/' .$event->visualIdentity->banner_url) }}"
                                    class="card-img-top" alt="{{ $event->name }}">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">{{ $event->name }}</h5>
                                    <p class="text-muted mb-4">{{ \Carbon\Carbon::parse($event->start_date)->format('F
                                        d,
                                        Y') }} to {{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }}</p>
                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-link text-success">View More</a>
                                </div>
                                <form action="{{ route('calendar.add', $event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-success btn-rounded float-end position-absolute top-0 end-0 m-3"><i
                                            class="bx bx-calendar-plus fs-4"></i></button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="scroll-indicator" onclick="scrollToContent()">&#x2193;</div>
    </div>
    <!-- Search Section -->
    <div class="col-12 text-white py-5 text-center">
        <h1 class="mb-4">Live a little! Because when things get scheduled, things get done!</h1>
        <div class="d-flex flex-wrap justify-content-center align-items-center mb-3">
            <input type="text" id="liveSearch" class="form-control me-2" style="max-width: 300px;"
                placeholder="Search Events, Businesses or People">
            <input type="text" id="locationSearch" class="form-control me-2" style="max-width: 200px;"
                placeholder="Location">
            <input type="date" id="dateSearch" class="form-control me-2" style="max-width: 200px;">
            <button class="btn btn-success me-2" id="searchBtn">Search</button>
            <button class="btn btn-outline-success">+</button>
        </div>
        <p class="text-muted">Explore, schedule, and share all of your favorite scheduled events from sports, movies,
            music, and concerts to TV shows, restaurants, and nightlife events.</p>
        <!-- Live Search Results -->
        <div id="searchResults" class="mt-4" ></div>
    </div>
    <!-- Boosted Events Section -->
    <!-- Boosted Events Section -->
    <section id="boosted-events" class="boosted-events py-5">
        <div class="container">
            <div class="section-title text-center mb-4">
                <h2>Boosted Events</h2>
                <p>Explore our highlighted events that you can't miss!</p>
            </div>

            <div class="row">
                @forelse($boostedEvents as $boost)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('storage/' .$boost->event->visualIdentity->banner_url) }}"
                            class="card-img-top" alt="{{ $boost->event->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $boost->event->name }}</h5>
                            <p class="card-text text-muted text-truncate">{{ $boost->event->description }}</p>
                            <a href="{{ route('events.show', $boost->event->id) }}" class="btn btn-success btn-sm">Learn
                                More</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No boosted events available at the moment. Check back later!</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <div class="container py-5">
        <h2 class="text-center mb-4">Event Categories</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($categories as $item)
            <div class="col">
                <a href="{{ route('events.categories.name', $item->id) }}">
                    <div class="card border-0 shadow">
                        <img src="{{ $item->img_url == 'default-image-url' ? URL::asset('build/images/small/' . $item->name . '.jpg') : $item->img_url }}"
                            class="card-img-top" alt="{{ $item->name }}">
                        <div class="card-body text-center">
                            <h6 class="card-title fw-bold">{{ $item->name }}</h6>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('events.categories') }}" class="btn btn-outline-success">View All</a>
        </div>
    </div>
    <!-- Evanto - Our Services Section -->
    <div class="row mt-5">
        <div class="col-xl-12 text-center">
            <h2 class="fw-bold">Our Services</h2>
            <p class="text-muted">Discover what we offer to help make your events exceptional.</p>
        </div>
    </div>
    <div class="row mt-3">
        <!-- Service Card 1 -->
        <div class="col-xl-4 col-sm-6">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar-sm mx-auto mb-3">
                        <span class="avatar-title rounded-circle bg-info text-white font-size-24">
                            <i class="bx bx-calendar"></i>
                        </span>
                    </div>
                    <h5 class="font-size-18">Event Planning</h5>
                    <p class="text-muted">We provide end-to-end event planning services to ensure your event runs
                        smoothly.
                    </p>
                </div>
            </div>
        </div>
        <!-- Service Card 2 -->
        <div class="col-xl-4 col-sm-6">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar-sm mx-auto mb-3">
                        <span class="avatar-title rounded-circle bg-success text-white font-size-24">
                            <i class="bx bx-cog"></i>
                        </span>
                    </div>
                    <h5 class="font-size-18">Equipment Rentals</h5>
                    <p class="text-muted">Find all the equipment you need, from sound systems to cameras, all in one
                        place.
                    </p>
                </div>
            </div>
        </div>
        <!-- Service Card 3 -->
        <div class="col-xl-4 col-sm-6">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar-sm mx-auto mb-3">
                        <span class="avatar-title rounded-circle bg-warning text-white font-size-24">
                            <i class="bx bx-user-circle"></i>
                        </span>
                    </div>
                    <h5 class="font-size-18">Team Building</h5>
                    <p class="text-muted">Connect with professionals to build the perfect team for your event.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Client Services Section -->

    <section class="py-5 ">
        <div class="container text-center">
            <h2 class="fw-bold">Our Clients</h2>
            <p class="text-muted">See the brands we proudly collaborate with.</p>
            <div class="mt-4">
                <div id="clientCarousel" class="carousel slide client-carousel " data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="40" fill="none"
                                viewBox="0 0 100 40">
                                <path fill="#1D2633"
                                    d="M4.77 4.235C5.03 3.001 6.26 2 7.513 2h6.812L8.66 28.823H1.848c-1.254 0-2.06-1-1.799-2.235L4.77 4.235ZM27.477 4.235C27.738 3.001 28.967 2 30.22 2h6.812l-5.665 26.823h-6.812c-1.254 0-2.06-1-1.799-2.235l4.721-22.353ZM72.892 4.235C73.152 3.001 74.38 2 75.635 2h6.812l-5.665 26.823h-6.813c-1.254 0-2.059-1-1.798-2.235l4.72-22.353ZM39.303 2h6.812c1.254 0 2.06 1 1.799 2.235l-4.721 22.353c-.26 1.235-1.489 2.235-2.743 2.235h-6.812L39.303 2ZM84.718 2h6.812c1.254 0 2.06 1 1.799 2.235l-4.722 22.353c-.26 1.235-1.488 2.235-2.742 2.235h-6.813L84.718 2ZM50.185 4.235C50.445 3.001 51.673 2 52.927 2h6.813l-5.666 26.823h-6.812c-1.254 0-2.06-1-1.798-2.235l4.72-22.353ZM62.01 2h6.813c1.254 0 2.059 1 1.798 2.235l-7.081 33.53C63.278 38.999 62.05 40 60.796 40h-6.813L62.01 2ZM12.819 19.882h9.083l-1.416 6.706c-.261 1.235-1.49 2.235-2.743 2.235H10.93l1.888-8.94ZM44.52 31.059h9.082L51.714 40h-6.812c-1.255 0-2.06-1-1.799-2.235l1.416-6.706ZM69.174 33.138l-1.15 5.446c-.05.234-.128.298-.366.298h-.523c-.238 0-.29-.064-.24-.298l1.15-5.446c.05-.233.128-.298.366-.298h.523c.238 0 .29.065.24.298ZM70.686 36.812h-.107c-.114 0-.154.032-.177.145l-.344 1.627c-.05.234-.129.298-.366.298h-.524c-.237 0-.289-.064-.24-.298l1.15-5.446c.05-.233.13-.298.367-.298h1.08c1.244 0 1.715.443 1.485 1.53l-.192.911c-.23 1.088-.888 1.53-2.132 1.53Zm.316-2.699-.3 1.426c-.025.113.001.145.116.145h.172c.4 0 .615-.161.702-.572l.12-.572c.087-.41-.059-.572-.46-.572h-.172c-.114 0-.154.032-.178.145ZM74.74 34.991l.85.935c.446.483.508.773.394 1.313l-.03.145c-.215 1.015-.727 1.579-1.914 1.579-1.186 0-1.479-.475-1.205-1.773l.034-.16c.05-.234.129-.299.366-.299h.556c.238 0 .29.065.24.298l-.075.355c-.068.322.036.451.322.451.287 0 .443-.12.505-.41l.032-.154c.048-.226.022-.338-.224-.604l-.8-.862c-.448-.475-.505-.75-.391-1.29l.037-.176c.215-1.015.727-1.58 1.913-1.58 1.187 0 1.48.476 1.206 1.773l-.034.161c-.05.234-.129.298-.366.298h-.557c-.237 0-.289-.064-.24-.298l.075-.354c.068-.323-.035-.451-.322-.451-.286 0-.443.12-.504.41l-.029.137c-.05.234-.024.347.161.556ZM79.532 33.138c.05-.233.128-.298.366-.298h.523c.238 0 .29.065.24.298l-.856 4.053c-.274 1.297-.767 1.772-1.954 1.772-1.186 0-1.479-.475-1.205-1.773l.856-4.052c.05-.233.129-.298.366-.298h.524c.237 0 .289.065.24.298l-.897 4.246c-.068.322.044.451.355.451.302 0 .477-.129.545-.451l.897-4.246ZM82.938 36.417c.003.065.024.08.065.08.04 0 .069-.015.099-.08l1.414-3.367c.069-.17.151-.21.356-.21h.794c.237 0 .289.065.24.298l-1.15 5.446c-.05.234-.13.298-.367.298h-.376c-.237 0-.29-.064-.24-.298l.552-2.61c.015-.072.002-.089-.047-.089-.033 0-.07.017-.09.073l-1.142 2.659c-.082.193-.187.265-.424.265H82.4c-.246 0-.32-.072-.32-.265l-.028-2.66c-.005-.056-.018-.072-.059-.072-.049 0-.069.017-.084.089l-.551 2.61c-.05.234-.128.298-.366.298h-.376c-.238 0-.29-.064-.24-.298l1.15-5.446c.05-.233.129-.298.366-.298h.68c.286 0 .378.065.376.347l-.011 3.23ZM100 2c0 1.105-.89 2-1.987 2a1.993 1.993 0 0 1-1.987-2c0-1.105.89-2 1.987-2S100 .895 100 2Z">
                                </path>
                            </svg>
                        </div>
                        <div class="carousel-item">
                            <svg id="logo-48" class="gradient" width="153" height="38" viewBox="0 0 153 38" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M24.6091 19.0252C25.8577 17.9796 26.6517 16.4091 26.6517 14.6531C26.6517 12.8972 25.8577 11.3267 24.6091 10.2811C24.7522 10.2118 24.8899 10.1366 25.0211 10.0551C25.8493 9.54014 26.8268 9.24274 27.8738 9.24274C30.8619 9.24274 33.2842 11.6651 33.2842 14.6531C33.2842 17.6412 30.8619 20.0635 27.8738 20.0635C26.8268 20.0635 25.8493 19.7661 25.0211 19.2512C24.8899 19.1697 24.7522 19.0945 24.6091 19.0252Z"
                                    fill="url(#logo480_linear_1501_1254)"></path>
                                <path
                                    d="M23.1065 15.5049C23.665 13.9751 23.5674 12.218 22.6894 10.6973C21.8114 9.1766 20.3385 8.21351 18.7344 7.9323C18.8237 7.80077 18.9053 7.66678 18.9781 7.5306C19.4379 6.67055 20.1358 5.92422 21.0425 5.40072C23.6303 3.90668 26.9393 4.79331 28.4333 7.38106C29.9273 9.96882 29.0407 13.2778 26.4529 14.7718C25.5462 15.2953 24.5509 15.5265 23.5762 15.4947C23.4219 15.4896 23.265 15.4934 23.1065 15.5049Z"
                                    fill="url(#logo481_linear_1501_1254)"></path>
                                <path
                                    d="M20.0447 13.2075C19.7635 11.6034 18.8004 10.1305 17.2797 9.25252C15.759 8.37454 14.0019 8.27694 12.4721 8.83545C12.4837 8.67691 12.4874 8.52004 12.4823 8.36572C12.4505 7.39099 12.6817 6.39571 13.2052 5.48897C14.6993 2.90122 18.0082 2.01459 20.596 3.50863C23.1837 5.00267 24.0704 8.31162 22.5763 10.8994C22.0528 11.8061 21.3065 12.504 20.4464 12.9638C20.3103 13.0366 20.1763 13.1182 20.0447 13.2075Z"
                                    fill="url(#logo482_linear_1501_1254)"></path>
                                <path
                                    d="M16.2442 12.7488C15.1986 11.5002 13.6281 10.7062 11.8721 10.7062C10.1161 10.7062 8.54564 11.5002 7.50005 12.7488C7.43079 12.6057 7.35557 12.468 7.27404 12.3368C6.7591 11.5086 6.4617 10.5311 6.4617 9.48408C6.4617 6.49599 8.88402 4.07367 11.8721 4.07367C14.8602 4.07367 17.2825 6.49599 17.2825 9.48408C17.2825 10.5311 16.9851 11.5086 16.4702 12.3368C16.3886 12.468 16.3134 12.6057 16.2442 12.7488Z"
                                    fill="url(#logo483_linear_1501_1254)"></path>
                                <path
                                    d="M12.7231 14.2516C11.1933 13.6931 9.43617 13.7907 7.91546 14.6686C6.39475 15.5466 5.43166 17.0195 5.15046 18.6236C5.01893 18.5343 4.88493 18.4527 4.74875 18.3799C3.8887 17.9201 3.14237 17.2222 2.61887 16.3155C1.12482 13.7277 2.01145 10.4188 4.59921 8.92474C7.18697 7.43069 10.4959 8.31732 11.99 10.9051C12.5135 11.8118 12.7447 12.8071 12.7128 13.7818C12.7078 13.9361 12.7115 14.093 12.7231 14.2516Z"
                                    fill="url(#logo484_linear_1501_1254)"></path>
                                <path
                                    d="M10.4247 17.3136C8.82056 17.5948 7.34767 18.5579 6.46969 20.0786C5.59171 21.5993 5.49411 23.3564 6.05263 24.8862C5.89407 24.8746 5.73718 24.8709 5.58284 24.8759C4.60812 24.9078 3.61284 24.6766 2.70611 24.1531C0.118349 22.659 -0.768282 19.3501 0.72576 16.7623C2.2198 14.1746 5.52875 13.2879 8.11651 14.782C9.02324 15.3055 9.72111 16.0518 10.1809 16.9118C10.2537 17.048 10.3354 17.182 10.4247 17.3136Z"
                                    fill="url(#logo485_linear_1501_1254)"></path>
                                <path
                                    d="M9.96509 21.1144C8.71649 22.16 7.92246 23.7305 7.92246 25.4864C7.92246 27.2424 8.71649 28.8129 9.96509 29.8585C9.822 29.9277 9.68428 30.003 9.55314 30.0845C8.72493 30.5994 7.74739 30.8968 6.70038 30.8968C3.7123 30.8968 1.28998 28.4745 1.28998 25.4864C1.28998 22.4983 3.7123 20.076 6.70038 20.076C7.74739 20.076 8.72493 20.3734 9.55314 20.8884C9.68428 20.9699 9.822 21.0451 9.96509 21.1144Z"
                                    fill="url(#logo486_linear_1501_1254)"></path>
                                <path
                                    d="M11.4674 24.6356C10.9088 26.1654 11.0064 27.9225 11.8844 29.4432C12.7624 30.964 14.2353 31.927 15.8394 32.2082C15.7501 32.3398 15.6685 32.4738 15.5957 32.61C15.1359 33.47 14.438 34.2163 13.5313 34.7398C10.9435 36.2339 7.63456 35.3472 6.14052 32.7595C4.64647 30.1717 5.53311 26.8628 8.12086 25.3687C9.0276 24.8452 10.0229 24.614 10.9976 24.6459C11.1519 24.6509 11.3088 24.6472 11.4674 24.6356Z"
                                    fill="url(#logo487_linear_1501_1254)"></path>
                                <path
                                    d="M14.5293 26.934C14.8105 28.5381 15.7736 30.011 17.2943 30.8889C18.815 31.7669 20.5722 31.8645 22.102 31.306C22.0904 31.4646 22.0867 31.6214 22.0917 31.7758C22.1236 32.7505 21.8924 33.7458 21.3689 34.6525C19.8748 37.2403 16.5659 38.1269 13.9781 36.6328C11.3903 35.1388 10.5037 31.8299 11.9978 29.2421C12.5213 28.3354 13.2676 27.6375 14.1276 27.1777C14.2638 27.1049 14.3978 27.0232 14.5293 26.934Z"
                                    fill="url(#logo488_linear_1501_1254)"></path>
                                <path
                                    d="M18.3301 27.3936C19.3757 28.6422 20.9462 29.4362 22.7022 29.4362C24.4582 29.4362 26.0287 28.6422 27.0743 27.3936C27.1435 27.5367 27.2187 27.6744 27.3003 27.8055C27.8152 28.6337 28.1126 29.6113 28.1126 30.6583C28.1126 33.6464 25.6903 36.0687 22.7022 36.0687C19.7141 36.0687 17.2918 33.6464 17.2918 30.6583C17.2918 29.6113 17.5892 28.6337 18.1041 27.8055C18.1857 27.6744 18.2609 27.5367 18.3301 27.3936Z"
                                    fill="url(#logo489_linear_1501_1254)"></path>
                                <path
                                    d="M21.8514 25.8913C23.3812 26.4498 25.1383 26.3522 26.659 25.4743C28.1797 24.5963 29.1428 23.1234 29.424 21.5193C29.5555 21.6085 29.6895 21.6902 29.8257 21.763C30.6858 22.2228 31.4321 22.9207 31.9556 23.8274C33.4497 26.4152 32.563 29.7241 29.9753 31.2182C27.3875 32.7122 24.0786 31.8256 22.5845 29.2378C22.061 28.3311 21.8298 27.3358 21.8616 26.3611C21.8667 26.2068 21.863 26.0499 21.8514 25.8913Z"
                                    fill="url(#logo4810_linear_1501_1254)"></path>
                                <path
                                    d="M28.108 20.0586C28.1069 20.0605 28.1058 20.0624 28.1047 20.0643C27.2268 21.585 25.7539 22.5481 24.1498 22.8293C24.239 22.9609 24.3207 23.0949 24.3935 23.231C24.8533 24.0911 25.5512 24.8374 26.4579 25.3609C29.0457 26.855 32.3546 25.9683 33.8487 23.3806C35.1295 21.162 34.6606 18.4134 32.8701 16.7328C32.0835 18.6205 30.2582 19.967 28.108 20.0586Z"
                                    fill="url(#logo4811_linear_1501_1254)"></path>
                                <path
                                    d="M47.2605 9.84101V26H43.6793V9.84101H47.2605ZM44.247 26L44.3125 22.8337H53.593V26H44.247ZM54.1535 20.519C54.1535 19.369 54.3937 18.3645 54.8741 17.5056C55.3545 16.6321 56.0314 15.9552 56.9049 15.4748C57.7783 14.9944 58.7973 14.7542 59.962 14.7542C61.1266 14.7542 62.1383 14.9944 62.9972 15.4748C63.8707 15.9552 64.5476 16.6321 65.028 17.5056C65.5084 18.3645 65.7486 19.369 65.7486 20.519C65.7486 21.6691 65.5084 22.6736 65.028 23.5325C64.5476 24.3914 63.8707 25.061 62.9972 25.5414C62.1383 26.0218 61.1266 26.262 59.962 26.262C58.7973 26.262 57.7783 26.0218 56.9049 25.5414C56.0314 25.061 55.3545 24.3914 54.8741 23.5325C54.3937 22.6736 54.1535 21.6691 54.1535 20.519ZM57.5381 20.4972C57.5381 21.0504 57.64 21.5381 57.8438 21.9603C58.0476 22.3679 58.3315 22.6881 58.6954 22.9211C59.0594 23.1394 59.4816 23.2486 59.962 23.2486C60.4424 23.2486 60.8645 23.1394 61.2285 22.9211C61.5924 22.6881 61.869 22.3679 62.0583 21.9603C62.2621 21.5381 62.364 21.0504 62.364 20.4972C62.364 19.944 62.2621 19.4636 62.0583 19.056C61.869 18.6484 61.5924 18.3354 61.2285 18.117C60.8645 17.8841 60.4424 17.7676 59.962 17.7676C59.4816 17.7676 59.0594 17.8841 58.6954 18.117C58.3315 18.3354 58.0476 18.6484 57.8438 19.056C57.64 19.4636 57.5381 19.944 57.5381 20.4972ZM66.508 20.3444C66.508 19.2234 66.7336 18.2408 67.1849 17.3964C67.6362 16.5521 68.2549 15.897 69.041 15.4311C69.8271 14.9507 70.7297 14.7105 71.7487 14.7105C72.6076 14.7105 73.3646 14.8852 74.0197 15.2346C74.6894 15.584 75.1406 16.0426 75.3736 16.6103L75.046 16.8287L75.3081 15.0818H78.3433V25.3012C78.3433 26.5823 78.0958 27.6887 77.6009 28.6204C77.1059 29.5666 76.3999 30.2945 75.4827 30.804C74.5802 31.3135 73.5029 31.5683 72.2509 31.5683C71.2028 31.5683 70.2566 31.3572 69.4122 30.935C68.5824 30.5274 67.9055 29.9451 67.3814 29.1881C66.8719 28.4311 66.5662 27.5577 66.4643 26.5677H69.8708C69.8999 27.1937 70.1474 27.6741 70.6132 28.009C71.0936 28.3438 71.705 28.5112 72.4475 28.5112C73.2773 28.5112 73.9178 28.2783 74.3691 27.8124C74.8204 27.3611 75.046 26.757 75.046 26V23.6853L75.3517 23.9692C75.1188 24.537 74.6675 24.9955 73.9979 25.3449C73.3282 25.6943 72.5567 25.869 71.6832 25.869C70.6787 25.869 69.7834 25.6361 68.9973 25.1702C68.2258 24.7044 67.6143 24.0566 67.163 23.2268C66.7263 22.397 66.508 21.4362 66.508 20.3444ZM69.9144 20.257C69.9144 20.7811 70.0236 21.2469 70.242 21.6545C70.4604 22.0622 70.7515 22.3824 71.1155 22.6153C71.4794 22.8337 71.8797 22.9429 72.3165 22.9429C72.8405 22.9429 73.2991 22.8337 73.6922 22.6153C74.0998 22.3824 74.4128 22.0622 74.6311 21.6545C74.864 21.2469 74.9805 20.7811 74.9805 20.257C74.9805 19.7184 74.864 19.2598 74.6311 18.8813C74.3982 18.4883 74.0779 18.1825 73.6703 17.9642C73.2773 17.7458 72.8187 17.6366 72.2946 17.6366C71.8579 17.6366 71.4576 17.7458 71.0936 17.9642C70.7297 18.1825 70.4385 18.4883 70.2202 18.8813C70.0163 19.2744 69.9144 19.7329 69.9144 20.257ZM79.5418 20.519C79.5418 19.369 79.782 18.3645 80.2624 17.5056C80.7428 16.6321 81.4197 15.9552 82.2932 15.4748C83.1666 14.9944 84.1857 14.7542 85.3503 14.7542C86.5149 14.7542 87.5266 14.9944 88.3856 15.4748C89.259 15.9552 89.9359 16.6321 90.4163 17.5056C90.8967 18.3645 91.1369 19.369 91.1369 20.519C91.1369 21.6691 90.8967 22.6736 90.4163 23.5325C89.9359 24.3914 89.259 25.061 88.3856 25.5414C87.5266 26.0218 86.5149 26.262 85.3503 26.262C84.1857 26.262 83.1666 26.0218 82.2932 25.5414C81.4197 25.061 80.7428 24.3914 80.2624 23.5325C79.782 22.6736 79.5418 21.6691 79.5418 20.519ZM82.9264 20.4972C82.9264 21.0504 83.0283 21.5381 83.2321 21.9603C83.4359 22.3679 83.7198 22.6881 84.0838 22.9211C84.4477 23.1394 84.8699 23.2486 85.3503 23.2486C85.8307 23.2486 86.2529 23.1394 86.6168 22.9211C86.9807 22.6881 87.2573 22.3679 87.4466 21.9603C87.6504 21.5381 87.7523 21.0504 87.7523 20.4972C87.7523 19.944 87.6504 19.4636 87.4466 19.056C87.2573 18.6484 86.9807 18.3354 86.6168 18.117C86.2529 17.8841 85.8307 17.7676 85.3503 17.7676C84.8699 17.7676 84.4477 17.8841 84.0838 18.117C83.7198 18.3354 83.4359 18.6484 83.2321 19.056C83.0283 19.4636 82.9264 19.944 82.9264 20.4972ZM92.5514 26V15.0818H95.936V26H92.5514ZM94.2546 13.3785C93.716 13.3785 93.2574 13.1965 92.8789 12.8326C92.515 12.4541 92.333 11.9955 92.333 11.4569C92.333 10.9183 92.515 10.467 92.8789 10.103C93.2574 9.7391 93.716 9.55713 94.2546 9.55713C94.7787 9.55713 95.2227 9.7391 95.5866 10.103C95.9651 10.467 96.1544 10.9183 96.1544 11.4569C96.1544 11.9955 95.9651 12.4541 95.5866 12.8326C95.2227 13.1965 94.7787 13.3785 94.2546 13.3785ZM98.1246 31.2408V15.0818H101.204L101.378 16.4138C101.684 15.9043 102.172 15.4967 102.841 15.1909C103.511 14.8852 104.232 14.7324 105.003 14.7324C106.022 14.7324 106.91 14.958 107.667 15.4093C108.424 15.8606 109.021 16.5084 109.458 17.3528C109.894 18.1825 110.127 19.187 110.157 20.3662C110.186 21.5162 109.996 22.5426 109.589 23.4451C109.181 24.3331 108.592 25.0319 107.82 25.5414C107.048 26.051 106.117 26.3057 105.025 26.3057C104.268 26.3057 103.562 26.1747 102.907 25.9127C102.252 25.6506 101.764 25.3158 101.444 24.9082V31.2408H98.1246ZM101.509 20.5409C101.509 21.0795 101.618 21.5599 101.837 21.9821C102.07 22.3897 102.383 22.71 102.776 22.9429C103.183 23.1613 103.649 23.2704 104.173 23.2704C104.712 23.2704 105.171 23.154 105.549 22.9211C105.942 22.6881 106.241 22.3679 106.444 21.9603C106.663 21.5526 106.772 21.0795 106.772 20.5409C106.772 20.0022 106.663 19.5291 106.444 19.1215C106.241 18.7139 105.942 18.3936 105.549 18.1607C105.171 17.9278 104.712 17.8113 104.173 17.8113C103.649 17.8113 103.183 17.9278 102.776 18.1607C102.383 18.3791 102.07 18.6921 101.837 19.0997C101.618 19.5073 101.509 19.9877 101.509 20.5409ZM110.733 22.5498H113.769C113.769 22.9283 113.892 23.2268 114.14 23.4451C114.402 23.6635 114.78 23.7727 115.275 23.7727C115.566 23.7727 115.807 23.7363 115.996 23.6635C116.2 23.5907 116.353 23.4888 116.454 23.3578C116.571 23.2122 116.629 23.0521 116.629 22.8774C116.629 22.6881 116.564 22.528 116.433 22.397C116.316 22.266 116.112 22.1641 115.821 22.0913L113.9 21.589C112.822 21.2979 112.058 20.8684 111.607 20.3007C111.155 19.7329 110.93 19.0851 110.93 18.3572C110.93 17.6293 111.112 16.9961 111.476 16.4575C111.854 15.9043 112.364 15.4821 113.004 15.1909C113.645 14.8852 114.365 14.7324 115.166 14.7324C116.374 14.7324 117.364 15.0672 118.136 15.7369C118.922 16.3919 119.337 17.2872 119.381 18.4227H116.345C116.36 18.0442 116.251 17.7458 116.018 17.5274C115.785 17.2945 115.479 17.1781 115.101 17.1781C114.766 17.1781 114.489 17.2654 114.271 17.4401C114.067 17.6002 113.965 17.8259 113.965 18.117C113.965 18.3936 114.067 18.5974 114.271 18.7285C114.475 18.8449 114.751 18.9468 115.101 19.0342L117.044 19.5146C117.947 19.7329 118.631 20.1042 119.097 20.6282C119.563 21.1523 119.795 21.822 119.795 22.6372C119.795 23.7581 119.381 24.6461 118.551 25.3012C117.721 25.9563 116.644 26.2839 115.319 26.2839C113.951 26.2839 112.851 25.9418 112.022 25.2576C111.206 24.5588 110.777 23.6562 110.733 22.5498ZM125.161 26.2839C123.88 26.2839 122.89 25.8835 122.191 25.0829C121.493 24.2822 121.143 23.234 121.143 21.9384V15.0818H124.506V20.7156C124.506 21.7346 124.688 22.4188 125.052 22.7682C125.416 23.1176 125.896 23.2923 126.493 23.2923C127.265 23.2923 127.796 23.0739 128.087 22.6372C128.378 22.2005 128.524 21.5745 128.524 20.7592V15.0818H131.887V26H128.721L128.502 24.7772C128.167 25.2284 127.694 25.5924 127.083 25.869C126.471 26.1456 125.831 26.2839 125.161 26.2839ZM137.438 26H134.053V15.0818H137.198L137.438 16.9597L137.067 16.5666C137.358 16.0134 137.795 15.5694 138.377 15.2346C138.974 14.8852 139.614 14.7105 140.299 14.7105C141.376 14.7105 142.22 14.9507 142.832 15.4311C143.458 15.9115 143.909 16.5448 144.185 17.3309H143.661C143.836 16.5448 144.258 15.9115 144.928 15.4311C145.598 14.9507 146.398 14.7105 147.33 14.7105C148.742 14.7105 149.783 15.089 150.453 15.846C151.122 16.603 151.457 17.6075 151.457 18.8595V26H148.182V19.6893C148.182 19.005 148.014 18.4955 147.679 18.1607C147.359 17.8259 146.93 17.6585 146.391 17.6585C146.071 17.6585 145.765 17.7313 145.474 17.8768C145.183 18.0078 144.942 18.248 144.753 18.5974C144.564 18.9323 144.469 19.4127 144.469 20.0386V26H141.15V19.6893C141.15 19.005 140.99 18.5028 140.67 18.1825C140.349 17.8477 139.92 17.6803 139.381 17.6803C139.061 17.6803 138.748 17.7531 138.442 17.8987C138.151 18.0297 137.911 18.2699 137.722 18.6193C137.533 18.9541 137.438 19.4272 137.438 20.0386V26Z"
                                    class="cneutral" fill="#1B3D5B"></path>
                                <defs>
                                    <linearGradient id="logo480_linear_1501_1254" x1="25.2865" y1="9.24274" x2="25.2865"
                                        y2="20.0635" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                    <linearGradient id="logo481_linear_1501_1254" x1="18.8019" y1="6.69435" x2="24.2123"
                                        y2="16.0655" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                    <linearGradient id="logo482_linear_1501_1254" x1="11.9116" y1="7.72962" x2="21.2827"
                                        y2="13.14" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                    <linearGradient id="logo483_linear_1501_1254" x1="6.4617" y1="12.0713" x2="17.2825"
                                        y2="12.0713" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                    <linearGradient id="logo484_linear_1501_1254" x1="3.91251" y1="18.5561" x2="13.2836"
                                        y2="13.1457" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                    <linearGradient id="logo485_linear_1501_1254" x1="4.94677" y1="25.4467" x2="10.3572"
                                        y2="16.0756" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                    <linearGradient id="logo486_linear_1501_1254" x1="9.28766" y1="30.8968" x2="9.28766"
                                        y2="20.076" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                    <linearGradient id="logo487_linear_1501_1254" x1="15.7719" y1="33.4462" x2="10.3615"
                                        y2="24.0751" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                    <linearGradient id="logo488_linear_1501_1254" x1="22.6625" y1="32.4119" x2="13.2914"
                                        y2="27.0014" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                    <linearGradient id="logo489_linear_1501_1254" x1="28.1126" y1="28.071" x2="17.2918"
                                        y2="28.071" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                    <linearGradient id="logo4810_linear_1501_1254" x1="30.662" y1="21.5868" x2="21.2909"
                                        y2="26.9972" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                    <linearGradient id="logo4811_linear_1501_1254" x1="29.6277" y1="14.6962"
                                        x2="24.2173" y2="24.0673" gradientUnits="userSpaceOnUse">
                                        <stop class="ccustom" stop-color="#25136D"></stop>
                                        <stop offset="1" class="ccompli1" stop-color="#3D9BA2"></stop>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        <div class="carousel-item">
                            <svg id="logo-47" width="155" height="29" class="gradient" viewBox="0 0 155 29" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.4469 23.968C7.46073 26.9542 2.40329 26.9423 0.990883 22.9624C0.714354 22.1832 0.493259 21.382 0.330644 20.5645C-0.333309 17.2265 0.00745592 13.7667 1.30985 10.6224C2.61224 7.4782 4.81776 4.79076 7.64751 2.89998C10.4773 1.0092 13.8042 -1.45785e-07 17.2075 0C20.6108 1.45785e-07 23.9377 1.0092 26.7674 2.89998C29.5972 4.79076 31.8027 7.4782 33.1051 10.6225C34.4075 13.7667 34.7482 17.2265 34.0843 20.5645C33.9217 21.382 33.7006 22.1832 33.424 22.9624C32.0116 26.9423 26.9542 26.9542 23.968 23.968L19.3584 19.3584C18.918 18.918 18.9635 18.1917 19.085 17.5809C19.1588 17.2096 19.1209 16.8247 18.976 16.4749C18.8311 16.1251 18.5858 15.8261 18.271 15.6158C17.9562 15.4055 17.5861 15.2932 17.2075 15.2932C16.8289 15.2932 16.4588 15.4055 16.144 15.6158C15.8291 15.8261 15.5838 16.1251 15.4389 16.4749C15.294 16.8247 15.2561 17.2096 15.33 17.5809C15.4515 18.1917 15.4969 18.918 15.0565 19.3584L10.4469 23.968Z"
                                    fill="url(#logo470_linear_1495_1244)"></path>
                                <path d="M48.4145 19.8367H53.0398V22.5624H44.8835V8.06683H48.4145V19.8367Z"
                                    class="cneutral" fill="#3A3B7B"></path>
                                <path
                                    d="M59.3494 22.7276C58.2206 22.7276 57.2019 22.4867 56.2933 22.0049C55.3986 21.5231 54.6896 20.8348 54.1665 19.94C53.6572 19.0452 53.4025 17.999 53.4025 16.8013C53.4025 15.6175 53.664 14.5781 54.1871 13.6833C54.7103 12.7748 55.4261 12.0796 56.3346 11.5978C57.2432 11.116 58.2619 10.8751 59.3907 10.8751C60.5195 10.8751 61.5382 11.116 62.4467 11.5978C63.3553 12.0796 64.0711 12.7748 64.5942 13.6833C65.1173 14.5781 65.3789 15.6175 65.3789 16.8013C65.3789 17.9852 65.1104 19.0314 64.5736 19.94C64.0505 20.8348 63.3278 21.5231 62.4054 22.0049C61.4969 22.4867 60.4782 22.7276 59.3494 22.7276ZM59.3494 19.6715C60.0239 19.6715 60.5952 19.4238 61.0633 18.9282C61.5451 18.4326 61.786 17.7237 61.786 16.8013C61.786 15.879 61.5519 15.1701 61.0839 14.6745C60.6296 14.1789 60.0652 13.9311 59.3907 13.9311C58.7024 13.9311 58.1311 14.1789 57.6768 14.6745C57.2225 15.1563 56.9954 15.8652 56.9954 16.8013C56.9954 17.7237 57.2157 18.4326 57.6562 18.9282C58.1105 19.4238 58.6749 19.6715 59.3494 19.6715Z"
                                    class="cneutral" fill="#3A3B7B"></path>
                                <path
                                    d="M71.0102 10.8751C71.8224 10.8751 72.5314 11.0403 73.1371 11.3707C73.7565 11.701 74.2315 12.1347 74.5619 12.6715V11.0403H78.0928V22.5417C78.0928 23.6017 77.8795 24.5585 77.4527 25.4119C77.0397 26.2792 76.3996 26.9675 75.5324 27.4768C74.6789 27.9862 73.612 28.2409 72.3318 28.2409C70.6248 28.2409 69.2413 27.8348 68.1813 27.0226C67.1214 26.2241 66.5156 25.1366 66.3642 23.76H69.8539C69.964 24.2005 70.2256 24.5447 70.6386 24.7925C71.0515 25.054 71.5609 25.1848 72.1666 25.1848C72.8962 25.1848 73.4743 24.9714 73.9011 24.5447C74.3416 24.1317 74.5619 23.4641 74.5619 22.5417V20.9105C74.2177 21.4473 73.7428 21.8879 73.1371 22.232C72.5314 22.5624 71.8224 22.7276 71.0102 22.7276C70.0604 22.7276 69.2 22.4867 68.4291 22.0049C67.6582 21.5093 67.0456 20.8141 66.5914 19.9193C66.1509 19.0108 65.9306 17.9646 65.9306 16.7807C65.9306 15.5968 66.1509 14.5575 66.5914 13.6627C67.0456 12.7679 67.6582 12.0796 68.4291 11.5978C69.2 11.116 70.0604 10.8751 71.0102 10.8751ZM74.5619 16.8013C74.5619 15.9203 74.3141 15.2251 73.8185 14.7158C73.3367 14.2065 72.7447 13.9518 72.0427 13.9518C71.3406 13.9518 70.7418 14.2065 70.2462 14.7158C69.7644 15.2114 69.5235 15.8997 69.5235 16.7807C69.5235 17.6617 69.7644 18.3638 70.2462 18.8869C70.7418 19.3962 71.3406 19.6509 72.0427 19.6509C72.7447 19.6509 73.3367 19.3962 73.8185 18.8869C74.3141 18.3775 74.5619 17.6824 74.5619 16.8013Z"
                                    class="cneutral" fill="#3A3B7B"></path>
                                <path
                                    d="M85.2727 22.7276C84.1439 22.7276 83.1252 22.4867 82.2167 22.0049C81.3219 21.5231 80.6129 20.8348 80.0898 19.94C79.5805 19.0452 79.3258 17.999 79.3258 16.8013C79.3258 15.6175 79.5873 14.5781 80.1105 13.6833C80.6336 12.7748 81.3494 12.0796 82.2579 11.5978C83.1665 11.116 84.1852 10.8751 85.314 10.8751C86.4428 10.8751 87.4615 11.116 88.37 11.5978C89.2786 12.0796 89.9944 12.7748 90.5175 13.6833C91.0406 14.5781 91.3022 15.6175 91.3022 16.8013C91.3022 17.9852 91.0338 19.0314 90.4969 19.94C89.9738 20.8348 89.2511 21.5231 88.3287 22.0049C87.4202 22.4867 86.4015 22.7276 85.2727 22.7276ZM85.2727 19.6715C85.9472 19.6715 86.5185 19.4238 86.9866 18.9282C87.4684 18.4326 87.7093 17.7237 87.7093 16.8013C87.7093 15.879 87.4752 15.1701 87.0072 14.6745C86.5529 14.1789 85.9885 13.9311 85.314 13.9311C84.6257 13.9311 84.0544 14.1789 83.6001 14.6745C83.1459 15.1563 82.9187 15.8652 82.9187 16.8013C82.9187 17.7237 83.139 18.4326 83.5795 18.9282C84.0338 19.4238 84.5982 19.6715 85.2727 19.6715Z"
                                    class="cneutral" fill="#3A3B7B"></path>
                                <path
                                    d="M94.3318 9.84264C93.7123 9.84264 93.203 9.66368 92.8038 9.30577C92.4183 8.93409 92.2256 8.47981 92.2256 7.94294C92.2256 7.3923 92.4183 6.93802 92.8038 6.5801C93.203 6.20842 93.7123 6.02258 94.3318 6.02258C94.9375 6.02258 95.4331 6.20842 95.8185 6.5801C96.2177 6.93802 96.4173 7.3923 96.4173 7.94294C96.4173 8.47981 96.2177 8.93409 95.8185 9.30577C95.4331 9.66368 94.9375 9.84264 94.3318 9.84264ZM96.0869 11.0403V22.5624H92.556V11.0403H96.0869Z"
                                    class="cneutral" fill="#3A3B7B"></path>
                                <path
                                    d="M101.557 12.6715C101.901 12.1347 102.376 11.701 102.982 11.3707C103.588 11.0403 104.297 10.8751 105.109 10.8751C106.059 10.8751 106.919 11.116 107.69 11.5978C108.461 12.0796 109.067 12.7679 109.507 13.6627C109.961 14.5575 110.189 15.5968 110.189 16.7807C110.189 17.9646 109.961 19.0108 109.507 19.9193C109.067 20.8141 108.461 21.5093 107.69 22.0049C106.919 22.4867 106.059 22.7276 105.109 22.7276C104.31 22.7276 103.602 22.5624 102.982 22.232C102.376 21.9016 101.901 21.4749 101.557 20.9518V28.055H98.0263V11.0403H101.557V12.6715ZM106.596 16.7807C106.596 15.8997 106.348 15.2114 105.852 14.7158C105.37 14.2065 104.772 13.9518 104.056 13.9518C103.354 13.9518 102.755 14.2065 102.259 14.7158C101.778 15.2251 101.537 15.9203 101.537 16.8013C101.537 17.6824 101.778 18.3775 102.259 18.8869C102.755 19.3962 103.354 19.6509 104.056 19.6509C104.758 19.6509 105.357 19.3962 105.852 18.8869C106.348 18.3638 106.596 17.6617 106.596 16.7807Z"
                                    class="cneutral" fill="#3A3B7B"></path>
                                <path
                                    d="M116.109 22.7276C115.104 22.7276 114.209 22.5555 113.424 22.2114C112.64 21.8672 112.02 21.3992 111.566 20.8072C111.112 20.2015 110.857 19.527 110.802 18.7836H114.292C114.333 19.1828 114.519 19.5063 114.849 19.7541C115.18 20.0019 115.586 20.1258 116.068 20.1258C116.508 20.1258 116.845 20.0432 117.079 19.878C117.327 19.6991 117.451 19.4719 117.451 19.1966C117.451 18.8662 117.279 18.6253 116.935 18.4739C116.591 18.3087 116.033 18.1298 115.262 17.937C114.436 17.7443 113.748 17.5447 113.197 17.3382C112.647 17.118 112.172 16.7807 111.773 16.3264C111.373 15.8584 111.174 15.232 111.174 14.4474C111.174 13.7866 111.353 13.1878 111.711 12.6509C112.082 12.1003 112.619 11.6666 113.321 11.35C114.037 11.0334 114.884 10.8751 115.861 10.8751C117.306 10.8751 118.442 11.233 119.268 11.9488C120.108 12.6647 120.59 13.6145 120.714 14.7984H117.451C117.396 14.3992 117.217 14.0826 116.914 13.8485C116.625 13.6145 116.24 13.4975 115.758 13.4975C115.345 13.4975 115.028 13.5801 114.808 13.7453C114.588 13.8967 114.478 14.1101 114.478 14.3854C114.478 14.7158 114.65 14.9636 114.994 15.1288C115.352 15.294 115.902 15.4592 116.646 15.6243C117.499 15.8446 118.194 16.0649 118.731 16.2851C119.268 16.4916 119.736 16.8357 120.135 17.3176C120.548 17.7856 120.762 18.4188 120.776 19.2173C120.776 19.8918 120.583 20.4975 120.197 21.0344C119.826 21.5575 119.282 21.9705 118.566 22.2733C117.864 22.5762 117.045 22.7276 116.109 22.7276Z"
                                    class="cneutral" fill="#3A3B7B"></path>
                                <path
                                    d="M133.694 11.0403V22.5624H130.163V20.9931C129.805 21.5024 129.316 21.9154 128.697 22.232C128.091 22.5349 127.417 22.6863 126.673 22.6863C125.792 22.6863 125.014 22.4936 124.34 22.1081C123.665 21.7089 123.142 21.1376 122.771 20.3943C122.399 19.6509 122.213 18.7768 122.213 17.7718V11.0403H125.723V17.2969C125.723 18.0678 125.923 18.6666 126.322 19.0934C126.721 19.5201 127.258 19.7335 127.933 19.7335C128.621 19.7335 129.165 19.5201 129.564 19.0934C129.963 18.6666 130.163 18.0678 130.163 17.2969V11.0403H133.694Z"
                                    class="cneutral" fill="#3A3B7B"></path>
                                <path
                                    d="M150.313 10.9164C151.744 10.9164 152.88 11.35 153.72 12.2173C154.573 13.0845 155 14.289 155 15.8308V22.5624H151.49V16.3058C151.49 15.5624 151.29 14.9911 150.891 14.5919C150.505 14.1789 149.969 13.9724 149.28 13.9724C148.592 13.9724 148.048 14.1789 147.649 14.5919C147.264 14.9911 147.071 15.5624 147.071 16.3058V22.5624H143.56V16.3058C143.56 15.5624 143.361 14.9911 142.962 14.5919C142.576 14.1789 142.039 13.9724 141.351 13.9724C140.663 13.9724 140.119 14.1789 139.72 14.5919C139.334 14.9911 139.142 15.5624 139.142 16.3058V22.5624H135.611V11.0403H139.142V12.4857C139.5 12.0039 139.968 11.6253 140.546 11.35C141.124 11.0609 141.778 10.9164 142.507 10.9164C143.375 10.9164 144.146 11.1022 144.82 11.4739C145.508 11.8456 146.045 12.3756 146.431 13.0639C146.83 12.4306 147.374 11.9144 148.062 11.5152C148.75 11.116 149.501 10.9164 150.313 10.9164Z"
                                    class="cneutral" fill="#3A3B7B"></path>
                                <defs>
                                    <linearGradient id="logo470_linear_1495_1244" x1="32.8486" y1="8.60374" x2="2.30537"
                                        y2="8.60374" gradientUnits="userSpaceOnUse">
                                        <stop class="ccompli2" stop-color="#64C2DB"></stop>
                                        <stop offset="0.510417" class="ccompli1" stop-color="#7476ED"></stop>
                                        <stop offset="1" class="ccustom" stop-color="#E56F8C"></stop>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#clientCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#clientCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ Section -->
    <div class="row mt-5">
        <div class="col-xl-12 text-center">
            <h2 class="fw-bold">FAQ</h2>
        </div>
    </div>
    <div class="row mt-3 mb-4">
        <div class="col-xl-12">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <img src="{{ URL::asset('build/images/faq-img.png') }}" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="row mt-3 ">
                <!-- FAQ Card 1 -->
                <div class="col-xl-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body overflow-hidden position-relative">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                            <i class="bx bx-question-mark"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="font-size-17">Who is Evanto?</h5>
                                    <p class="text-muted mt-2 mb-0">Evanto is a renowned developer and designer, known
                                        for
                                        his work in web design and app development. His projects often focus on
                                        innovative
                                        and user-centered design principles.</p>
                                    <div class="mt-3 pt-1">
                                        <a href="" class="text-success fw-semibold"><u>Read More</u>
                                            <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FAQ Card 2 -->
                <div class="col-xl-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body overflow-hidden position-relative">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-success text-white font-size-16">
                                            <i class="bx bx-help-circle"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="font-size-17">What does Evanto offer?</h5>
                                    <p class="text-muted mt-2 mb-0">Evanto provides a range of solutions including event
                                        booking, ticket management, and a marketplace for equipment and venue rentals.
                                    </p>
                                    <div class="mt-3 pt-1">
                                        <a href="" class="text-success fw-semibold"><u>Read More</u>
                                            <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FAQ Card 3 -->
                <div class="col-xl-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body overflow-hidden position-relative">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-warning text-white font-size-16">
                                            <i class="bx bx-book"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="font-size-17">How to book an event?</h5>
                                    <p class="text-muted mt-2 mb-0">Simply search for your desired event, click 'Book
                                        Now,'
                                        and follow the prompts to secure your spot. It's quick and hassle-free!</p>
                                    <div class="mt-3 pt-1">
                                        <a href="" class="text-success fw-semibold"><u>Read More</u>
                                            <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FAQ Card 4 -->
                <div class="col-xl-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body overflow-hidden position-relative">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-danger text-white font-size-16">
                                            <i class="bx bx-shield"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="font-size-17">Is my payment secure?</h5>
                                    <p class="text-muted mt-2 mb-0">Yes, we use the latest encryption technologies to
                                        ensure
                                        that your payments and personal information remain secure.</p>
                                    <div class="mt-3 pt-1">
                                        <a href="" class="text-success fw-semibold"><u>Read More</u>
                                            <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FAQ Card 5 -->
                <div class="col-xl-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body overflow-hidden position-relative">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-info text-white font-size-16">
                                            <i class="bx bx-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="font-size-17">Can I host my own event?</h5>
                                    <p class="text-muted mt-2 mb-0">Absolutely! Sign up as an organizer and add your
                                        event
                                        details to reach a broader audience.</p>
                                    <div class="mt-3 pt-1">
                                        <a href="" class="text-success fw-semibold"><u>Read More</u>
                                            <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FAQ Card 6 -->
                <div class="col-xl-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body overflow-hidden position-relative">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-dark text-white font-size-16">
                                            <i class="bx bx-map"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="font-size-17">Where is Evanto available?</h5>
                                    <p class="text-muted mt-2 mb-0">Evanto currently operates in Algeria, with plans to
                                        expand
                                        to other regions soon.</p>
                                    <div class="mt-3 pt-1">
                                        <a href="" class="text-success fw-semibold"><u>Read More</u>
                                            <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.home-footer')

    @endsection


    @section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        // Smooth scrolling to next section
            function scrollToContent() {
                window.scrollBy({
                    top: window.innerHeight - 180, // Scroll to the next section, accounting for header height
                    behavior: 'smooth'
                });
            }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#liveSearch, #locationSearch, #dateSearch').on('keyup change', function () {
                const query = $('#liveSearch').val();
                const location = $('#locationSearch').val();
                const date = $('#dateSearch').val();
    
                $.ajax({
                    url: "{{ route('events.liveSearch') }}",
                    method: "GET",
                    data: { query: query, location: location, date: date },
                    success: function (data) {
                        $('#searchResults').html(data);
                    }
                });
            });
        });
    </script>
    @endsection