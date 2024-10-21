@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')

@endsection
@section('page-title')
    Dashboard
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
    <x-breadcrub :title="''" :link="route('dashboard')" :pagetitle="'Dashboard'" />
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
