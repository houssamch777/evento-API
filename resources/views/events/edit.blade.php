@extends('layouts.master')
@section('title')
Edit Event
@endsection
@section('css')
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
Edit Event
@endsection
@section('body')

<body>
    @endsection
    @section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mb-4">Edit Event : {{$event->name}}</h2>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
                
            
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Event: Assets & Skills Needs</h5>
                        </div>
                        <div class="card-body pt-0 pb-3">
                            <div>
                                <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-1">
                                    <tbody>
                                        @forelse ($event->skillNeeds as $skill)
                                        <tr>
                                            <td style="width: 50px;">
                                                <i class="bx bx-extension font-size-24  align-middle me-1"></i></td>
                                            <td>
                                                <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-body">{{$skill->skillName->name}}</a></h5>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="javascript: void(0);"
                                                        class="badge bg-success-subtle text-success font-size-11">{{$skill->quantity}}x</a>
                                                </div>
                                            </td>
                                            <td>
                                                Skill
                                                
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <!-- Edit Link -->
                                                    <!-- Edit Button -->
                                                    <button type="button" class="btn btn-link text-success p-0" data-bs-toggle="modal" data-bs-target="#editSkillModal"
                                                        data-id="{{ $skill->id }}" data-quantity="{{ $skill->quantity }}" title="Edit">
                                                        <i class="mdi mdi-pencil font-size-18"></i>
                                                    </button>
                                                    <!-- Delete Form -->
                                                    <form method="POST" action="#" class="d-inline">
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
                                        @empty
                                        
                                        @endforelse
                                        @forelse ($event->assetNeeds as $asset)
                                        <tr>
                                            <td style="width: 50px;">
                                                @if (class_basename($asset->assetable_type) == 'EquipmentCategory')
                                                   <i class="bx bx-radio font-size-24  align-middle me-1"></i>
                                                @elseif (class_basename($asset->assetable_type) == 'FurnitureCategory')
                                                    <i class="bx bx-package font-size-24  align-middle me-1"></i>        
                                                @elseif (class_basename($asset->assetable_type) == 'RoomCategory')
                                                    <i class="bx bx-building-house font-size-24  align-middle me-1"></i>
                                                @elseif (class_basename($asset->assetable_type) == 'TransportationCategory')
                                                    <i class="bx bx-bus font-size-24  align-middle me-1"></i>
                                                @else
                                                    <i class="bx bx-extension font-size-24  align-middle me-1"></i>
                                                @endif 
                                            
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-body">{{$asset->assetable->name}}</a></h5>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="javascript: void(0);"
                                                        class="badge bg-success-subtle text-success font-size-11">{{$asset->quantity}}x</a>
                                                </div>
                                            </td>
                                            <td>
                                                @if (class_basename($asset->assetable_type) == 'EquipmentCategory')
                                                   Equipment
                                                @elseif (class_basename($asset->assetable_type) == 'FurnitureCategory')
                                                   Furniture       
                                                @elseif (class_basename($asset->assetable_type) == 'RoomCategory')
                                                   Venue
                                                @elseif (class_basename($asset->assetable_type) == 'TransportationCategory')
                                                   Transporta..
                                                @endif 
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <!-- Edit Link -->
                                                    <button type="button" class="btn btn-link text-success p-0" data-bs-toggle="modal" data-bs-target="#editAssetModal"
                                                        data-id="{{ $asset->id }}" data-quantity="{{ $asset->quantity }}" title="Edit">
                                                        <i class="mdi mdi-pencil font-size-18"></i>
                                                    </button>
                                                
                                                    <!-- Delete Form -->
                                                    <form method="POST" action="#" class="d-inline">
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
                                        @empty
                                        <tr>
                                            <p>
                                                nothing to show
                                            </p>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Team Members</h5>
                        </div>
                        <div class="card-body pt-2">
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-1">
                                    <tbody>
                                        @if ($event->teams)
                                            @forelse ($event->teams->members as $member)
                                            <tr>
                                            <td style="width: 50px;">
                                                <img src="{{ $member->profile_picture ? asset('storage/' .$member->profile_picture) : URL::asset('build/images/users/avatar-3.jpg') }}"
                                                    class="rounded-circle avatar-sm" alt=""></td>
                                            <td>
                                                <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-body">{{$member->name}}</a></h5>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="javascript: void(0);"
                                                        class="badge bg-primary-subtle text-primary font-size-11">{{$member->pivot->role}}</a>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($member->active_status)
                                                    <i class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i>
                                                Online
                                                @else
                                                    <i class="mdi mdi-circle-medium font-size-18 text-danger align-middle me-1"></i>
                                                Offline
                                                @endif
                                                
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <p>
                                                nothing to show
                                            </p>
                                        </tr>
                                        @endforelse
                                        @else
                                            <tr>
                                            <p>
                                                nothing to show
                                            </p>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                
                            <div class="">
                                <div class="row mb-2">
                                    <div class="col-xl-3 col-md-12">
                                        <div class="pb-3 pb-xl-0">
                                            <form class="email-search">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control bg-light" placeholder="Search...">
                                                    <span class="bx bx-search font-size-18"></span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-md-12">
                                        <div class="text-sm-end">
                                            <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                                data-bs-toggle="modal" data-bs-target=".create-task"><i class="mdi mdi-plus me-1"></i>
                                                Create Task</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 40px;">
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck01">
                                                    <label class="form-check-label" for="upcomingtaskCheck01"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-body">Create a webadmin Dashboard</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 7
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">Product Design</p>
                                            </td>
                
                                            <td>
                                                <div class="text-center">
                                                    <span
                                                        class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck02" checked>
                                                    <label class="form-check-label" for="upcomingtaskCheck02"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-body">Create a New Landing</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 8
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">Development</p>
                                            </td>
                
                                            <td>
                                                <div class="text-center">
                                                    <span
                                                        class="badge rounded-pill bg-primary-subtle text-primary font-size-11">Approved</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <div class="avatar-sm">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-success text-white font-size-16">
                                                                    A
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck03">
                                                    <label class="form-check-label" for="upcomingtaskCheck03"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-body">Create a webadmin Logo</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 5
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">Illustration</p>
                                            </td>
                
                                            <td>
                                                <div class="text-center">
                                                    <span
                                                        class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <div class="avatar-sm">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-warning text-white font-size-16">
                                                                    R
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                
                                        </tr>
                
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck04">
                                                    <label class="form-check-label" for="upcomingtaskCheck04"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-body">Redesign - Landing page</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 7
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">Design</p>
                                            </td>
                
                                            <td>
                                                <div class="text-center">
                                                    <span
                                                        class="badge rounded-pill bg-success-subtle text-success font-size-11">Completed</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <div class="avatar-sm">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                                    V
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                
                                        </tr>
                
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck05">
                                                    <label class="form-check-label" for="upcomingtaskCheck05"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-body">Create a Blog Template</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 5
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">Angular</p>
                                            </td>
                
                                            <td>
                                                <div class="text-center">
                                                    <span
                                                        class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                
                                        </tr>
                
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck06">
                                                    <label class="form-check-label" for="upcomingtaskCheck06"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-body">Minimal Multipurpose Landing</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 2
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">Backend</p>
                                            </td>
                
                                            <td>
                                                <div class="text-center">
                                                    <span
                                                        class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                
                                        </tr>
                
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck07">
                                                    <label class="form-check-label" for="upcomingtaskCheck07"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-body">Fix Responsivenes for structure</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 5
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">Development</p>
                                            </td>
                
                                            <td>
                                                <div class="text-center">
                                                    <span
                                                        class="badge rounded-pill bg-success-subtle text-success font-size-11">Completed</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <div class="avatar-sm">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-danger text-white font-size-16">
                                                                    S
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                
                                        </tr>
                
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck08" checked>
                                                    <label class="form-check-label" for="upcomingtaskCheck08"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-body">Create a webadmin Dashboard</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 9
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">Illustration</p>
                                            </td>
                
                                            <td>
                                                <div class="text-center">
                                                    <span
                                                        class="badge rounded-pill bg-primary-subtle text-primary font-size-11">Approved</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                
                                        </tr>
                
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck09">
                                                    <label class="form-check-label" for="upcomingtaskCheck09"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-body">New Widgets For Dashboard</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 10
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">Design</p>
                                            </td>
                
                                            <td>
                                                <div class="text-center">
                                                    <span
                                                        class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                
                                        </tr>
                
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck10" checked>
                                                    <label class="form-check-label" for="upcomingtaskCheck10"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-body">Old Landing Re-Design</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 5
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">Angular</p>
                                            </td>
                
                                            <td>
                                                <div class="text-center">
                                                    <span
                                                        class="badge rounded-pill bg-primary-subtle text-primary font-size-11">Approved</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <div class="avatar-sm">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-primary text-white font-size-16">
                                                                    V
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                
                                        </tr>
                
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck11">
                                                    <label class="form-check-label" for="upcomingtaskCheck11"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 m-0"><a href="javascript: void(0);"
                                                        class="text-body">Create a Landing Page</a></h5>
                                            </td>
                                            <td>
                                                <p class="mb-0">
                                                    <i class="mdi mdi-comment-outline align-middle font-size-16 me-1"></i> 6
                                                </p>
                                            </td>
                                            <td>
                                                <p class="mb-0">Design</p>
                                            </td>
                
                                            <td>
                                                <div class="text-center">
                                                    <span
                                                        class="badge rounded-pill bg-success-subtle text-success font-size-11">Completed</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <div class="avatar-sm">
                                                                <span
                                                                    class="avatar-title rounded-circle bg-info text-white font-size-16">
                                                                    R
                                                                </span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="d-inline-block">
                                                            <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                                                class="rounded-circle avatar-sm">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                
                                        </tr>
                
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                
                        </div>
                    </div>
                </div>
            </div>
            
            </div>
            <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            
            <!--  Extra Large modal example -->
            <div class="modal fade create-task" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myExtraLargeModalLabel">Create Task</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="CreateTask-Task-Name">Task Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Task Name"
                                            id="CreateTask-Task-Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="CreateTask-Team-Member">Team Member</label>
                                        <input type="text" class="form-control" placeholder="Enter Team Member"
                                            id="CreateTask-Team-Member">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Due Date</label>
                                        <input type="text" class="form-control" placeholder="Select Due Date"
                                            id="CreateTask-due-date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="CreateTask-Category">Category</label>
                                        <select class="form-select">
                                            <option selected> Select Category </option>
                                            <option>Waiting</option>
                                            <option>Approved</option>
                                            <option>Completed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="CreateTask-Task Description">Task Description</label>
                                        <textarea class="form-control" id="projectdesc" rows="3"
                                            placeholder="Enter Task Description..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                            class="bx bx-x me-1 align-middle"></i> Cancel</button>
                                    <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#success-btn" id="btn-save-event"><i
                                            class="bx bx-check me-1 align-middle"></i> Confirm</button>
                                </div>
                            </div>
            
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            
            <div class="modal fade" id="editAssetModal" tabindex="-1" aria-labelledby="editAssetModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editAssetForm" method="POST" action="{{ route('assetsNeed.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editAssetModalLabel">Edit Asset Quantity</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="assetId">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editSkillModal" tabindex="-1" aria-labelledby="editSkillModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editSkillForm" method="POST" action="{{route('event-skill-need.update')}}">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSkillModalLabel">Edit Skill Quantity</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="skillId">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="skillQuantity" name="quantity" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--  successfully modal  -->
            <div id="success-btn" class="modal fade" tabindex="-1" aria-labelledby="success-btnLabel" aria-hidden="true"
                data-bs-scroll="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-center">
                                <i class="bx bx-check-circle display-1 text-success"></i>
                                <h4 class="mt-3">Task Completed Successfully</h4>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    <!-- end modal -->
    @endsection
    @section('scripts')
<!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
        
        <!-- datepicker js -->
        <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
        
        <!--  -->
        <script src="{{ URL::asset('build/js/pages/todo.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const editAssetModal = document.getElementById('editAssetModal');
        const assetForm = document.getElementById('editAssetForm');
        const quantityInput = document.getElementById('quantity');
        const assetIdInput = document.getElementById('assetId');
        
        editAssetModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const assetId = button.getAttribute('data-id');
        const quantity = button.getAttribute('data-quantity');
        
        // Set the modal fields
        assetIdInput.value = assetId;
        quantityInput.value = quantity;
        
        // Update the form action dynamically
        //assetForm.action = `/assets/${assetId}/update`;
        });
        });
    </script>
    <script>
            document.addEventListener('DOMContentLoaded', function () {
            const editSkillModal = document.getElementById('editSkillModal');
            const skillForm = document.getElementById('editSkillForm');
            const skillQuantityInput = document.getElementById('skillQuantity');
            const skillIdInput = document.getElementById('skillId');
            
            editSkillModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const skillId = button.getAttribute('data-id');
            const quantity = button.getAttribute('data-quantity');
            
            // Set the modal fields
            skillIdInput.value = skillId;
            skillQuantityInput.value = quantity;
            
            // Update the form action dynamically
            //skillForm.action = `/skills/${skillId}/update`;
            });
            });
        </script>
    @endsection