@extends('layouts.dashboard-layouts')
@section('Sidebar')
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" data-key="t-menu">Menu</li>

            <li>
                <a href="{{route('dashboard')}}">
                    <i data-feather="home"></i>
                    <span data-key="t-dashboard">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard')}}">
                    <i data-feather="home"></i>
                    <span data-key="t-dashboard">My events</span>
                </a>
            </li>



        </ul>
    </div>
    <!-- Sidebar -->
@endsection
@section('page-content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Starter Page</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        
</div>
@endsection