<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Register | Minia - Minimal Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">

        <!-- App Css-->        
        <link rel="stylesheet" href="{{asset('css/preloader.min.css')}}" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="{{asset('css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->
        <div class="auth-page">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-xxl-3 col-lg-4 col-md-5">
                        <div class="auth-full-page-content d-flex p-sm-5 p-4">
                            <div class="w-100">
                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5 text-center">
                                        <a href="{{route('index')}}" class="d-block auth-logo">
                                            <img src="{{asset('images/logo-sm.svg')}}" alt="" height="28"> <span class="logo-txt">Evento</span>
                                        </a>
                                    </div>
                                    <div class="auth-content my-auto">
                                        <div class="text-center">
                                            <h5 class="mb-0">Register Account</h5>
                                            <p class="text-muted mt-2">Get your free Evento account now.</p>
                                        </div>
                                        <form class="needs-validation mt-4 pt-2" novalidate action="{{ route('register') }}" method="POST">
                                            @csrf
                                        
                                            <div class="row">
                                                <!-- First Name -->
                                                <div class="col-md-6 position-relative">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="first_name">First name</label>
                                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="First name" value="{{ old('first_name', 'First Name') }}" required>
                                                        <div class="invalid-feedback">
                                                            @error('first_name')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <!-- Last Name -->
                                                <div class="col-md-6 position-relative">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="last_name">Last name</label>
                                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" placeholder="Last name" value="{{ old('last_name', 'Last Name') }}" required>
                                                        <div class="invalid-feedback">
                                                            @error('last_name')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="row">
                                                <!-- Phone Number -->
                                                <div class="col-md-8 position-relative">
                                                    <div class="mb-3">
                                                        <label for="phone_number" class="form-label">Phone Number</label>
                                                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number') }}" required>
                                                        <div class="invalid-feedback">
                                                            @error('phone_number')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <!-- Date of Birth -->
                                                <div class="col-md-4 position-relative">
                                                    <div class="mb-3">
                                                        <label for="date_of_birth" class="form-label">Year of Birth</label>
                                                        <input type="text" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" placeholder="Enter year of birth" value="{{ old('date_of_birth') }}" required>
                                                        <div class="invalid-feedback">
                                                            @error('date_of_birth')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="row">
                                                <!-- Location -->
                                                <div class="col-md-6 position-relative">
                                                    <div class="mb-3">
                                                        <label for="location" class="form-label">Location</label>
                                                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" placeholder="Enter location" value="{{ old('location') }}" required>
                                                        <div class="invalid-feedback">
                                                            @error('location')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <!-- Gender -->
                                                <div class="col-md-6">
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <div class="row">
                                                        <div class="col-md-6 position-relative">
                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender_female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="gender_female">
                                                                    Female
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 position-relative">
                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender_male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="gender_male">
                                                                    Male
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            @error('gender')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <!-- Email -->
                                            <div class="mb-3 position-relative">
                                                <label for="useremail" class="form-label">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
                                                <div class="invalid-feedback">
                                                    @error('email')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        
                                            <div class="row">
                                                <!-- Password -->
                                                <div class="col-md-6 position-relative">
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password" required>
                                                        <div class="invalid-feedback">
                                                            @error('password')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                                <!-- Confirm Password -->
                                                <div class="col-md-6 position-relative">
                                                    <div class="mb-3">
                                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter password again" required>
                                                        <div class="invalid-feedback">
                                                            @error('password_confirmation')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <!-- Terms and Register Button -->
                                            <div class="mb-4">
                                                <p class="mb-0">By registering you agree to the Evento <a href="#" class="text-primary">Terms of Use</a></p>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Register</button>
                                            </div>
                                        </form>
                                        

                                        <div class="mt-5 text-center">
                                            <p class="text-muted mb-0">Already have an account ? <a href="{{route('login')}}"
                                                    class="text-primary fw-semibold"> Login </a> </p>
                                        </div>
                                    </div>
                                    <div class="mt-4 mt-md-5 text-center">
                                        <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Evento   . Crafted with <i class="mdi mdi-heart text-danger"></i> by WitsLinksCrew</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end auth full page content -->
                    </div>
                    <!-- end col -->
                    <div class="col-xxl-9 col-lg-8 col-md-7">
                        <div class="auth-bg pt-md-5 p-4 d-flex">
                            <div class="bg-overlay bg-primary"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- end bubble effect -->
                            <div class="row justify-content-center align-items-center">
                                <div class="col-xl-7">
                                    <div class="p-0 p-sm-4 px-xl-0">
                                        <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                            </div>
                                            <!-- end carouselIndicators -->
                                            
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="testi-contain text-white">
                                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                            
                                                        <h4 class="mt-4 fw-medium lh-base text-white">“Evento has revolutionized the way I plan and organize events.
                                                            The platform's intuitive design and robust features make it easier than ever to manage all aspects of an event.
                                                            I can't imagine going back to my old methods after experiencing what Evento has to offer.”</h4>
                                                        <div class="mt-4 pt-3 pb-5">
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-shrink-0">
                                                                    <img src="{{asset('images/users/avatar-1.jpg')}}" class="avatar-md img-fluid rounded-circle" alt="...">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3 mb-4">
                                                                    <h5 class="font-size-18 text-white">Richard Drews</h5>
                                                                    <p class="mb-0 text-white-50">Event Planner</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="carousel-item">
                                                    <div class="testi-contain text-white">
                                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                            
                                                        <h4 class="mt-4 fw-medium lh-base text-white">“The team behind Evento truly understands what it takes to pull off a successful event. 
                                                            With its user-friendly interface and powerful tools, Evento has become my go-to platform for all my event planning needs.”</h4>
                                                        <div class="mt-4 pt-3 pb-5">
                                                            <div class="d-flex align-items-start">
                                                                <div class="flex-shrink-0">
                                                                    <img src="{{asset('images/users/avatar-2.jpg')}}" class="avatar-md img-fluid rounded-circle" alt="...">
                                                                </div>
                                                                <div class="flex-grow-1 ms-3 mb-4">
                                                                    <h5 class="font-size-18 text-white">Rosanna French</h5>
                                                                    <p class="mb-0 text-white-50">Event Coordinator</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="carousel-item">
                                                    <div class="testi-contain text-white">
                                                        <i class="bx bxs-quote-alt-left text-success display-6"></i>
                                            
                                                        <h4 class="mt-4 fw-medium lh-base text-white">“Evento has made event planning incredibly efficient. 
                                                            The ability to manage everything from guest lists to schedules in one place has saved me countless hours. 
                                                            Evento is a must-have tool for anyone serious about event management.”</h4>
                                                        <div class="mt-4 pt-3 pb-5">
                                                            <div class="d-flex align-items-start">
                                                                <img src="{{asset('images/users/avatar-3.jpg')}}"
                                                                    class="avatar-md img-fluid rounded-circle" alt="...">
                                                                <div class="flex-1 ms-3 mb-4">
                                                                    <h5 class="font-size-18 text-white">Ilse R. Eaton</h5>
                                                                    <p class="mb-0 text-white-50">Events Manager</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end carousel-inner -->
                                        </div>
                                        <!-- end review carousel -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container fluid -->
        </div>


        <!-- JAVASCRIPT -->
        <script src="{{asset('libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('libs/feather-icons/feather.min.js')}}"></script>
        <!-- pace js -->
        <script src="{{asset('libs/pace-js/pace.min.js')}}"></script>
        <!-- password addon init -->
        <script src="{{asset('js/pages/pass-addon.init.jss')}}"></script>

    </body>

</html>