@extends('layouts.master')
@section('title')
    Event Asset Detail
@endsection
@section('css')
    <!-- swiper css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
@endsection
@section('page-title')
    Event Asset Detail
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-xl-4">
                                <div class="product-detail mt-3" dir="ltr">
                                    <div class="rounded border overflow-hidden position-relative" style="height: 300px;">
                                        <div class="p-3 h-100 d-flex justify-content-center align-items-center">
                                            <img src="{{ URL::asset($asset->image_url) }}"
                                                class="img-fluid h-100 object-fit-cover" alt="Responsive image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="mt-3 mt-xl-3 ps-xl-5">
                                    <h4 class="font-size-20 mb-3"><a href=""
                                            class="text-body">{{ $asset->name }}</a></h4>

                                    <p class="text-muted mb-0">
                                        {{-- Full stars --}}
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="bx bxs-star text-warning"></i>
                                        @endfor

                                        {{-- Half star --}}
                                        @if ($halfStar)
                                            <i class="bx bxs-star-half text-warning"></i>
                                        @endif

                                        {{-- Empty stars --}}
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="bx bx-star text-warning"></i>
                                        @endfor
                                    </p>

                                    <div class="text-muted mt-2">
                                        <span class="badge bg-success font-size-14 me-1"><i class="mdi mdi-star"></i>
                                            {{ number_format($asset->averageRating(), 1) }}</span>
                                        {{ $asset->reviews()->count() }} Reviews
                                    </div>

                                    <h2 class="text-primary mt-4 py-2 mb-0">{{ $asset->daily_rental_price }} DA

                                        <span class="badge bg-success font-size-12 ms-1">per day</span>
                                    </h2>


                                    <div>
                                        <div class="row">
                                            <div class="mt-3">
                                                <h5 class="font-size-14">Description :</h5>
                                                <div>
                                                    {{ $asset->description }}
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-sm-8">
                                                <div class="row text-center mt-4 pt-1">
                                                    <div class="col-sm-6">
                                                        <div class="d-grid">
                                                            <button type="button"
                                                                class="btn btn-primary waves-effect waves-light mt-2 me-1">
                                                                <i class="bx bx-cart me-2"></i> Rent for Event
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="d-grid">
                                                            <button type="button"
                                                                class="btn btn-light waves-effect  mt-2 waves-light">
                                                                <i class="bx bx-shopping-bag me-2"></i>Buy now
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="">
                                    <h5 class="font-size-14 mb-3">Reviews : </h5>
                                    <div class="text-muted mb-3">
                                        <span class="badge bg-success font-size-14 me-1"><i class="mdi mdi-star"></i>
                                            4.2</span> 234 Reviews
                                    </div>

                                    <div class="border py-4 rounded">

                                        <div class="px-4" data-simplebar style="max-height: 360px;">
                                            @forelse($asset->reviews as $review)
                                                <!-- Loop through reviews -->
                                                <div class="border-bottom pb-3">
                                                    <p class="float-sm-end text-muted font-size-13">
                                                        {{ $review->created_at->format('d M, Y') }}</p>
                                                    <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i>
                                                        {{ number_format($review->rating, 1) }}</div>
                                                    <p class="text-muted mb-4">{{ $review->comment }}</p>
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex">
                                                                <img src="{{ $review->user->profile_picture ? asset('storage/' . $review->user->profile_picture) : URL::asset('build/images/users/avatar-3.jpg') }}"
                                                                    class="avatar-sm rounded-circle" alt="">
                                                                <div class="flex-1 ms-2 ps-1">
                                                                    <h5 class="font-size-16 mb-0">
                                                                        {{ $review->user->first_name . ' ' . $review->user->first_name }}
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <p>No reviews yet.</p> <!-- Message when there are no reviews -->
                                            @endforelse
                                        </div>

                                        <div class="px-4 mt-2">
                                            <form action="{{ route('reviews.storeOrUpdate', ['assetId' => $asset->id]) }}"
                                                method="POST" id="reviewForm">
                                                @csrf
                                                <div class="border rounded mt-4">
                                                    @if ($userReview)
                                                        @method('PUT') <!-- If the review exists, use PUT to update -->
                                                        <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..." name="review_message">{{ $userReview->message }}</textarea>
                                                    @else
                                                        <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..." name="review_message"></textarea>
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

                            <div class="col-4">
                                <div class="product-desc">
                                    <h5 class="font-size-14 mb-3">Product description : </h5>
                                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="specifi-tab" data-bs-toggle="tab"
                                                href="#specifi" role="tab">Specifications</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content border border-top-0 p-4">

                                        <div class="tab-pane fade show active" id="specifi" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap mb-0">
                                                    <tbody>
                                                        @if ($asset->assetable)
                                                            <!-- Check if assetable is not null -->
                                                            @if (class_basename($asset->assetable_type) == 'Room')
                                                                <!-- If assetable type is 'Room' -->
                                                                <tr>
                                                                    <th scope="row" style="width: 50%;">Room Type :
                                                                    </th>
                                                                    <td>{{ $asset->assetable->room_type }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Capacity :</th>
                                                                    <td>{{ $asset->assetable->capacity }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Location :</th>
                                                                    <td>{{ $asset->assetable->location }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Price per Hour :</th>
                                                                    <td>{{ $asset->assetable->price_per_hour }}</td>
                                                                </tr>
                                                            @elseif(class_basename($asset->assetable_type) == 'Equipment')
                                                                <!-- If assetable type is 'Equipment' -->
                                                                <tr>
                                                                    <th scope="row" style="width: 50%;">Equipment Type
                                                                        :</th>
                                                                    <td>{{ $asset->assetable->equipment_type }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Category :</th>
                                                                    <td>{{ $asset->assetable->category->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Available Quantity :</th>
                                                                    <td>{{ $asset->assetable->available_quantity }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Condition :</th>
                                                                    <td>{{ $asset->assetable->condition }}</td>
                                                                </tr>
                                                            @elseif(class_basename($asset->assetable_type) == 'Furniture')
                                                                <!-- If assetable type is 'Furniture' -->
                                                                <tr>
                                                                    <th scope="row" style="width: 50%;">Furniture Type
                                                                        :</th>
                                                                    <td>{{ $asset->assetable->furniture_type }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Material :</th>
                                                                    <td>{{ $asset->assetable->material }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Dimensions :</th>
                                                                    <td>{{ $asset->assetable->dimensions }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Color :</th>
                                                                    <td>{{ $asset->assetable->color }}</td>
                                                                </tr>
                                                            @elseif(class_basename($asset->assetable_type) == 'Transportation')
                                                                <!-- If assetable type is 'Transportation' -->
                                                                <tr>
                                                                    <th scope="row" style="width: 50%;">Vehicle Type :
                                                                    </th>
                                                                    <td>{{ $asset->assetable->vehicle_type }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Brand :</th>
                                                                    <td>{{ $asset->assetable->brand }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Capacity :</th>
                                                                    <td>{{ $asset->assetable->capacity }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Fuel Type :</th>
                                                                    <td>{{ $asset->assetable->fuel_type }}</td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td colspan="2">No details available for this asset
                                                                        type.{{ $asset->assetable_type }}</td>
                                                                </tr>
                                                            @endif
                                                        @else
                                                            <tr>
                                                                <td colspan="2">No asset details available. </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
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
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- swiper js -->
        <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
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
        <script src="{{ URL::asset('build/js/pages/ecommerce-product-detail.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
