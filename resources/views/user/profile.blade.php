@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('page-title')
    Profile
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<style>
.border-facebook { border-color: #3b5998; }
.border-twitter { border-color: #1da1f2; }
.border-instagram { border-color: #e1306c; }
.border-linkedin { border-color: #0077b5; }
.border-github { border-color: #333; }
.border-telegram { border-color: #0088cc; }
.border-behance { border-color: #1769ff; }
.border-dribbble { border-color: #ea4c89; }
.border-youtube { border-color: #ff0000; }
.border-pinterest { border-color: #bd081c; }
.border-whatsapp { border-color: #25d366; }
.border-snapchat { border-color: #fffc00; }
.border-tiktok { border-color: #000000; }
.bg-facebook { background-color: #3b5998; }
.bg-twitter { background-color: #1da1f2; }
.bg-instagram { background-color: #e1306c; }
.bg-linkedin { background-color: #0077b5; }
.bg-github { background-color: #333; }
.bg-telegram { background-color: #0088cc; }
.bg-behance { background-color: #1769ff; }
.bg-dribbble { background-color: #ea4c89; }
.bg-youtube { background-color: #ff0000; }
.bg-pinterest { background-color: #bd081c; }
.bg-whatsapp { background-color: #25d366; }
.bg-snapchat { background-color: #fffc00; }
.bg-tiktok { background-color: #000000; }
</style>
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xxl-3">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="user-profile-img">
                            
                            <img src="{{ URL::asset('build/images/pattern-bg.jpg') }}" class="profile-img profile-foreground-img rounded-top"
                                style="height: 120px;" alt="">
                            <div class="overlay-content rounded-top">
                                <div>
                                    <div class="user-nav p-3">
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-16" href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="bx bx-dots-vertical text-white font-size-20"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <button type="button"  class="dropdown-item" href="" id="choose-file-button">change profile picture</button>
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    
                                                </div>
                                                <form action="{{ route('profile.image.upload') }}" method="POST" id="profile-image-form" enctype="multipart/form-data">
                                                    @csrf
                                                    <input id="file-upload" name="file" type="file" accept="image/*" style="display: none;" required>
                                                    <input type="hidden" id="cropped-image" name="cropped_image">
        
                                                    <!-- Modal for cropping the image -->
                                                    <div id="cropperModal" class="modal fade" tabindex="-1" aria-labelledby="cropperModalLabel" aria-hidden="true" data-bs-scroll="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="cropperModalLabel">Crop Your Image</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div>
                                                                        <img id="image-preview" style="max-width: 100%;">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" id="crop-and-submit">Crop & Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end user-profile-img -->


                        <div class="p-4 pt-0">

                            <div class="mt-n5 position-relative text-center border-bottom pb-3">
                                
                                <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                    class="avatar-xl rounded-circle img-thumbnail">

                                

                                <div class="mt-3">
                                    <h5 class="mb-1">{{Auth::user()->first_name.' '.Auth::user()->last_name  }}</h5>
                                    <p class="text-muted mb-0">
                                        @php
                                        $fullStars = floor(Auth::user()->rating_average); // Get the number of full stars
                                        $halfStar = (Auth::user()->rating_average - $fullStars) >= 0.5 ? 1 : 0; // Check if there's a half star
                                        $emptyStars = 5 - $fullStars - $halfStar; // Calculate the number of empty stars
                                    @endphp
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="bx bxs-star text-warning font-size-14"></i>
                                        @endfor
                                
                                        @if ($halfStar)
                                            <i class="bx bxs-star-half text-warning font-size-14"></i>
                                        @endif
                                
                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <i class="bx bx-star text-warning font-size-14"></i>
                                        @endfor

                                    </p>
                                </div>

                            </div>

                            <div class="table-responsive mt-3 border-bottom pb-3">
                                <table
                                    class="table align-middle table-sm table-nowrap table-borderless table-centered mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="fw-bold">Phone :</th>
                                            <td class="text-muted">{{Auth::user()->phone_number }}</td>
                                        </tr>
                                        <!-- end tr -->

                                        <tr>
                                            <th class="fw-bold">Email :</th>
                                            <td class="text-muted">{{Auth::user()->email }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">
                                                Gender :</th>
                                            <td class="text-muted">{{Auth::user()->gender }}</td>
                                        </tr>
                                        <tr>
                                            <th class="fw-bold">
                                                City :</th>
                                            <td class="text-muted">{{Auth::user()->location }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">
                                                Birth Year:</th>
                                            <td class="text-muted">{{Auth::user()->date_of_birth }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">
                                                Job Field :</th>
                                            <td class="text-muted">{{Auth::user()->job }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        
                                    </tbody><!-- end tbody -->
                                </table>
                            </div>

                            <div class="mt-3 pt-1 text-center">
                                <ul class="list-inline mb-0">

                                    @foreach (Auth::user()->portfolios as $portfolio)
                                    @php
                                        // Determine the appropriate icon and border color for the portfolio link
                                        $iconClass = 'fas fa-link'; // Default icon
                                        $borderClass = 'border-primary'; // Default border color
                                        $domainClass = 'link';
                                        foreach ($icons as $domain => $iconData) {
                                            if (strpos($portfolio->link, $domain) !== false) {
                                                $iconClass = $iconData['icon'];
                                                $borderClass = $iconData['color'];
                                                $bgClass = $iconData['bg-color'];
                                                $domainClass = $domain;
                                                break;
                                            }
                                        }
                                    @endphp
                                    <li class="list-inline-item">
                                        
                                        <a href="{{ $portfolio->link }} " target="_blank"
                                           class="social-list-item {{ $bgClass}} text-white {{ $borderClass }}">
                                            <i class="bx {{ $iconClass }}"></i>
                                        </a>
                                    </li>
                                @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-9">
                <div class="card">
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#overview" role="tab">
                                    <span>Overview</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab">
                                    <span>Messages</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#post" role="tab">
                                    <span>Post</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tab content -->
                <div class="tab-content">
                    <div class="tab-pane active" id="overview" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="font-size-16 mb-3">Summary</h5>
                                <div class="mt-3">
                                    <p class="font-size-15 mb-1">Hi my name is Jennifer Bennett.</p>
                                    <p class="font-size-15">I'm the Co-founder and Head of Design at Company agency.</p>

                                    <p class="text-muted">Been the industry's standard dummy text To an English person.
                                        Our team collaborators and clients to achieve cupidatat non proident, sunt in culpa
                                        qui officia deserunt mollit anim id est some advantage from it? But who has any
                                        right to find fault with a man who chooses to enjoy a pleasure that has no annoying
                                        consequences debitis aut rerum necessitatibus saepe eveniet ut et voluptates laborum
                                        growth.</p>

                                    <h5 class="font-size-15">Experience :</h5>
                                    <div class="row">
                                        <div class="col-4">
                                            <ul class="list-unstyled mb-0 pt-1">
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Donec
                                                    vitae libero venenatis faucibus</li>
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Quisque
                                                    rutrum aenean imperdiet</li>
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Integer
                                                    ante a consectetuer eget</li>
                                            </ul>
                                        </div>

                                        <div class="col">
                                            <ul class="list-unstyled mb-0 pt-1">
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Donec
                                                    vitae libero venenatis faucibus</li>
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Quisque
                                                    rutrum aenean imperdiet</li>
                                                <li class="py-1"><i
                                                        class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Integer
                                                    ante a consectetuer eget</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h5 class="font-size-16 mb-4">Projects</h5>
                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-1">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Projects</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Budget</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col" style="width: 120px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">01</th>
                                                    <td><a href="#" class="text-body">Brand Logo Design</a></td>
                                                    <td>
                                                        18 Jun, 2021
                                                    </td>
                                                    <td>
                                                        $523
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary-subtle text-primary font-size-12">Open</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">02</th>
                                                    <td><a href="#" class="text-body">Chat app Design</a></td>
                                                    <td>
                                                        28 May, 2021
                                                    </td>
                                                    <td>
                                                        $356
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success-subtle text-success font-size-12">Complete</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">03</th>
                                                    <td><a href="#" class="text-body">Minible Landing</a></td>
                                                    <td>
                                                        13 May, 2021
                                                    </td>
                                                    <td>
                                                        $425
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success-subtle text-success font-size-12">Complete</span>
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="text-muted dropdown-toggle font-size-18 px-2"
                                                                href="#" role="button" data-bs-toggle="dropdown"
                                                                aria-haspopup="true">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="messages" role="tabpanel">
                        <div class="card">
                            <div class="card-body">

                                <div class="py-2">

                                    <div class="mx-n4 px-4" data-simplebar style="max-height: 360px;">
                                        <div class="border-bottom pb-3">
                                            <p class="float-sm-end text-muted font-size-13">12 July, 2021</p>
                                            <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.1</div>
                                            <p class="text-muted mb-4">Maecenas non vestibulum ante, nec efficitur orci.
                                                Duis eu ornare mi, quis bibendum quam. Etiam imperdiet aliquam purus sit
                                                amet rhoncus. Vestibulum pretium consectetur leo, in mattis ipsum
                                                sollicitudin eget. Pellentesque vel mi tortor.
                                                Nullam vitae maximus dui dolor sit amet, consectetur adipiscing elit.</p>
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex">
                                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                            class="avatar-sm rounded-circle" alt="">
                                                        <div class="flex-1 ms-2 ps-1">
                                                            <h5 class="font-size-15 mb-0">Samuel</h5>
                                                            <p class="text-muted mb-0 mt-1">65 Followers, 86 Reviews</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex-shrink-0">
                                                    <ul class="list-inline product-review-link mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="#"><i class="bx bx-like"></i></a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#"><i class="bx bx-comment-dots"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="border-bottom py-3">
                                            <p class="float-sm-end text-muted font-size-13">06 July, 2021</p>
                                            <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.0</div>
                                            <p class="text-muted mb-4">Cras ac condimentum velit. Quisque vitae elit auctor
                                                quam egestas congue. Duis eget lorem fringilla, ultrices justo consequat,
                                                gravida lorem. Maecenas orci enim, sodales id condimentum et, nisl arcu
                                                aliquam velit,
                                                sit amet vehicula turpis metus cursus dolor cursus eget dui.</p>
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex">
                                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}"
                                                            class="avatar-sm rounded-circle" alt="">
                                                        <div class="flex-1 ms-2 ps-1">
                                                            <h5 class="font-size-15 mb-0">Joseph</h5>
                                                            <p class="text-muted mb-0 mt-1">85 Followers, 102 Reviews</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex-shrink-0">
                                                    <ul class="list-inline product-review-link mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="#"><i class="bx bx-like"></i></a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#"><i class="bx bx-comment-dots"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pt-3">
                                            <p class="float-sm-end text-muted font-size-13">26 June, 2021</p>
                                            <div class="badge bg-success mb-2"><i class="mdi mdi-star"></i> 4.2</div>
                                            <p class="text-muted mb-4">Aliquam sit amet eros eleifend, tristique ante sit
                                                amet, eleifend arcu. Cras ut diam quam. Fusce quis diam eu augue semper
                                                ullamcorper vitae sed massa. Mauris lacinia, massa a feugiat mattis, leo
                                                massa porta eros, sed congue arcu sem nec orci.
                                                In ac consectetur augue. Nullam pulvinar risus non augue tincidunt blandit.
                                            </p>
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <div class="d-flex">
                                                        <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}"
                                                            class="avatar-sm rounded-circle" alt="">
                                                        <div class="flex-1 ms-2 ps-1">
                                                            <h5 class="font-size-15 mb-0">Paul</h5>
                                                            <p class="text-muted mb-0 mt-1">27 Followers, 66 Reviews</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="flex-shrink-0">
                                                    <ul class="list-inline product-review-link mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="#"><i class="bx bx-like"></i></a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="#"><i class="bx bx-comment-dots"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <div class="border rounded mt-4">
                                            <form action="#">
                                                <div class="px-2 py-1 bg-light">
                                                    <div class="btn-group" role="group">
                                                        <button type="button"
                                                            class="btn btn-sm btn-link text-darbodyxt-decoration-none"><i
                                                                class="bx bx-link"></i></button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-link text-darbodyxt-decoration-none"><i
                                                                class="bx bx-smile"></i></button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-link text-darbodyxt-decoration-none"><i
                                                                class="bx bx-at"></i></button>
                                                    </div>
                                                </div>
                                                <textarea rows="3" class="form-control border-0 resize-none" placeholder="Your Message..."></textarea>
                                            </form>
                                        </div>

                                        <div class="text-end mt-3">
                                            <button type="button" class="btn btn-success w-sm text-truncate ms-2"> Send
                                                <i class="bx bx-send ms-2 align-middle"></i></button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="post" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="mx-n3 px-3" data-simplebar style="max-height: 580px;">
                                    <div class="blog-post">
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt=""
                                                    class="avatar-md rounded-circle img-thumbnail">
                                            </div>
                                            <div class="flex-1">
                                                <h5 class="font-size-16 text-truncate mb-1"><a href="#"
                                                        class="text-body">Richard Johnson</a></h5>
                                                <p class="font-size-13 text-muted mb-0">24 Mar, 2021</p>
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
                                            <img src="{{ URL::asset('build/images/post-1.jpg') }}" alt="" class="img-thumbnail">
                                        </div>
                                        <div class="pt-3">
                                            <div
                                                class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                                <div>
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item me-3">
                                                            <a href="javascript: void(0);" class="text-muted">
                                                                <i class="bx bx-purchase-tag-alt text-muted me-1"></i>
                                                                Project
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item me-3">
                                                            <a href="javascript: void(0);" class="text-muted">
                                                                <i class="bx bx-like align-middle text-muted me-1"></i> 12
                                                                Like
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
                                            <img src="{{ URL::asset('build/images/post-2.jpg') }}" alt="" class="img-thumbnail">
                                        </div>
                                        <div class="pt-3">
                                            <div
                                                class="d-flex align-items-center justify-content-between border-bottom pb-3">
                                                <div>
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item me-3">
                                                            <a href="javascript: void(0);" class="text-muted">
                                                                <i class="bx bx-purchase-tag-alt text-muted me-1"></i>
                                                                Project
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item me-3">
                                                            <a href="javascript: void(0);" class="text-muted">
                                                                <i class="bx bx-like align-middle text-muted me-1"></i> 12
                                                                Like
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
                            <!-- end card body -->
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->


        <div class="row">

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Weekly Hours</h5>
                    </div>
                    <div class="card-body">
                        <div id="overview-chart" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Team Members</h5>
                    </div>

                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <td style="width: 50px;"><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="rounded-circle avatar-sm" alt=""></td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Daniel Canales</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary-subtle text-primary font-size-11">Frontend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i
                                                class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i>
                                            Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" class="rounded-circle avatar-sm"
                                                alt=""></td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Jennifer Walker</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary-subtle text-primary font-size-11">UI / UX</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i
                                                class="mdi mdi-circle-medium font-size-18 text-warning align-middle me-1"></i>
                                            Buzy
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                    C
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Carl Mackay</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary-subtle text-primary font-size-11">Backend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i
                                                class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i>
                                            Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" class="rounded-circle avatar-sm"
                                                alt=""></td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Janice Cole</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary-subtle text-primary font-size-11">Frontend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i
                                                class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i>
                                            Online
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="avatar-sm">
                                                <span
                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                    T
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">Tony Brafford</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-primary-subtle text-primary font-size-11">Backend</a>
                                            </div>
                                        </td>
                                        <td>
                                            <i
                                                class="mdi mdi-circle-medium font-size-18 text-secondary align-middle me-1"></i>
                                            Offline
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Skill</h5>
                    </div>
                    <div class="card-body">
                        @foreach (Auth::user()->skills as $skill)
                        <a href="#" class="text-body skill-badge"
                         data-skill='@json($skill)' 
                        data-bs-toggle="modal" 
                        data-bs-target="#skillModal">
                        <div class="row align-items-center g-0 mt-3">
                            <div class="col-sm-5">
                                <p class="text-truncate mt-1 mb-0"><i class="mdi mdi-circle-medium text-primary me-2"></i>{{$skill->name}} 
                                    </p>
                            </div>

                            <div class="col-sm-7">
                                <div class="progress mt-1" style="height: 6px;">
                                    <div class="progress-bar progress-bar bg-primary" role="progressbar"
                                        style="width: 23%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="52">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </a>
                        
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="skillModal" tabindex="-1" aria-labelledby="skillModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="skillModalLabel">Skill Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p><strong>Name:</strong> <span id="skillName"></span></p>
                <p><strong>Experience:</strong> <span id="skillExperience"></span></p>
                <p><strong>Offer as Service:</strong> <span id="skillOfferAsService"></span></p>
                <p><strong>Portfolio URL:</strong> <a id="skillPortfolioUrl" href="#" target="_blank">View Portfolio</a></p>
                <p><strong>Cost:</strong> <span id="skillCost"></span></p>
                <p><strong>Cost Type:</strong> <span id="skillCostType"></span></p>
                <p><strong>Availability:</strong> 
                    <ul id="skillAvailability"></ul>
                </p>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/profile.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        

<script>
        document.addEventListener('DOMContentLoaded', function () {
        // Add event listener for skill badges
        document.querySelectorAll('.skill-badge').forEach(function (badge) {
        badge.addEventListener('click', function () {
            const skill = JSON.parse(this.getAttribute('data-skill'));


            // Populate modal with skill information
            document.getElementById('skillName').textContent = skill.name ?? 'N/A';
            document.getElementById('skillExperience').textContent = skill.experience ?? 'N/A';
            document.getElementById('skillOfferAsService').textContent = skill.offer_as_service ? 'Yes' : 'No';
            document.getElementById('skillPortfolioUrl').href = skill.portfolio_url ?? '#';
            document.getElementById('skillCost').textContent = skill.cost ?? 'N/A';
            document.getElementById('skillCostType').textContent = skill.cost_type ?? 'N/A';

            // Handle availability (stored as JSON object with days and times)
            const availabilityElement = document.getElementById('skillAvailability');
            availabilityElement.innerHTML = '';  // Clear previous content

            if (skill.availability) {


                try {
                    const availability = typeof skill.availability === 'string' ? JSON.parse(skill.availability) : skill.availability;

                    // Loop through availability days and times
                    for (const [day, time] of Object.entries(availability)) {
                        const listItem = document.createElement('li');
                        listItem.textContent = `${day}: ${time}`;
                        availabilityElement.appendChild(listItem);
                    }
                } catch (error) {
                    // Handle any JSON parsing errors
                    console.error('Error parsing availability:', error);
                }
            } else {
                // If no availability data
                const listItem = document.createElement('li');
                listItem.textContent = 'No availability information';
                availabilityElement.appendChild(listItem);
            }
        });
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    let cropper;
    const fileUpload = document.getElementById('file-upload');
    const imagePreview = document.getElementById('image-preview');
    const cropperModal = new bootstrap.Modal(document.getElementById('cropperModal'));
    const croppedImageInput = document.getElementById('cropped-image');
    const cropAndSubmitBtn = document.getElementById('crop-and-submit');

    // Trigger file input when clicking a button
    document.getElementById('choose-file-button').addEventListener('click', function () {
        fileUpload.click();
    });

    // When user selects a file
    fileUpload.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;

                // Open modal for cropping
                cropperModal.show();

                // Initialize Cropper.js
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(imagePreview, {
                    aspectRatio: 1, // You can change this based on the desired aspect ratio
                    viewMode: 1,
                    minContainerWidth: 300,
                    minContainerHeight: 300,
                    responsive: true,
                });
            };
            reader.readAsDataURL(file);
        }
    });

    // When the user clicks "Crop & Submit"
    cropAndSubmitBtn.addEventListener('click', function (event) {
        event.preventDefault();

        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300, // You can set this to your desired image size
            });

            // Convert the canvas to a Base64-encoded image and set it as the value of the hidden input
            canvas.toBlob(function (blob) {
                const reader = new FileReader();
                reader.onloadend = function () {
                    croppedImageInput.value = reader.result; // Set the cropped image as a base64 string

                    // Submit the form
                    document.getElementById('profile-image-form').submit();
                };
                reader.readAsDataURL(blob);
            });
        }
    });
});

</script>
    @endsection
