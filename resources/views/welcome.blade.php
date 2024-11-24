@extends('layouts.master-without-nav')
@section('title', 'Home')
@section('page-title', 'Home')
@section('css')
<style>
    /* Ensure image fills its container without stretching */
    .object-fit-cover {
        object-fit: cover;
        /* Maintain aspect ratio while filling the container */
    }

    /* Prevent overflow and ensure layout consistency */
    .carousel-inner {
        height: 100%;
    }

    /* Flexbox for centering content */
    .card-body {
        height: 25%;
        /* Allocate 25% of the card for text and buttons */
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>
@endsection
@section('body')

<body data-layout="horizontal" data-layout-size="boxed" data-layout-scrollable="false">
    @endsection
    @section('content')
    <div class="row w-100">
        <div class="container-fluid p-0">
            <!-- Use container-fluid to fill the screen width -->
            <div class="card shadow-lg border-0" style="height: 80vh;">
                <!-- Set height to match the viewport -->
                <div id="eventCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                    <!-- Ensure carousel fills the card -->
                    <!-- Carousel Items -->
                    <div class="carousel-inner h-100">
                        <!-- Ensure items fill the height -->
                        @foreach ($events as $index => $event)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }} h-100">
                            <img src="{{ asset($event->image) }}" class="d-block w-100 h-75 object-fit-cover"
                                alt="{{ $event->name }}">

                            <div class="card-body text-center h-25 d-flex flex-column justify-content-center">
                                <h5 class="card-title mb-3">{{ $event->name }}</h5>
                                <p class="text-muted mb-4">{{ \Carbon\Carbon::parse($event->startdate)->format('F d, Y')
                                    }}</p>
                                <div>
                                    <a href="#" class="btn btn-danger me-2">Event Info</a>
                                    <a href="#" class="btn btn-outline-danger">Add to Calendar</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Controls -->
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
    </div>
    <div class="row">
        <div class="col-12  text-white py-5 text-center">
            <h1 class="mb-4">Live a little! Because when things get scheduled, things get done!</h1>
            <div class="d-flex flex-wrap justify-content-center align-items-center mb-3">
                <input type="text" class="form-control me-2" style="max-width: 300px;"
                    placeholder="Search Events, Businesses or People">
                <input type="text" class="form-control me-2" style="max-width: 200px;" placeholder="Location">
                <input type="date" class="form-control me-2" style="max-width: 200px;">
                <button class="btn btn-danger me-2">Search</button>
                <button class="btn btn-outline-danger">+</button>
            </div>
            <p class="text-muted">Explore, schedule and share all of your favorite scheduled events from sports, movies,
                music,
                and concerts to TV shows, restaurants, and nightlife events.</p>
        </div>
    </div>
    <div class="container py-5">
        <h2 class="text-center mb-4">Event Categories</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($categgories as $item)
            <div class="col">
                <div class="card border-0 shadow">
                    <img src="{{ $item->img_url == 'default-image-url' ? URL::asset('build/images/small/img-3.jpg') : $item->img_url }}"
                        class="card-img-top" alt="{{$item->name}}">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold">{{$item->name}}</h6>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Add more categories -->
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-primary">View All</a>
        </div>
    </div>
    <div class="container py-5">
        <h2 class="text-center mb-4">Event Domains</h2>
        <div class="d-flex flex-wrap gap-2 justify-content-center">
            @foreach ($domains as $item)
            <button type="button" class="btn btn-success w-lg waves-effect waves-light" data-bs-toggle="button" autocomplete="off">
                {{$item->name}}
            </button>
            @endforeach
            <!-- Add more categories -->
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-primary">View All</a>
        </div>
    </div>
    <div class="container py-5">
        <h2 class="text-center mb-4">Event Domains</h2>
        <div class="d-flex flex-wrap gap-2 justify-content-center">
            @foreach ($domains as $item)
            <button type="button" class="btn btn-success w-lg waves-effect waves-light" data-bs-toggle="button"
                autocomplete="off">
                {{$item->name}}
            </button>
            @endforeach
            <!-- Add more categories -->
        </div>
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-primary">View All</a>
        </div>
    </div>



    @endsection


    @section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection