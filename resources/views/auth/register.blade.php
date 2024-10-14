@extends('layouts.master-without-nav')
@section('title')
    Register
@endsection
@section('page-title')
    Register
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="authentication-bg min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="d-flex flex-column min-vh-100 px-3 pt-4">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-lg-6 col-xl-5">

                            <div class="mb-4 pb-2">
                                <a href="index" class="d-block auth-logo">
                                    <img src="{{URL::asset('build/images/logo-dark.png') }}" alt="" height="30"
                                        class="auth-logo-dark me-start">
                                    <img src="{{URL::asset('build/images/logo-light.png') }}" alt="" height="30"
                                        class="auth-logo-light me-start">
                                </a>
                            </div>

                            <div class="card">
                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <h5>Register Account</h5>
                                        <p class="text-muted">Get your free webadmin account now.</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <form method="POST" action="{{ route('register') }}" class="auth-input">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="first_name" class="form-label">First name <span class="text-danger">*</span></label>
                                                <input id="first_name" type="text"
                                                       class="form-control @error('first_name') is-invalid @enderror" 
                                                       name="first_name" value="{{ old('first_name') }}" required 
                                                       autocomplete="first_name" autofocus placeholder="Enter first name">
                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        
                                            <div class="mb-2">
                                                <label for="last_name" class="form-label">Last name <span class="text-danger">*</span></label>
                                                <input id="last_name" type="text"
                                                       class="form-control @error('last_name') is-invalid @enderror"
                                                       name="last_name" value="{{ old('last_name') }}" required 
                                                       autocomplete="last_name" placeholder="Enter last name">
                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        
                                            <div class="mb-2">
                                                <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                <input id="phone_number" type="text"
                                                       class="form-control @error('phone_number') is-invalid @enderror"
                                                       name="phone_number" value="{{ old('phone_number') }}" required 
                                                       autocomplete="phone_number" placeholder="Enter phone number">
                                                @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        
                                            <div class="mb-2">
                                                <label for="location" class="form-label">Location <span class="text-danger">*</span></label>
                                                <input id="location" type="text"
                                                       class="form-control @error('location') is-invalid @enderror"
                                                       name="location" value="{{ old('location') }}" required
                                                       autocomplete="location" placeholder="Enter location">
                                                @error('location')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        
                                            <div class="row mb-2">
                                                <div class="col-md-6">
                                                    <label for="date_of_birth" class="form-label">Year of Birth <span class="text-danger">*</span></label>
                                                    <input id="date_of_birth" type="number"
                                                           class="form-control @error('date_of_birth') is-invalid @enderror"
                                                           name="date_of_birth" value="{{ old('date_of_birth') }}" required
                                                           placeholder="Enter year of birth" min="1900" max="{{ date('Y') }}">
                                                    @error('date_of_birth')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                                    <select id="gender" name="gender" 
                                                            class="form-select @error('gender') is-invalid @enderror" required>
                                                        <option value="" disabled selected>Select your gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                    @error('gender')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        
                                            <div class="mb-2">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required 
                                                       autocomplete="email" placeholder="Enter email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        
                                            <div class="mb-3">
                                                <label class="form-label" for="password-input">Password <span class="text-danger">*</span></label>
                                                <input type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required id="password-input"
                                                       placeholder="Enter password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        
                                            <div class="mb-3">
                                                <label class="form-label" for="password-confirm">Confirm Password <span class="text-danger">*</span></label>
                                                <input type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password_confirmation" required id="password-confirm"
                                                       placeholder="Enter confirm password">
                                            </div>
                                        
                                            <div>
                                                <p class="mb-0">By registering you agree to the Reactly <a href="#" class="text-primary">Terms of Use</a></p>
                                            </div>
                                        
                                            <div class="mt-4">
                                                <button class="btn btn-primary w-100" type="submit">Register</button>
                                            </div>
                                        
                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="fw-medium text-primary">Login</a></p>
                                            </div>
                                        </form>
                                        
                                    </div>

                                </div>
                            </div>

                        </div><!-- end col -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center p-4">
                                <p>©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> webadmin. Crafted with <i
                                        class="mdi mdi-heart text-danger"></i> by Themesdesign
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- end container -->
        </div>
        <!-- end authentication section -->
    @endsection