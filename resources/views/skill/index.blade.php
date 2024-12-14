@extends('layouts.master')
@section('title')
    Skills
@endsection
@section('css')
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('page-title')
     My skills
    
@endsection

@section('body')

    <body>
    @endsection
    @section('content')
    <x-breadcrub :title="''" :link="route('skills.index')" :pagetitle="'My skills'" />
    <!-- start content here -->
    <div class="row">
        <div class="col-12">

            <!-- Left sidebar -->
            <div class="email-leftbar">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('skills.create') }}" class="btn btn-success waves-effect waves-light w-100"><h5 class="font-size-15 text-uppercase text-white">New Skill</h5></a>
                       
                       
                        <div class="custom-accordion pt-4 px-4">
                            <h5 class="font-size-14 mb-0">
                                <a href="{{ route('skills.index') }}" class="text-body d-block">
                                    All
                                </a>
                            </h5>
                       </div>
                        <div class="custom-accordion p-4 " >
                            <h5 class="font-size-14 mb-0"><a href="#categories-collapse" class="text-body d-block" data-bs-toggle="collapse" >
                                Experience <i class="mdi mdi-chevron-up float-end accor-down-icon"></i></a></h5>
                        
                            <div class="collapse show mt-4" id="categories-collapse" >
                                <!-- New Experience Filter Section -->
                                <div class="categories-group-card px-4">
                                    <a href="{{ route('skills.index', ['experience' => 'Expert']) }}" class="text-body fw-semibold pb-3 d-block collapsed">
                                        <span class="mdi mdi-arrow-right-drop-circle text-success float-end"></span>
                                        Expert
                                    </a>
                                </div>
                                <div class="categories-group-card px-4">
                                    <a href="{{ route('skills.index', ['experience' => 'Intermediate']) }}" class="text-body fw-semibold pb-3 d-block collapsed">
                                        <span class="mdi mdi-arrow-right-drop-circle text-warning float-end"></span>Intermediate
                                    </a>
                                </div>
                                <div class="categories-group-card px-4">
                                    <a href="{{ route('skills.index', ['experience' => 'Beginner']) }}" class="text-body fw-semibold pb-3 d-block collapsed">
                                        <span class="mdi mdi-arrow-right-drop-circle text-danger float-end"></span>Beginner
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Left sidebar -->

            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">

                <div class="card" >
                    <div class="card-body">

                        <div class="">
                            @if($skills->count() > 0)
                            
                            
                            <div class="row mb-4">
                                <div class="col-xl-3 col-md-12">
                                    <div class="pb-3 pb-xl-0">
                                        <form class="email-search">
                                            <div class="position-relative">
                                                <input type="text" class="form-control bg-light"
                                                    placeholder="Search...">
                                                <span class="bx bx-search font-size-18"></span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div>
                                <h6 class="text-muted text-uppercase mb-3">My Skills </h6>
                                @if($skills->count() == 0)
                                <div class="bg-light-subtle p-3 text-center" >
                                    <div class="row justify-content-center">
                                        "There are no skills available right now. Please add some to get started!"
                                    </div>

                                </div>
                                @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check" >
                                        <thead>
                                            <tr>
                                                <!-- Table Headers -->
                                                <th scope="col">#</th>
                                                <th scope="col">Skill Name</th>
                                                <th scope="col">Skill Cost</th>
                                                <th scope="col">Skill Experience</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($skills as $skill)
                                            <tr>
                                        
                                            
                                                <!-- Skill Name -->
                                                <td><strong>{{ $skills->firstItem()+$loop->iteration-1 }}</strong></td>
                                                <td>
                                                <a href="{{ route('skills.show', $skill->id) }} " class=" text-muted text-uppercase" >
                                                    {{ $skill->name }}
                                                </a>
                                            </td>
                            
                                                <!-- Skill Cost -->
                                                <td>{{ $skill->cost }} dz</td>
                            
                                                <!-- Skill Experience -->
                                                <td>
                                                @switch(strtolower($skill->experience))
                                                    @case('beginner')
                                                        <span class="badge bg-danger   font-size-13">{{ $skill->experience }}</span>
                                                        @break

                                                    @case('intermediate')
                                                        <span class="badge bg-warning  font-size-13">{{ $skill->experience }}</span>
                                                        @break

                                                    @case('expert')
                                                        <span class="badge bg-success   font-size-13">{{ $skill->experience }}</span>
                                                        @break

                                                    @default
                                                        <span class="badge bg-secondary-subtle font-size-14">{{ $skill->experience }}</span>
                                                @endswitch
                                                </td>
                                                
                                                <!-- Actions (Edit & Remove) -->
                                                <td>
                                                    <div class="d-flex gap-3">
                                                        <!-- Edit Link -->
                                                        <a href="{{ route('skills.edit', $skill->id) }}" class="text-success" title="Edit">
                                                            <i class="mdi mdi-pencil font-size-18"></i>
                                                        </a>
                                                    
                                                        <!-- Delete Form -->
                                                        <form method="POST" action="{{ route('skills.destroy', $skill->id) }}" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link text-danger p-0 m-0" title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this event?')">
                                                                <i class="mdi mdi-delete font-size-18"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>
                            
                            @if($skills->count() > 0)
                            <div class="pt-2">
                                <div class="row">
                                    <div class="col-7">
                                        Showing {{ $skills->firstItem() }} - {{ $skills->lastItem() }} of {{ $skills->total() }} 
                                    </div>
                                    @php
                                        $currentPage = $skills->currentPage();
                                        $lastPage = $skills->lastPage();
                                        $startPage = max(1, $currentPage - 2);
                                        $endPage = min($lastPage, $currentPage + 2);
                                    @endphp
                                    <div class="col-5">
                                        <div class="btn-group float-end">
                                            <!-- Previous Page Link -->
                                            @if($skills->onFirstPage())
                                                <button type="button" class="btn btn-sm btn-success waves-effect" disabled>
                                                    <i class="fa fa-chevron-left"></i>
                                                </button>
                                            @else
                                                <a href="{{ $skills->previousPageUrl() }}" class="btn btn-sm btn-success waves-effect">
                                                    <i class="fa fa-chevron-left"></i>
                                                </a>
                                            @endif
                                        
                                            <!-- Specific Page Buttons -->
                                            @foreach(range($startPage, $endPage) as $page)
                                                @if($page == $currentPage)
                                                    <button type="button" class="btn btn-sm btn-secondary" disabled>{{ $page }}</button>
                                                @else
                                                    <a href="{{ $skills->url($page) }}" class="btn btn-sm btn-success waves-effect">{{ $page }}</a>
                                                @endif
                                            @endforeach
                                        
                                            <!-- Next Page Link -->
                                            @if($skills->hasMorePages())
                                                <a href="{{ $skills->nextPageUrl() }}" class="btn btn-sm btn-success waves-effect">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>
                                            @else
                                                <button type="button" class="btn btn-sm btn-success waves-effect" disabled>
                                                    <i class="fa fa-chevron-right"></i>
                                                </button>
                                            @endif
                                        </div>
                                        
                                </div>
                            </div>
                            @endif

                        </div>

                    </div>
                </div>

            </div> <!-- end Col-9 -->

        </div>
    </div><!-- End row -->
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
                <!-- gridjs js -->
                <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

                <script src="{{ URL::asset('build/js/pages/gridjs.init.js') }}"></script>
    @endsection
