@extends('layouts.layout-horizontal')
@section('title', 'Event Details')
@section('page-title', 'Event Details')
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection
@section('body')

    <body data-layout="horizontal" data-layout-size="boxed" data-layout-scrollable="false">
    @endsection
    @section('content')

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="user-profile-img">
                            <img src="{{ URL::asset($event->visualIdentity->banner_url) }}"
                                class="profile-img profile-foreground-img rounded-top" alt="">
                        </div>
                        <!-- end user-profile-img -->


                        <div class="p-4 pt-0">

                            <div class="mt-n5 position-relative text-center border-bottom pb-3">
                                <img src="{{asset($event->visualIdentity->logo_url)}}" alt=""
                                    class="avatar-xl rounded-circle img-thumbnail">

                                <div class="mt-3">
                                    <h1 class="mb-1">{{ $event->name .$event->organizer->profile_picture }}</h1>
                                    <p class="text-muted mb-0">
                                        by <span>{{ $event->organizer->name }}</span>
                                    </p>

                                    <p class="text-muted mb-0">
                                        {{-- Full stars --}}
                                        @for ($i = 0; $i < $fullStars; $i++) <i class="bx bxs-star text-warning"></i>
                                            @endfor
                                    
                                            {{-- Half star --}}
                                            @if ($halfStar)
                                            <i class="bx bxs-star-half text-warning"></i>
                                            @endif
                                    
                                            {{-- Empty stars --}}
                                            @for ($i = 0; $i < $emptyStars; $i++) <i class="bx bx-star text-warning"></i>
                                                @endfor
                                    </p>
                                </div>

                            </div>
                            <div class="p-3 mt-3">
                                <div class="row text-center">
                                    <div class="col-12 border-end">
                                        <div class="p-1">
                                            <h5 class="mb-1">Description</h5>
                                            <p class="text-muted mb-0">{{ $event->description }}</p>
                                        </div>
                                        <div class="p-1 mt-4">
                                            <h5 class="mb-4">Details :</h5>
                                            <h3 class="mb-2 fw-bold font-size-14 ">Start In : <span class="text-muted">
                                                    {{ $event->start_date }}</span></h3>
                                            <h3 class="mb-2 fw-bold font-size-14">End In : <span class="text-muted ">
                                                    {{ $event->end_date }}</span></h3>
                                            <h3 class="mb-2 fw-bold font-size-14">Type : <span class="text-muted "">
                                                    {{ $event->type }}</span></h3>
                                            <h3 class=" mb-2 fw-bold font-size-14">End In : <span class="text-muted ">
                                                    {{ $event->end_date }}</span></h3>
                                            <h3 class="mb-2 fw-bold font-size-14">Is Certificated : <span
                                                    class="{{ $event->certificate ? 'badge rounded-pill bg-success' : 'badge rounded-pill bg-danger' }}">
                                                    {{ $event->certificate ? 'Yes' : 'No' }}</span></h3>
                                            <h3 class="mb-2 fw-bold font-size-14">Privacy : <span
                                                    class="{{ $event->privacy ? 'badge rounded-pill bg-success' : 'badge rounded-pill bg-danger' }}">
                                                    {{ $event->privacy ? 'private' : 'public' }}</span></h3>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="my-3 pt-1 text-center">
                                <h5 class="mb-4">Categories :</h5>
                                <ul class="list-inline mb-0">
                                    @foreach ($event->categories as $item)
                                        <li class="list-inline-item">
                                            <a href="{{ route('events.categories.name', $item->name) }}"
                                                class="btn btn-success  fw-bold font-size-14">
                                                {{ $item->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <h5 class="my-4">Domains :</h5>
                                <ul class="list-inline mb-0">
                                    @foreach ($event->domains as $item)
                                        <li class="list-inline-item">
                                            <a href="{{ route('events.categories.name', $item->name) }}"
                                                class="btn btn-success  fw-bold font-size-14">
                                                {{ $item->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-3 pt-1 text-center">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="javascript:void()"
                                            class="social-list-item bg-primary text-white border-primary">
                                            <i class="bx bxl-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                            <i class="bx bxl-linkedin"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript:void()"
                                            class="social-list-item bg-danger text-white border-danger">
                                            <i class="bx bxl-google"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Event Time Line</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="timeline">
                                    <div class="timeline-container">
                                        <div class="timeline-end">
                                            <p>Start</p>
                                        </div>
                                        <div class="timeline-continue">
                                            @foreach ($event->timeLine as $index => $time)
                                                @if ($index % 2 == 0)
                                                    <div class="row timeline-right">
                                                        <div class="col-md-6">
                                                            <div class="timeline-icon">
                                                                <i class="bx bx-briefcase-alt-2 text-primary h2 mb-0"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="timeline-box">
                                                                <div class="timeline-date bg-primary text-center rounded">
                                                                    <h3 class="text-white mb-0 font-size-20">
                                                                        {{ \Carbon\Carbon::parse($time->start_time)->format('d') }}
                                                                    </h3>
                                                                    <p class="mb-0 text-white-50">
                                                                        {{ \Carbon\Carbon::parse($time->start_time)->format('F') }}
                                                                    </p>
                                                                </div>
                                                                <div class="event-content">
                                                                    <div class="timeline-text">
                                                                        <h3 class="font-size-17">{{ $time->title }}</h3>
                                                                        <p class="mb-0 mt-2 pt-1 text-muted">
                                                                            {{ $time->description }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row timeline-left">
                                                        <div class="col-md-6 d-md-none d-block">
                                                            <div class="timeline-icon">
                                                                <i class="bx bx-user-pin text-primary h2 mb-0"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="timeline-box">
                                                                <div class="timeline-date bg-primary text-center rounded">
                                                                    <h3 class="text-white mb-0 font-size-20">
                                                                        {{ \Carbon\Carbon::parse($time->start_time)->format('d') }}
                                                                    </h3>
                                                                    <p class="mb-0 text-white-50">
                                                                        {{ \Carbon\Carbon::parse($time->start_time)->format('F') }}
                                                                    </p>
                                                                </div>
                                                                <div class="event-content">
                                                                    <div class="timeline-text">
                                                                        <h3 class="font-size-17">{{ $time->title }}</h3>
                                                                        <p class="mb-0 mt-2 pt-1 text-muted">
                                                                            {{ $time->description }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 d-md-block d-none">
                                                            <div class="timeline-icon">
                                                                <i class="bx bx-user-pin text-primary h2 mb-0"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="timeline-start">
                                            <p>End</p>
                                        </div>
                                        <div class="timeline-launch">
                                            <div class="timeline-box">
                                                <div class="timeline-text">
                                                    <h3 class="font-size-17">Launched our eveny on
                                                        {{ $event->start_date }} to
                                                        {{ $event->start_date }}</h3>
                                                    <p class="text-muted mb-0">your welcome.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Event Venue</h4>
                        <p class="card-title-desc">Example of Venue Text descrption.</p>
                    </div>
                    <div class="card-body">
                        <div id="map" style="height: 1080px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="">
                                    <h5 class="font-size-14 mb-3">Reviews : </h5>
                                    <div class="text-muted mb-3">
                                        <span class="badge bg-success font-size-14 me-1"><i class="mdi mdi-star"></i>
                                            {{ $event->averageRating
                                                ? number_format($event->average_rating, 1)
                                                : 'Not
                                                                                    reviewed yet' }}</span>
                                        {{ $reviews->total() }} Reviews
                                    </div>

                                    <div class="border py-4 rounded">

                                        <div class="px-4" data-simplebar style="max-height: 360px;">
                                            <div id="reviewsContainer">
                                                @foreach ($reviews as $review)
                                                    <div class="border-bottom pb-3 review-item">
                                                        <p class="float-sm-end text-muted font-size-13">
                                                            {{ $review->created_at->format('d M, Y') }}</p>
                                                        <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i>
                                                            {{ number_format($review->rating, 1) }}</div>
                                                        <p class="text-muted mb-4">{{ $review->comment }}</p>
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex">
                                                                    <img src="{{ $review->user->profile_picture
                                                                        ? (filter_var($review->user->profile_picture, FILTER_VALIDATE_URL)
                                                                            ? $review->user->profile_picture
                                                                            : asset('storage/' . $review->user->profile_picture))
                                                                        : URL::asset('build/images/users/avatar-3.jpg') }}"
                                                                        class="avatar-sm rounded-circle" alt="">
                                                                    <div class="flex-1 ms-2 ps-1">
                                                                        <h5 class="font-size-16 mb-0">
                                                                            {{ $review->user->name }}
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="text-center mt-3">
                                                @if ($reviews->hasMorePages())
                                                    <button id="loadMoreReviews" class="btn btn-link">Show More</button>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="px-4 mt-2">
                                            <form action="{{ route('event_reviews.store', $event->id) }}" method="POST"
                                                id="reviewForm">
                                                @csrf
                                                <div class="border rounded mt-4">
                                                    @if ($userReview)
                                                        @method('PUT')
                                                        <!-- If the review exists, use PUT to update -->
                                                        <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..."
                                                            name="review_message">{{ $userReview->message }}</textarea>
                                                    @else
                                                        <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..."
                                                            name="review_message"></textarea>
                                                    @endif

                                                    <!-- Rate.js Rating -->
                                                    <div id="rating"
                                                        data-rate-value="{{ $userReview ? $userReview->rating : 5 }}">
                                                    </div>
                                                    <input type="hidden" name="rating" id="ratingInput"
                                                        value="{{ $userReview ? $userReview->rating : 5 }}">
                                                </div>

                                                <div class="text-end mt-3">
                                                    @if ($userReview)
                                                        <button type="submit" form="reviewForm"
                                                            class="btn btn-warning w-sm text-truncate ms-2">
                                                            Update Review <i class="bx bx-refresh ms-2 align-middle"></i>
                                                        </button>
                                                    @else
                                                        <button type="submit" form="reviewForm"
                                                            class="btn btn-success w-sm text-truncate ms-2">
                                                            Send Review <i class="bx bx-send ms-2 align-middle"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endsection


    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const loadMoreButton = document.getElementById('loadMoreReviews');
                let currentPage = 1;

                loadMoreButton?.addEventListener('click', function() {
                    currentPage++;
                    const url = "{{ route('events.reviews.load', $event->id) }}?page=" + currentPage;

                    loadMoreButton.textContent = "Loading...";

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            if (data.data.length > 0) {
                                const reviewsContainer = document.getElementById('reviewsContainer');

                                data.data.forEach(review => {
                                    const reviewHtml = `
                                <div class="border-bottom pb-3 review-item">
                                    <p class="float-sm-end text-muted font-size-13">${new Date(review.created_at).toLocaleDateString()}</p>
                                    <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i>
                                        ${review.rating.toFixed(1)}</div>
                                    <p class="text-muted mb-4">${review.comment || 'No comment provided.'}</p>
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <div class="d-flex">
                                                <img src="${review.user?.profile_picture 
                                                    ? `/storage/${review.user.profile_picture}` 
                                                    : '/build/images/users/avatar-3.jpg'}"
                                                    class="avatar-sm rounded-circle" alt="">
                                                <div class="flex-1 ms-2 ps-1">
                                                    <h5 class="font-size-16 mb-0">
                                                        ${review.user?.name || ''} 
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                                    reviewsContainer.insertAdjacentHTML('beforeend', reviewHtml);
                                });

                                if (!data.next_page_url) {
                                    loadMoreButton.remove();
                                } else {
                                    loadMoreButton.textContent = "Show More";
                                }
                            } else {
                                loadMoreButton.remove();
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching more reviews:', error);
                            loadMoreButton.textContent = "Show More";
                        });
                });
            });
        </script>

        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <!-- rater-js plugin -->
        <script src="{{ URL::asset('build/libs/rater-js/index.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Rate.js
                var basicRating = raterJs({
                    starSize: 22,
                    rating: 3,
                    element: document.querySelector("#rating"),
                    rateCallback: function rateCallback(rating, done) {
                        this.setRating(rating);
                        document.getElementById('ratingInput').value = rating;
                        done();
                    }
                });

            });
        </script>
        <script>
            var map = L.map('map').setView([51.505, -0.09], 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([51.5, -0.09]).addTo(map)
                .bindPopup('A pretty CSS popup.<br> Easily customizable.')
                .openPopup();
        </script>
    @endsection
