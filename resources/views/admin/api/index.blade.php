@extends('layouts.admin.master')
@section('title')
Api Documentation
@endsection
@section('css')
<style>
    /* Custom style for the active tab */
    .card .nav .nav-link.active {
        background-color: #28a745;
        /* Success color */
        color: #fff;
        /* White text */
    }
</style>
@endsection
@section('page-title')
Api Documentation
@endsection
@section('body')

<body>
    @endsection
    @section('content')

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">API Documentation</h4>
                <p class="card-title-desc">Detailed API reference with navigation for each API type.</p>
            </div><!-- end card-header -->
        
            <div class="card-body">
                <div class="row">
                    <!-- Tabs Navigation -->
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" id="api-tabs" role="tablist" aria-orientation="vertical">
                            <a class="nav-link mb-2 active" id="auth-tab" data-bs-toggle="pill" href="#auth-api" role="tab"
                                aria-controls="auth-api" aria-selected="true">Authentication</a>
                            <a class="nav-link mb-2" id="events-tab" data-bs-toggle="pill" href="#events-api" role="tab"
                                aria-controls="events-api" aria-selected="false">Events</a>
                            <a class="nav-link mb-2" id="users-tab" data-bs-toggle="pill" href="#users-api" role="tab"
                                aria-controls="users-api" aria-selected="false">Users</a>
                            <a class="nav-link" id="notifications-tab" data-bs-toggle="pill" href="#notifications-api"
                                role="tab" aria-controls="notifications-api" aria-selected="false">Notifications</a>
                        </div>
                    </div><!-- end col -->
        
                    <!-- Tabs Content -->
                    <div class="col-md-9">
                        <div class="tab-content text-muted mt-4 mt-md-0" id="api-tabs-content">
                            <!-- Authentication API -->
                            <div class="tab-pane fade show active" id="auth-api" role="tabpanel" aria-labelledby="auth-tab">
                                <h5>Authentication API</h5>
                                <div class="accordion" id="auth-accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="login-heading">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#login-method" aria-expanded="true"
                                                aria-controls="login-method">
                                                Login
                                            </button>
                                        </h2>
                                        <div id="login-method" class="accordion-collapse collapse show"
                                            aria-labelledby="login-heading" data-bs-parent="#auth-accordion">
                                            <div class="accordion-body">
                                                <p><strong>Method:</strong> POST</p>
                                                <p><strong>Endpoint:</strong> <code>/api/login</code></p>
                                                <p><strong>Headers:</strong></p>
                                                <ul>
                                                    <li><code>Content-Type: application/json</code></li>
                                                </ul>
                                                <p><strong>Request Body:</strong></p>
                                                <pre><code>{
            "email": "user@example.com",
            "password": "securepassword"
        }</code></pre>
                                                <p><strong>Response:</strong></p>
                                                <pre><code>{
            "token": "38|mc0uXKTdomK2KM6DybimcjHkzhmQGtRLr0YgplWs32cf92f2",
            "message": "Login successful"
        }</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add other methods like Register, Logout here -->
                                </div>
                            </div>
        
                            <!-- Events API -->
                            <div class="tab-pane fade" id="events-api" role="tabpanel" aria-labelledby="events-tab">
                                <h5>Events API</h5>
                                <div class="accordion" id="events-accordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="create-event-heading">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#create-event-method" aria-expanded="false"
                                                aria-controls="create-event-method">
                                                Create Event
                                            </button>
                                        </h2>
                                        <div id="create-event-method" class="accordion-collapse collapse"
                                            aria-labelledby="create-event-heading" data-bs-parent="#events-accordion">
                                            <div class="accordion-body">
                                                <p><strong>Method:</strong> POST</p>
                                                <p><strong>Endpoint:</strong> <code>/api/events</code></p>
                                                <!-- Add more details about request, response, etc. -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <!-- Users API -->
                            <div class="tab-pane fade" id="users-api" role="tabpanel" aria-labelledby="users-tab">
                                <h5>Users API</h5>
                                <!-- Similar accordion structure for User API methods -->
                            </div>
        
                            <!-- Notifications API -->
                            <div class="tab-pane fade" id="notifications-api" role="tabpanel"
                                aria-labelledby="notifications-tab">
                                <h5>Notifications API</h5>
                                <!-- Similar accordion structure for Notifications API methods -->
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end card-body -->
        </div><!-- end card -->

    @endsection
    @section('scripts')

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection