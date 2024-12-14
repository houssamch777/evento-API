@extends('layouts.master')
@section('title')
Notifications Page
@endsection
@section('page-title')
Your Notifications
@endsection
@section('css')
    <style>
        .list-group {
        display: flex;
        flex-direction: column;
        padding-left: 0;
        margin-bottom: 0;
        border-radius: 0.25rem;
        }
        
        .list-group-item-action {
        width: 100%;
        color: #4d5154;
        text-align: inherit;
        }
        .list-group-item-action:hover,
        .list-group-item-action:focus {
        z-index: 1;
        color: #4d5154;
        text-decoration: none;
        background-color: #f4f6f9;
        }
        .list-group-item-action:active {
        color: #8e9194;
        background-color: #eef0f3;
        }
        
        .list-group-item {
        position: relative;
        display: block;
        padding: 0.75rem 1.25rem;
        background-color: #ffffff;
        border: 1px solid #eef0f3;
        }
        .list-group-item:first-child {
        border-top-left-radius: inherit;
        border-top-right-radius: inherit;
        }
        .list-group-item:last-child {
        border-bottom-right-radius: inherit;
        border-bottom-left-radius: inherit;
        }
        .list-group-item.disabled,
        .list-group-item:disabled {
        color: #6d7174;
        pointer-events: none;
        background-color: #ffffff;
        }
        .list-group-item.active {
        z-index: 2;
        color: #ffffff;
        background-color: #1b68ff;
        border-color: #1b68ff;
        }
        .list-group-item + .list-group-item {
        border-top-width: 0;
        }
        .list-group-item + .list-group-item.active {
        margin-top: -1px;
        border-top-width: 1px;
        }
        
        .list-group-horizontal {
        flex-direction: row;
        }
        .list-group-horizontal > .list-group-item:first-child {
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0;
        }
        .list-group-horizontal > .list-group-item:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-left-radius: 0;
        }
        .list-group-horizontal > .list-group-item.active {
        margin-top: 0;
        }
        .list-group-horizontal > .list-group-item + .list-group-item {
        border-top-width: 1px;
        border-left-width: 0;
        }
        .list-group-horizontal > .list-group-item + .list-group-item.active {
        margin-left: -1px;
        border-left-width: 1px;
        }
        
        @media (min-width: 576px) {
        .list-group-horizontal-sm {
        flex-direction: row;
        }
        .list-group-horizontal-sm > .list-group-item:first-child {
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0;
        }
        .list-group-horizontal-sm > .list-group-item:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-left-radius: 0;
        }
        .list-group-horizontal-sm > .list-group-item.active {
        margin-top: 0;
        }
        .list-group-horizontal-sm > .list-group-item + .list-group-item {
        border-top-width: 1px;
        border-left-width: 0;
        }
        .list-group-horizontal-sm > .list-group-item + .list-group-item.active {
        margin-left: -1px;
        border-left-width: 1px;
        }
        }
        
        @media (min-width: 768px) {
        .list-group-horizontal-md {
        flex-direction: row;
        }
        .list-group-horizontal-md > .list-group-item:first-child {
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0;
        }
        .list-group-horizontal-md > .list-group-item:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-left-radius: 0;
        }
        .list-group-horizontal-md > .list-group-item.active {
        margin-top: 0;
        }
        .list-group-horizontal-md > .list-group-item + .list-group-item {
        border-top-width: 1px;
        border-left-width: 0;
        }
        .list-group-horizontal-md > .list-group-item + .list-group-item.active {
        margin-left: -1px;
        border-left-width: 1px;
        }
        }
        
        @media (min-width: 992px) {
        .list-group-horizontal-lg {
        flex-direction: row;
        }
        .list-group-horizontal-lg > .list-group-item:first-child {
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0;
        }
        .list-group-horizontal-lg > .list-group-item:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-left-radius: 0;
        }
        .list-group-horizontal-lg > .list-group-item.active {
        margin-top: 0;
        }
        .list-group-horizontal-lg > .list-group-item + .list-group-item {
        border-top-width: 1px;
        border-left-width: 0;
        }
        .list-group-horizontal-lg > .list-group-item + .list-group-item.active {
        margin-left: -1px;
        border-left-width: 1px;
        }
        }
        
        @media (min-width: 1200px) {
        .list-group-horizontal-xl {
        flex-direction: row;
        }
        .list-group-horizontal-xl > .list-group-item:first-child {
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0;
        }
        .list-group-horizontal-xl > .list-group-item:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-left-radius: 0;
        }
        .list-group-horizontal-xl > .list-group-item.active {
        margin-top: 0;
        }
        .list-group-horizontal-xl > .list-group-item + .list-group-item {
        border-top-width: 1px;
        border-left-width: 0;
        }
        .list-group-horizontal-xl > .list-group-item + .list-group-item.active {
        margin-left: -1px;
        border-left-width: 1px;
        }
        }
        
        .list-group-flush {
        border-radius: 0;
        }
        .list-group-flush > .list-group-item {
        border-width: 0 0 1px;
        }
        .list-group-flush > .list-group-item:last-child {
        border-bottom-width: 0;
        }
        
        .list-group-item-primary {
        color: #0e3685;
        background-color: #bfd5ff;
        }
        .list-group-item-primary.list-group-item-action:hover,
        .list-group-item-primary.list-group-item-action:focus {
        color: #0e3685;
        background-color: #a6c4ff;
        }
        .list-group-item-primary.list-group-item-action.active {
        color: #ffffff;
        background-color: #0e3685;
        border-color: #0e3685;
        }
        
        .list-group-item-secondary {
        color: #0a395d;
        background-color: #bdd6ea;
        }
        .list-group-item-secondary.list-group-item-action:hover,
        .list-group-item-secondary.list-group-item-action:focus {
        color: #0a395d;
        background-color: #aacae4;
        }
        .list-group-item-secondary.list-group-item-action.active {
        color: #ffffff;
        background-color: #0a395d;
        border-color: #0a395d;
        }
        
        .list-group-item-success {
        color: #107259;
        background-color: #c0f5e8;
        }
        .list-group-item-success.list-group-item-action:hover,
        .list-group-item-success.list-group-item-action:focus {
        color: #107259;
        background-color: #aaf2e0;
        }
        .list-group-item-success.list-group-item-action.active {
        color: #ffffff;
        background-color: #107259;
        border-color: #107259;
        }
        
        .list-group-item-info {
        color: #005d83;
        background-color: #b8eafe;
        }
        .list-group-item-info.list-group-item-action:hover,
        .list-group-item-info.list-group-item-action:focus {
        color: #005d83;
        background-color: #9fe3fe;
        }
        .list-group-item-info.list-group-item-action.active {
        color: #ffffff;
        background-color: #005d83;
        border-color: #005d83;
        }
        
        .list-group-item-warning {
        color: #855701;
        background-color: #ffe7b8;
        }
        .list-group-item-warning.list-group-item-action:hover,
        .list-group-item-warning.list-group-item-action:focus {
        color: #855701;
        background-color: #ffde9f;
        }
        .list-group-item-warning.list-group-item-action.active {
        color: #ffffff;
        background-color: #855701;
        border-color: #855701;
        }
        
        .list-group-item-danger {
        color: #721c24;
        background-color: #f5c6cb;
        }
        .list-group-item-danger.list-group-item-action:hover,
        .list-group-item-danger.list-group-item-action:focus {
        color: #721c24;
        background-color: #f1b0b7;
        }
        .list-group-item-danger.list-group-item-action.active {
        color: #ffffff;
        background-color: #721c24;
        border-color: #721c24;
        }
        
        .list-group-item-light {
        color: #7f8081;
        background-color: #fcfcfd;
        }
        .list-group-item-light.list-group-item-action:hover,
        .list-group-item-light.list-group-item-action:focus {
        color: #7f8081;
        background-color: #ededf3;
        }
        .list-group-item-light.list-group-item-action.active {
        color: #ffffff;
        background-color: #7f8081;
        border-color: #7f8081;
        }
        
        .list-group-item-dark {
        color: #17191c;
        background-color: #c4c5c6;
        }
        .list-group-item-dark.list-group-item-action:hover,
        .list-group-item-dark.list-group-item-action:focus {
        color: #17191c;
        background-color: #b7b8b9;
        }
        .list-group-item-dark.list-group-item-action.active {
        color: #ffffff;
        background-color: #17191c;
        border-color: #17191c;
        }
    </style>
@endsection
@section('body')

<body>
    @endsection
    @section('content')
    <!-- start content here -->
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">

                <div class="my-4">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-2 mt-4">Notifications Log</h5>
                            <p>You can explore all your notifications.</p>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('markAllAsRead') }}" class="small fw-semibold text-decoration-underline"> Mark all as
                                read</a>
                        </div>
                    </div>
                    <hr class="my-4" />
                    <div class="list-group mb-5 shadow">
                        @forelse ($notifications as $notification)
                            @if ($notification->type=="App\\Notifications\\TeamRequestNotification")
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <p class="mb-1"><strong>{{ $notification->data['team_name']
                                                }}.</strong> ask you to join them. </p>
                                        @if (!isset($notification->data['status']) || $notification->data['status'] === 'pending')
                                                <div class="row">
                                                    <div class="d-flex gap-2">
                                                        <form action="{{ $notification->data['accept_url'] }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                                                            <button type="submit" class="btn btn-subtle-success waves-effect waves-light">
                                                                <i class="bx bx-check-double font-size-16 align-middle"></i> Accept
                                                            </button>
                                                        </form>
                                                        <form action="{{ $notification->data['reject_url'] }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                                                            <button type="submit" class="btn btn-subtle-danger waves-effect waves-light">
                                                                <i class="bx bx-block font-size-16 align-middle"></i> Reject
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                        @else
                                                <div class="row">
                                                    <div class="d-flex gap-2">
                                                       {{ $notification->data['status']}}
                                                    </div>
                                                </div>
                                        @endif
                                        
                                    </div>
                                    <div class="col-auto">
                                        <p class="text-muted font-size-13 mb-0 float-end">{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" />
                            @else
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <p class="mb-1"><strong>{{ $notification->data['title']
                                                    }}</strong></p>
                                            <p class="text-muted mb-0">
                                                {{ $notification->data['message'] ?? '' }}
                                            </p>
                                        </div>
                                        <div class="col-auto">
                                           <p class="text-muted font-size-13 mb-0 float-end">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4" />
                            @endif
                        @empty
                        <p class="text-muted">You have no notifications at the moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection