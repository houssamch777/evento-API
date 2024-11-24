<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> @yield('title') | Evanto</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">

    <!-- include head css -->
    @include('layouts.head-css')
</head>

@yield('body')

    <!-- Begin page
    <div id="layout-wrapper">
         -->
            <!-- horizontal -->
            @include('layouts.horizontal')

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
            
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
            </div>
            <!-- end main content
    </div>
    -->
    <!-- END layout-wrapper -->


    <!-- vendor-scripts -->
    @include('layouts.vendor-scripts')

</body>

</html>
