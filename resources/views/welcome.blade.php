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
    <div class="row ">
        <div class="container-fluid p-0">
            <!-- Use container-fluid to fill the screen width -->
            <div class="card shadow-lg border-0" style="height: 80vh;">
                <!-- Set height to match the viewport -->
                <div id="eventCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                    <!-- Ensure carousel fills the card -->
                    <!-- Carousel Items -->
                    <div class="carousel-inner h-100">
                        <!-- Ensure items fill the height -->
                        @foreach ($topEvents as $index => $event)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }} h-100">
                            <img src="{{ asset($event->visualIdentity->banner_url) }}"
                                class="d-block w-100 h-75 object-fit-cover" alt="{{ $event->name }}">

                            <div class="card-body text-center h-25 d-flex flex-column justify-content-center">
                                <h5 class="card-title mb-3">{{ $event->name }}</h5>
                                <p class="text-muted mb-4">
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }} to
                                    {{ \Carbon\Carbon::parse($event->end_date)->format('F d, Y') }}</p>
                                <div>
                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-success me-2">Event
                                        Info</a>
                                    <a href="#" class="btn btn-outline-success">Add to Calendar</a>
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
        <div class="card shadow-lg border-0">
            <div class="card-body">
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
                    <p class="text-muted">Explore, schedule and share all of your favorite scheduled events from sports,
                        movies,
                        music,
                        and concerts to TV shows, restaurants, and nightlife events.</p>
                </div>
                <div class="container py-5">
                        <h2 class="text-center mb-4">Event Categories</h2>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                            @foreach ($categgories as $item)
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
                    
                            <!-- Add more categories -->
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('events.categories') }}" class="btn btn-outline-primary">View All</a>
                        </div>
                    </div>
                    <div class="container py-5">
                        <h2 class="text-center mb-4">Event Domains</h2>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            @foreach ($domains as $item)
                            <button type="button" class="btn btn-success w-lg waves-effect waves-light" data-bs-toggle="button"
                                autocomplete="off">
                                {{ $item->name }}
                            </button>
                            @endforeach
                            <!-- Add more categories -->
                        </div>
                        <div class="text-center mt-4">
                            <a href="#" class="btn btn-outline-primary">View All</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="text-center my-5">
                                <img src="{{ URL::asset('build/images/faq-img.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="card-body overflow-hidden position-relative">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                    <i class="bx bx-question-mark"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="font-size-17">Who is Evanto?</h5>
                                            <p class="text-muted mt-2 mb-0">Evanto is a renowned developer and
                                                designer, known for his work in web design and app development. His
                                                projects often focus on innovative and user-centered design principles.
                                            </p>

                                            <div class="mt-3 pt-1">
                                                <a href="" class="text-primary fw-semibold"> <u>Read More </u>
                                                    <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="card-body overflow-hidden position-relative">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                    <i class="bx bx-question-mark"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="font-size-17">What is his design philosophy?</h5>
                                            <p class="text-muted mt-2 mb-0">Evanto's design philosophy centers around
                                                creating clean, modern, and highly functional user interfaces that meet
                                                the needs of the end-user while maintaining aesthetic appeal.</p>

                                            <div class="mt-3 pt-1">
                                                <a href="" class="text-primary fw-semibold"> <u>Read More </u>
                                                    <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="card-body overflow-hidden position-relative">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                    <i class="bx bx-question-mark"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="font-size-17">What are his notable projects?</h5>
                                            <p class="text-muted mt-2 mb-0">Lorem ipsum dolor sit amet consectetur
                                                adipisicing elit. Illo, repudiandae! Laboriosam itaque earum possimus
                                                eius officiis. Asperiores esse ipsum minus! Tenetur molestias ea fuga.
                                                Saepe repellat quibusdam quae nulla iure!</p>

                                            <div class="mt-3 pt-1">
                                                <a href="" class="text-primary fw-semibold"> <u>Read More </u>
                                                    <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="card-body overflow-hidden position-relative">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                    <i class="bx bx-question-mark"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="font-size-17">Why is he successful in his field?</h5>
                                            <p class="text-muted mt-2 mb-0">Evanto’s success is rooted in his
                                                dedication to continuous learning and adapting to emerging technologies,
                                                combined with his ability to collaborate effectively with teams to bring
                                                visionary ideas to life.</p>

                                            <div class="mt-3 pt-1">
                                                <a href="" class="text-primary fw-semibold"> <u>Read More </u>
                                                    <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="card-body overflow-hidden position-relative">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                    <i class="bx bx-question-mark"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="font-size-17">What tools does he use in his work?</h5>
                                            <p class="text-muted mt-2 mb-0">Evanto utilizes a range of advanced design
                                                and development tools such as Adobe Creative Suite, Figma, Sketch, and
                                                various front-end and back-end frameworks to deliver high-quality
                                                projects.</p>

                                            <div class="mt-3 pt-1">
                                                <a href="" class="text-primary fw-semibold"> <u>Read More </u>
                                                    <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="card">
                                <div class="card-body overflow-hidden position-relative">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                    <i class="bx bx-question-mark"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="font-size-17">How can I collaborate with Evanto?</h5>
                                            <p class="text-muted mt-2 mb-0">Evanto is always open to collaboration with
                                                fellow designers, developers, and businesses. Whether it’s through
                                                consulting, project development, or partnerships, he welcomes
                                                opportunities to work on exciting ventures.</p>

                                            <div class="mt-3 pt-1">
                                                <a href="" class="text-primary fw-semibold"> <u>Read More </u>
                                                    <i class="mdi mdi-arrow-right ms-1 align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div>
        </div>
    </div>

    @include('layouts.home-footer')

    @endsection


    @section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection