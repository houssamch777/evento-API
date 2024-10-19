@extends('layouts.master')
@section('title')
    Skills
@endsection
@section('css')
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('page-title')
    skills
@endsection

@section('body')

    <body>
    @endsection
    @section('content')
    <!-- start content here -->
    <div class="row">
        <div class="col-12">

            <!-- Left sidebar -->
            <div class="email-leftbar">
                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('skills.create') }}" class="btn btn-danger waves-effect waves-light w-100"><h5 class="font-size-15 text-uppercase text-white">New Skill</h5></a>

                        <h5 class="mt-4 font-size-15 ">Experience Filter</h5>
                        <div class="card p-0 overflow-hidden mt-3 shadow-none">
                            <div class="mail-list">
                                <!-- Filter for Expert -->
                                <a href="{{ route('skills.index', ['experience' => 'Expert']) }}" class="border-bottom">
                                    <span class="mdi mdi-arrow-right-drop-circle text-warning float-end"></span>Expert
                                </a>
                        
                                <!-- Filter for Intermediate -->
                                <a href="{{ route('skills.index', ['experience' => 'Intermediate']) }}" class="border-bottom">
                                    <span class="mdi mdi-arrow-right-drop-circle text-primary float-end"></span>Intermediate
                                </a>
                        
                                <!-- Filter for Beginner -->
                                <a href="{{ route('skills.index', ['experience' => 'Beginner']) }}" class="border-bottom">
                                    <span class="mdi mdi-arrow-right-drop-circle text-danger float-end"></span>Beginner
                                </a>
                                <a href="{{ route('skills.index') }}" class="border-bottom text-muted">
                                    <span class="mdi mdi-close-circle-outline float-end"></span>Cancel
                                </a>
                            </div>
                        </div>



                    </div>
                </div>

            </div>
            <!-- End Left sidebar -->

            <!-- Right Sidebar -->
            <div class="email-rightbar mb-3">

                <div class="card">
                    <div class="card-body">

                        <div class="">
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

                            <div>
                                <h6 class="text-muted text-uppercase mb-3">My Skills</h6>
                                <div class="table-responsive">
                                    <table class="table table-striped table-centered align-middle table-nowrap mb-0 table-check">
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
                                                <td><strong>{{ $loop->iteration }}</strong></td>
                                                <td>{{ $skill->name }}</td>
                            
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
                                                    <div class="dropdown">
                                                        <a class="text-muted dropdown-toggle font-size-18" role="button"
                                                            data-bs-toggle="dropdown" aria-haspopup="true">
                                                            <i class="mdi mdi-dots-horizontal"></i>
                                                        </a>
    
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="{{ route('skills.edit', $skill->id) }}">Edit</a>
                                                            <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item">Delete</button>
                                                            </form>
                                                            
                                                        </div>
                                                    </div>
                                                </td>
                                                            
                                                    
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            

                            <div class="pt-2">
                                <div class="row">
                                    <div class="col-7">
                                        Showing {{ $skills->firstItem() }} - {{ $skills->lastItem() }} of {{ $skills->total() }} 
                                    </div>
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
                            </div>
                            

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
