@extends('layouts.master-without-nav')
@section('title', 'Home')
@section('page-title', 'Home')
@section('css')

@endsection
@section('body')

<body data-layout="horizontal" data-layout-size="boxed" data-layout-scrollable="false">
    @endsection
    @section('content')

    <div class="row">
        <div class="col-12  text-white py-5 text-center">
            <h1 class="mb-4">Live a little! Because when things get scheduled, things get done!</h1>
            <div class="d-flex flex-wrap justify-content-center align-items-center mb-3">
                <input type="text" class="form-control me-2" style="max-width: 300px;"
                    placeholder="Search Events, Businesses or People">
                <input type="text" class="form-control me-2" style="max-width: 200px;" placeholder="Location">
                <input type="date" class="form-control me-2" style="max-width: 200px;">
                <button class="btn btn-success me-2">Search</button>
                <button class="btn btn-outline-success">+</button>
            </div>
            <p class="text-muted">Explore, schedule and share all of your favorite scheduled events from sports, movies,
                music,
                and concerts to TV shows, restaurants, and nightlife events.</p>
        </div>
    </div>
    <div class="container py-5">
            <h2 class="text-center mb-4">Event Domains</h2>
            <div class="d-flex flex-wrap gap-2 justify-content-center">
                <a href="{{ route('events.categories') }}"
                    class="btn btn-success waves-effect waves-light">All</a>
                @foreach ($categories as $item)
                <a href="{{ route('events.categories.name', $item->name) }}" class="btn btn-outline-success waves-effect waves-light">{{$item->name}}</a>
                @endforeach
                <!-- Add more categories -->
            </div>
        </div>
    <div class="row">
        <div class="col-12">
            <div class="card-deck-wrapper">
                @foreach ($categories->chunk(3) as $chunk)
                <div class="card-group">
                    @foreach ($chunk as $item)
                        <div class="card mb-4">
                            <img class="card-img-top img-fluid" src="{{ URL::asset('build/images/small/img-4.jpg') }}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">This is a longer card with supporting text below as
                                    a natural lead-in to additional content. This content is a little
                                    bit longer.</p>
                                <p class="card-text">
                                    <small class="text-muted">Last updated 3 mins ago</small>
                                </p>
                            </div>
                        </div>
                    @endforeach 
                </div>
                @endforeach
            </div>
        </div><!-- end col -->
    </div>
    <div class="container py-5">
        <h2 class="text-center mb-4">Event Categories</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($categories as $item)
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





    @endsection


    @section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection