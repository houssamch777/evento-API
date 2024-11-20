@extends('layouts.layout-horizontal')

@section('title')
    Home
@endsection
@section('css')
    <!-- Load CSS via Vite -->
    @vite(['resources/scss/app.scss', 'resources/scss/icons.scss'])
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/nouislider/nouislider.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Home
@endsection
@section('body')

    <body data-layout="horizontal" data-layout-size="boxed" data-layout-scrollable="true">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="z-0 card sticky-top">

                    <div class="card-header bg-transparent border-bottom">
                        <h5 class="mb-0">Filters</h5>
                    </div>

                    <div>
                        <div class="custom-accordion p-4">
                            <h5 class="font-size-14 mb-0"><a href="#categories-collapse" class="text-body d-block"
                                    data-bs-toggle="collapse">Categories <i
                                        class="mdi mdi-chevron-up float-end accor-down-icon"></i></a></h5>

                            <div class="collapse show mt-4" id="categories-collapse">
                                <div class="categories-group-card">
                                    <a href="#collapseOne" class="text-body fw-semibold pb-3 d-block collapsed"
                                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                        <i class="bx bx-desktop font-size-16 align-middle me-2"></i>
                                        Conferences
                                        <i class="mdi mdi-chevron-up float-end accor-down-icon"></i>
                                    </a>
                                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                                        <div class="card p-2 border shadow-none">
                                            <ul class="list-unstyled categories-list mb-0">
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Technology</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Education</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Business &
                                                        Finance</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Health &
                                                        Medicine</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Social &
                                                        Political Issues</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Environment
                                                        & Sustainability</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="categories-group-card">
                                    <a href="#collapseTwo" class="text-body fw-semibold pb-3 d-block collapsed"
                                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="bx bx-trophy font-size-16 align-middle me-2"></i>
                                        Competitions
                                        <i class="mdi mdi-chevron-up float-end accor-down-icon"></i>
                                    </a>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card p-2 border shadow-none">
                                            <ul class="list-unstyled categories-list mb-0">
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Sports</a>
                                                </li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        E-sports</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Academic</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Creative</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Startup
                                                        Pitching</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Coding
                                                        Hackathons</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="categories-group-card">
                                    <a href="#collapseThree" class="text-body fw-semibold pb-3 d-block collapsed"
                                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="bx bx-book-open font-size-16 align-middle me-2"></i>
                                        Workshops
                                        <i class="mdi mdi-chevron-up float-end accor-down-icon"></i>
                                    </a>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card p-2 border shadow-none">
                                            <ul class="list-unstyled categories-list mb-0">
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Skills
                                                        Development</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Coding &
                                                        Programming</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Design &
                                                        Creativity</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Marketing &
                                                        Sales</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Public
                                                        Speaking</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Leadership
                                                        & Management</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="categories-group-card">
                                    <a href="#collapseFour" class="text-body fw-semibold pb-3 d-block collapsed"
                                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseFour">
                                        <i class="bx bxs-group font-size-16 align-middle me-2"></i>
                                        Meetings
                                        <i class="mdi mdi-chevron-up float-end accor-down-icon"></i>
                                    </a>
                                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                                        <div class="card p-2 border shadow-none">
                                            <ul class="list-unstyled categories-list mb-0">
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Networking Events</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Business
                                                        Meetings</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Club/Group Gatherings</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Board
                                                        Meetings</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Annual
                                                        General Meetings</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="categories-group-card">
                                    <a href="#collapseFive" class="text-body fw-semibold pb-3 d-block collapsed"
                                        data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseFive">
                                        <i class="bx bx-microphone font-size-16 align-middle me-2"></i>
                                        Seminars
                                        <i class="mdi mdi-chevron-up float-end accor-down-icon"></i>
                                    </a>
                                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                                        <div class="card p-2 border shadow-none">
                                            <ul class="list-unstyled categories-list mb-0">
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Motivational Talks</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Industry
                                                        Insights</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i>
                                                        Educational Seminars</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Health
                                                        Awareness</a></li>
                                                <li><a href="#"><i class="mdi mdi-circle-medium me-1"></i> Career
                                                        Guidance</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Repeat the structure for the remaining categories -->

                            </div>

                        </div>

                        <div class="p-4 border-top">
                            <div>
                                <h5 class="font-size-14 mb-3">Price</h5>
                                <div id="priceslider" class="mb-4"></div>
                            </div>
                        </div>

                        <div class="custom-accordion">



                            <div class="p-4 border-top">
                                <div>
                                    <h5 class="font-size-14 mb-0"><a href="#filterproduct-color-collapse"
                                            class="text-body d-block" data-bs-toggle="collapse">Customer
                                            Rating <i class="mdi mdi-chevron-up float-end accor-down-icon"></i></a>
                                    </h5>

                                    <div class="collapse show" id="filterproduct-color-collapse">
                                        <div class="mt-4">
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productratingRadio1" name="productratingRadio1"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="productratingRadio1">4 <i
                                                        class="mdi mdi-star text-warning"></i> &
                                                    Above</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productratingRadio2" name="productratingRadio1"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="productratingRadio2">3 <i
                                                        class="mdi mdi-star text-warning"></i> &
                                                    Above</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productratingRadio3" name="productratingRadio1"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="productratingRadio3">2 <i
                                                        class="mdi mdi-star text-warning"></i> &
                                                    Above</label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input type="radio" id="productratingRadio4" name="productratingRadio1"
                                                    class="form-check-input">
                                                <label class="form-check-label" for="productratingRadio4">1 <i
                                                        class="mdi mdi-star text-warning"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="mb-3">
                            <a href="#"
                                class="btn btn-success waves-effect waves-light position-relative top-50 start-50 translate-middle"
                                data-bs-toggle="modal" data-bs-target="#createPostModal">
                                <h5 class="font-size-15 text-uppercase text-white">New Post</h5>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-body p-0">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators list-unstyled">
                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img class="d-block img-fluid mx-auto"
                                        src="{{ URL::asset('build/images/events/img-6.jpg') }}" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid mx-auto"
                                        src="{{ URL::asset('build/images/events/img-6.jpg') }}" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block img-fluid mx-auto"
                                        src="{{ URL::asset('build/images/events/img-6.jpg') }}" alt="Third slide">
                                </div>
                            </div>

                        </div><!-- end carousel -->
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="mx-n3 px-3" data-simplebar>
                            <div class="blog-post mt-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                            class="avatar-md rounded-circle img-thumbnail">
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="font-size-16 text-truncate mb-1"><a href="#"
                                                class="text-body">James Delgado</a></h5>
                                        <p class="font-size-13 text-muted mb-0">29 July, 2021</p>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <p class="text-muted">Aenean ornare mauris velit. Donec imperdiet, massa sit
                                        amet porta maximus, massa justo faucibus nisi,
                                        eget accumsan nunc ipsum nec lacus. Etiam dignissim turpis sit amet lectus
                                        porttitor eleifend. Maecenas ornare molestie metus eget feugiat.
                                        Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>

                                </div>
                                <div class="position-relative mt-3">
                                    <img src="{{ URL::asset('build/images/post-2.jpg') }}" alt=""
                                        class="img-thumbnail">
                                </div>
                                <div class="pt-3">
                                    <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                        <div>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item me-3">
                                                    <a href="javascript: void(0);" class="text-muted">
                                                        <i class="bx bx-purchase-tag-alt text-muted me-1"></i>
                                                        Events rate: 3.75<i class="mdi mdi-star text-warning"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                                alt="" class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                alt="" class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ms-2">
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-sm waves-effect">Share
                                                        <i class="bx bx-share-alt align-middle ms-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end blog post -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mx-n3 px-3" data-simplebar>
                            <div class="blog-post mt-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                            class="avatar-md rounded-circle img-thumbnail">
                                    </div>
                                    <div class="flex-1">
                                        <h5 class="font-size-16 text-truncate mb-1"><a href="#"
                                                class="text-body">James Delgado</a></h5>
                                        <p class="font-size-13 text-muted mb-0">29 July, 2021</p>
                                    </div>
                                </div>
                                <div class="pt-3">
                                    <p class="text-muted">Aenean ornare mauris velit. Donec imperdiet, massa sit
                                        amet porta maximus, massa justo faucibus nisi,
                                        eget accumsan nunc ipsum nec lacus. Etiam dignissim turpis sit amet lectus
                                        porttitor eleifend. Maecenas ornare molestie metus eget feugiat.
                                        Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>

                                </div>
                                <div class="position-relative mt-3">
                                    <img src="{{ URL::asset('build/images/post-2.jpg') }}" alt=""
                                        class="img-thumbnail">
                                </div>
                                <div class="pt-3">
                                    <div class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                        <div>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item me-3">
                                                    <a href="javascript: void(0);" class="text-muted">
                                                        <i class="bx bx-purchase-tag-alt text-muted me-1"></i>
                                                        Events rate: 3.75<i class="mdi mdi-star text-warning"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                                alt="" class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                alt="" class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ms-2">
                                                    <button type="button"
                                                        class="btn btn-outline-primary btn-sm waves-effect">Share
                                                        <i class="bx bx-share-alt align-middle ms-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end blog post -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPostModalLabel">Create New Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter post title" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" id="content" class="form-control" rows="5" placeholder="Write your content..."
                                    required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="tags" class="form-label">Tags</label>
                                <select name="tags[]" id="tags" class="form-control" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- Load JS via Vite -->
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
        <!-- nouisliderribute js -->
        <script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script>

        <script src="{{ URL::asset('build/libs/wnumb/wNumb.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/product-filter-range.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        <!-- rater-js plugin -->
        <script src="{{ URL::asset('build/libs/rater-js/index.js') }}"></script>
        <!-- rating init -->
        <script src="{{ URL::asset('build/js/pages/rating.init.js') }}"></script>
    @endsection
