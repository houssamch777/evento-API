@extends('layouts.master')

@section('title')
    Edit Profile
@endsection

@section('css')
    <!-- Include any additional CSS if needed for accordion or custom styles -->
    <link href="{{ URL::asset('build/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-title')
    Edit Profile
@endsection

@section('body')

    <body>
    @endsection


    @section('content')
        
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center mb-4">Edit Profile</h2>
                <div id="editProfileAccordion" class="custom-accordion">
                    <!-- Personal Information -->
                    <div class="card">
                        <a href="#personalInfoCollapse" class="text-body" data-bs-toggle="collapse" aria-expanded="true"
                            aria-controls="personalInfoCollapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                <h5 class="text-primary font-size-17 mb-0">01</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Personal Information</h5>
                                        <p class="text-muted text-truncate mb-0">Update your personal details</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div id="personalInfoCollapse" class="collapse show" data-bs-parent="#editProfileAccordion">
                            <div class="p-4 border-top">
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="{{ old('first_name', auth()->user()->first_name) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="{{ old('last_name', auth()->user()->last_name) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                                        <input type="number" class="form-control" id="date_of_birth" name="date_of_birth"
                                            value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}" min="1940"
                                            max="2024">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>
                                                Male</option>
                                            <option value="female"
                                                {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="bio" class="form-label">Bio</label>
                                        <textarea class="form-control" id="bio" name="bio">{{ old('bio', auth()->user()->bio) }}</textarea>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col text-end">
                                            <a href="{{ route('profile') }}" class="btn btn-danger"> <i
                                                    class="bx bx-x me-1"></i> Cancel </a>
                                            <button type="submit" class="btn btn-success"> <i class=" bx bx-file me-1"></i>
                                                Save </button>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="card">
                        <a href="#contactInfoCollapse" class="text-body" data-bs-toggle="collapse" aria-expanded="false"
                            aria-controls="contactInfoCollapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                <h5 class="text-primary font-size-17 mb-0">02</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Contact Information</h5>
                                        <p class="text-muted text-truncate mb-0">Add your contact details</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div id="contactInfoCollapse" class="collapse" data-bs-parent="#editProfileAccordion">
                            <div class="p-4 border-top">
                                <form action="{{ route('profile.contactUpdate') }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email', auth()->user()->email) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                            value="{{ old('phone_number', auth()->user()->phone_number) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Wilaya</label>
                                        <select class="form-control @error('location') is-invalid @enderror"
                                            name="location" id="location" required>
                                            <option value="" disabled selected>Select your wilaya</option>
                                            @foreach ($locationNames as $location)
                                                <option value="{{ $location }}"
                                                    {{ auth()->user()->location == $location ? 'selected' : '' }}
                                                    {{ old('location') == $location ? 'selected' : '' }}>
                                                    {{ $location }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col text-end">
                                            <a href="{{ route('profile') }}" class="btn btn-danger"> <i
                                                    class="bx bx-x me-1"></i> Cancel </a>
                                            <button type="submit" class="btn btn-success"> <i
                                                    class=" bx bx-file me-1"></i> Save </button>
                                        </div> <!-- end col -->
                                    </div> <!-- end row-->
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="card">
                        <a href="#socialLinksCollapse" class="text-body" data-bs-toggle="collapse" aria-expanded="false"
                            aria-controls="socialLinksCollapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">

                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                <h5 class="text-primary font-size-17 mb-0">03</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Social Links</h5>
                                        <p class="text-muted text-truncate mb-0">Add or edit your social media links</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>


                                </div>
                            </div>
                        </a>
                        <div id="socialLinksCollapse" class="collapse" data-bs-parent="#editProfileAccordion">
                            <div class="p-4 border-top">
                                <form action="{{ route('profile.updateSocialLinks') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <input type="url" class="form-control" id="facebook" name="facebook"
                                            value="{{ old('facebook', $social_links->facebook ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="twitter" class="form-label">Twitter</label>
                                        <input type="url" class="form-control" id="twitter" name="twitter"
                                            value="{{ old('twitter', $social_links->twitter ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="linkedin" class="form-label">LinkedIn</label>
                                        <input type="url" class="form-control" id="linkedin" name="linkedin"
                                            value="{{ old('linkedin', $social_links->linkedin ?? '') }}">
                                    </div>

                                    <!-- New fields for Instagram, Behance, YouTube, GitHub -->
                                    <div class="mb-3">
                                        <label for="instagram" class="form-label">Instagram</label>
                                        <input type="url" class="form-control" id="instagram" name="instagram"
                                            value="{{ old('instagram', $social_links->instagram ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="behance" class="form-label">Behance</label>
                                        <input type="url" class="form-control" id="behance" name="behance"
                                            value="{{ old('behance', $social_links->behance ?? '') }}">
                                    </div>

                                    <!-- New fields for YouTube and GitHub -->
                                    <div class="mb-3">
                                        <label for="youtube" class="form-label">YouTube</label>
                                        <input type="url" class="form-control" id="youtube" name="youtube"
                                            value="{{ old('youtube', $social_links->youtube ?? '') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="github" class="form-label">GitHub</label>
                                        <input type="url" class="form-control" id="github" name="github"
                                            value="{{ old('github', $social_links->github ?? '') }}">
                                    </div>

                                    <!-- New field for Job -->
                                    <div class="mb-3">
                                        <label for="job" class="form-label">Job</label>
                                        <input type="text" class="form-control" id="job" name="job"
                                            value="{{ old('job', auth()->user()->job ?? '') }}">
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col text-end">
                                            <a href="{{ route('profile') }}" class="btn btn-danger"> <i
                                                    class="bx bx-x me-1"></i> Cancel </a>
                                            <button type="submit" class="btn btn-success"> <i
                                                    class="bx bx-file me-1"></i> Save </button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Change Password -->
                    <div class="card">
                        <a href="#changePasswordCollapse" class="text-body" data-bs-toggle="collapse"
                            aria-expanded="false" aria-controls="changePasswordCollapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                <h5 class="text-primary font-size-17 mb-0">04</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Change Password</h5>
                                        <p class="text-muted text-truncate mb-0">Update your password</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div id="changePasswordCollapse" class="collapse" data-bs-parent="#editProfileAccordion">
                            <div class="p-4 border-top">
                                <form action="" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" id="current_password"
                                        name="current_password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password"
                                        name="confirm_password" required>
                                </div>
                                <div class="row mt-4">
                                    <div class="col text-end">
                                        <a href="{{ route('profile') }}" class="btn btn-danger"> <i
                                                    class="bx bx-x me-1"></i> Cancel </a>
                                            <button type="submit" class="btn btn-success"> <i
                                                    class="bx bx-file me-1"></i> Save </button>
                                    </div> <!-- end col -->
                                </div> <!-- end row-->
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <!-- Choices JS -->
        <script src="{{ URL::asset('build/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

        <!-- Dropzone Plugin -->
        <script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>

        <!-- App JS -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
