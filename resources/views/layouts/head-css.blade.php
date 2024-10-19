@yield('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Bootstrap Css -->
@vite(['resources/scss/bootstrap.scss']) <!-- Assuming you have a SCSS file for Bootstrap -->

<!-- Icons Css -->
@vite(['resources/scss/icons.scss']) <!-- Assuming you have a SCSS file for icons -->

<!-- App Css -->
@vite(['resources/scss/app.scss']) <!-- Assuming you have an SCSS file for your app -->

