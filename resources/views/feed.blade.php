@extends('layouts.master-without-nav')

@section('title')
feed
@endsection
@section('css')
<!-- Load CSS via Vite -->
@vite(['resources/scss/app.scss', 'resources/scss/icons.scss'])
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/nouislider/nouislider.min.css') }}" rel="stylesheet" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('page-title')
Feed
@endsection
@section('body')

<body data-layout="horizontal" data-layout-size="boxed" data-layout-scrollable="false">
    @endsection
    @section('content')
    <div class="row mt-2">
        <div class="col-xl-3 col-lg-4 ">
            <div class="card  position-sticky">
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
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-8">
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
            <div id="masonry-grid" class="row" data-masonry='{"percentPosition": true }'>
                @foreach ($posts as $post)
                <x-post :post="$post" />
                @endforeach
            </div>


        </div>

        <div class="col-xl-3 col-lg-4">
            <div class="z-0 card sticky-top ">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="mb-0">Tags</h5>
                </div>

                <div>

                </div>
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
    <!-- Card Masonry -->
    <script src="{{ URL::asset('build/libs/masonry-layout/masonry.pkgd.min.js') }}"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>

    <!-- rater-js plugin -->
    <script src="{{ URL::asset('build/libs/rater-js/index.js') }}"></script>
    <!-- rating init -->
    <script src="{{ URL::asset('build/js/pages/rating.init.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
                const grid = document.querySelector('#masonry-grid');

                if (grid) {
                    // Wait for images to load
                    imagesLoaded(grid, () => {
                        new Masonry(grid, {
                            itemSelector: '#post',
                            percentPosition: true,
                        });
                    });
                }
            });
    </script>

    <script>
        window.page = {{ $posts->currentPage() }};
    </script>
    <!-- Add this in the <head> section of your Blade template or just before the closing </body> tag -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        let page = 1; // Start with the first page
            let loading = false; // Flag to prevent multiple simultaneous requests

            window.addEventListener('scroll', function() {
                if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 100) {
                    // User reached the bottom, let's load more posts
                    loadMorePosts();
                }
            });

            function loadMorePosts() {
                if (loading) return; // Prevent multiple requests
                loading = true;

                // Increment page number for the next batch of posts
                page++;

                axios.get(`/api/${page}`)
                    .then(response => {

                        const posts = response.data;
                        if (posts.length > 0) {
                            // Append new posts to the existing posts container
                            const postsContainer = document.getElementById('masonry-grid');
                            // For each post, send the data to the backend to render the post as HTML

                            posts.forEach(post => {
                                // Send the post data to the backend to render the HTML
                                const postElement = document.createElement('div');
                                postElement.id = 'post';

                                // Build the inner HTML dynamically based on the provided structure
                                postElement.innerHTML = `
                                <div class="col-sm-6 col-lg-12">
                                    <div class="card mb-2">
                                        ${post.image_url ? `<img src="${post.image_url}" class="card-img-top" alt="${post.title}">` : ''}
                                        <div class="card-body">
                                            <h5 class="card-title">${post.title}</h5>
                                            <p class="card-text">${post.content.substring(0, 100)}...</p>
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <!-- Likes Section -->
                                                <button type="button" class="btn btn-outline-primary btn-sm">
                                                    <i class="fa fa-thumbs-up"></i> ${post.likes.length} Likes
                                                </button>
                                                <!-- Share Button -->
                                                <button type="button" class="btn btn-outline-secondary btn-sm">
                                                    <i class="fa fa-share"></i> Share
                                                </button>
                                            </div>
                                            <p class="card-text mt-3"><small class="text-muted">Last updated</small></p>
                                        </div>
                                    </div>
                                </div>
    `;

                                // Append the new post element to the posts container
                                postsContainer.appendChild(postElement);
                            });
                            loading = false; // Reset loading flag

                        }
                    })
                    .catch(error => {
                        console.error('Error loading posts:', error);
                        loading = false;
                    });
            }
    </script>
    @endsection