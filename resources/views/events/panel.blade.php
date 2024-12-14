@extends('layouts.master')
@section('title')
Event Panel
@endsection
@section('css')
<!-- datepicker css -->
<link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
<!-- Include Cropper.js CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />





@endsection
@section('page-title')
Edit Event
@endsection

@section('body')

<body >
    @endsection
    @section('content')
    <form action="{{ route('event.visualIdentity.uploadBanner', $event->id) }}" method="POST" id="banner-form"
        enctype="multipart/form-data">
        @csrf
        <input id="file-upload" name="file" type="file" accept="image/*" style="display: none;" required>
        <input type="hidden" id="cropped-image" name="cropped_image">

        <!-- Modal for cropping the image -->
        <div id="cropperModal" class="modal fade" tabindex="-1" aria-labelledby="cropperModalLabel" aria-hidden="true"
            data-bs-scroll="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cropperModalLabel">Crop Your Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <img id="image-preview" style="max-width: 100%;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="crop-and-submit">Crop & Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="{{ route('event.visualIdentity.uploadLogo', $event->id) }}" method="POST" id="logo-upload-form"
        enctype="multipart/form-data">
        @csrf
        <input id="logo-file-upload" name="file" type="file" accept="image/*" style="display: none;" required>
        <input type="hidden" id="cropped-logo" name="cropped_logo">

        <!-- Modal for cropping the image -->
        <div id="logoCropperModal" class="modal fade" tabindex="-1" aria-labelledby="logoCropperModalLabel"
            aria-hidden="true" data-bs-scroll="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoCropperModalLabel">Crop Your Logo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <img id="logo-image-preview" style="max-width: 100%;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="crop-logo-button">Crop & Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Validation Errors -->
    @if ($errors->any())
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-danger">
                        <h5 class="alert-heading">Please fix the following errors:</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center mb-0">Panel of : {{ $event->name }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-5">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-start mb-2">
                        <div class="flex-grow-1">
                            <h5>Event Visual Identity</h5>
                        </div>
                        <div class="flex-shrink-0">
                            <a class="text-muted dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="bx bx-dots-vertical font-size-22"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <button type="button" class="dropdown-item" id="choose-file-button">Change
                                        Banner</button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item" id="choose-logo-file-button">Change
                                        Logo</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="user-profile-img">
                        @if ($event->visualIdentity && $event->visualIdentity->banner_url)
                        <img src="{{ asset('storage/' . $event->visualIdentity->banner_url) }}"
                            class="profile-img profile-foreground-img " alt="Event Banner">
                        @else
                        <img src="{{ URL::asset('build/images/pattern-bg.jpg') }}"
                            class="profile-img profile-foreground-img " alt="Default Banner">
                        @endif
                    </div>
                    <!-- end user-profile-img -->
                    <div class="p-4 pt-0">
                        <div class="mt-n5 position-relative text-center ">
                            @if ($event->visualIdentity && $event->visualIdentity->logo_url)
                            <img src="{{ asset('storage/' .$event->visualIdentity->logo_url) }}" alt=""
                                class="avatar-xl rounded-circle img-thumbnail">
                            @else
                            <img src="{{ URL::asset('build/images/logo-dark-sm.png') }}"
                                class="avatar-xl rounded-circle img-thumbnail" alt="Default logo">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-start mb-2">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Event Time Line</h5>
                        </div>
                        <div class="flex-shrink-0">
                            <a class="text-muted" href="">
                                <i class='bx bx-add-to-queue font-size-22'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-1">
                                <tbody>
                                    @forelse ($event->timeLine as $time)
                                    <tr>
                                        <!-- Title -->
                                        <td>
                                            <h6 class="font-size-14 m-0">
                                                <a href="javascript:void(0);" class="text-body">{{ $time->title }}</a>
                                            </h6>
                                        </td>
                                
                                        <!-- Description (Dropdown) -->
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                    aria-haspopup="true">
                                                    <i class="mdi mdi-chevron-down"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end p-3">
                                                    <p class="m-0 text-wrap text-break" style="max-width: 300px;">
                                                        {{ $time->description }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                
                                        <!-- Start Time -->
                                        <td>
                                            {{ \Carbon\Carbon::parse($time->start_time)->format('d M Y, h:i A') }}
                                        </td>
                                
                                        <!-- End Time -->
                                        @if ($time->end_time)
                                            <td>
                                                {{ \Carbon\Carbon::parse($time->end_time)->format('d M Y, h:i A')}}
                                            </td>
                                        @endif

                                
                                        <!-- Actions -->
                                        <td class="text-end">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('timeline.edit', $time->id) }}" class="btn btn-link text-success p-0">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <form action="{{ route('timeline.destroy', $time->id) }}" method="POST" class="d-inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this timeline entry?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0">
                                                        <i class="mdi mdi-delete font-size-18"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            <em>No timeline events to display.</em>
                                        </td>
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
                    <div class="d-flex align-items-start mb-2">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Assets & Skills Needs</h5>
                        </div>
                        <div class="flex-shrink-0">
                            <a class="text-muted" href="">
                                <i class='bx bx-add-to-queue font-size-22'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 pb-3">
                    <div>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-1">
                                <tbody>
                                    @forelse ($event->skillNeeds as $skill)
                                    <tr>
                                        <td style="width: 50px;">
                                            <i class="bx bx-extension font-size-24  align-middle me-1"></i>
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">{{ $skill->skillName->name }}</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-success-subtle text-success font-size-11">{{
                                                    $skill->quantity }}x</a>
                                            </div>
                                        </td>
                                        <td>
                                            Skill

                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <!-- Edit Link -->
                                                <!-- Edit Button -->
                                                <button type="button" class="btn btn-link text-success p-0"
                                                    data-bs-toggle="modal" data-bs-target="#editSkillModal"
                                                    data-id="{{ $skill->id }}" data-quantity="{{ $skill->quantity }}"
                                                    title="Edit">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </button>
                                                <!-- Delete Form -->
                                                <form method="POST" action="#" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0 m-0"
                                                        title="Delete"
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
                                            <h5 class="font-size-14 m-0"><a href="javascript: void(0);"
                                                    class="text-body">{{ $asset->assetable->name }}</a></h5>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="javascript: void(0);"
                                                    class="badge bg-success-subtle text-success font-size-11">{{
                                                    $asset->quantity }}x</a>
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
                                                <button type="button" class="btn btn-link text-success p-0"
                                                    data-bs-toggle="modal" data-bs-target="#editAssetModal"
                                                    data-id="{{ $asset->id }}" data-quantity="{{ $asset->quantity }}"
                                                    title="Edit">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </button>


                                                <form method="POST" action="{{ route('assetNeeds.destroy', $asset->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0 m-0" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this asset need?')">
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
                    <div class="d-flex align-items-start mb-2">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Team Members</h5>
                        </div>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-link text-muted p-0" data-bs-toggle="modal"
                                data-bs-target="#sendRequestModal">
                                <i class='bx bx-add-to-queue font-size-22'></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-1">
                            <tbody>
                                @if ($event->teams)
                                @forelse ($event->teams->members as $member)
                                <tr>
                                    <td style="width: 50px;">
                                        <img src="{{ $member->profile_picture ? asset('storage/' . $member->profile_picture) : URL::asset('build/images/users/avatar-3.jpg') }}"
                                            class="rounded-circle avatar-sm" alt="">
                                    </td>
                                    <td>
                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-body">{{
                                                $member->name }}</a></h5>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);"
                                                class="badge bg-primary-subtle text-primary font-size-11">{{
                                                $member->pivot->role }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        @if (Cache::has('user-is-online-' . $member->id))
                                        <i
                                            class="mdi mdi-circle-medium font-size-18 text-success align-middle me-1"></i>
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
        <div class="col-xl-7">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-xl-3 col-md-12">
                            <div class="pb-3 pb-xl-0">
                                <div class="position-relative">
                                    <h5 class="card-title mb-0">Event information</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-md-12">
                            <div class="text-sm-end">
                                <button id="edit-button" type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light me-2">
                                    <i class="bx bxs-pencil"></i> Edit
                                </button>

                                <button id="cancel-button" type="button"
                                    class="btn btn-danger  waves-effect waves-light d-none">
                                    <i class="bx bx-x"></i> Cancel
                                </button>
                                <button id="save-button" type="button"
                                    class="btn btn-outline-success  waves-effect waves-light d-none">
                                    <i class="bx bx-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="view-mode">
                        <dl class="row mb-0">
                            <dt class="col-sm-3">Event Title:</dt>
                            <dd class="col-sm-9">{{$event->name}}</dd>
                            <dt class="col-sm-3">Event Description:</dt>
                            <dd class="col-sm-9">
                                <div class="border p-2 bg-light rounded text-break">
                                    {!! nl2br(e($event->description)) !!}
                                </div>
                            </dd>

                            <dt class="col-sm-3">Start Date:</dt>
                            <dd class="col-sm-9">{{\Carbon\Carbon::parse($event->start_date)->format('M d, Y') ??
                                'N/A'}}
                            </dd>
                            <dt class="col-sm-3">End Date:</dt>
                            <dd class="col-sm-9">{{\Carbon\Carbon::parse($event->end_date)->format('M d, Y') ?? 'N/A'}}
                            </dd>



                            <dt class="col-sm-3 ">Event Domains:</dt>
                            <dd class="col-sm-9">
                                @foreach ($event->domains as $domain)
                                <dl class="row mb-0">
                                    <dt class="col-sm-4">{{$domain->name}}</dt>
                                    <dd class="col-sm-8">{{$domain->description}}</dd>
                                </dl>
                                @endforeach
                            </dd>
                            <dt class="col-sm-3 ">Event Categories:</dt>
                            <dd class="col-sm-9">
                                @foreach ($event->categories as $category)
                                <dl class="row mb-0">
                                    <dt class="col-sm-4">{{$category->name}}</dt>
                                    <dd class="col-sm-8">{{$category->description}}</dd>
                                </dl>
                                @endforeach
                            </dd>

                            <dt class="col-sm-3">Type</dt>
                            <dd class="col-sm-9 ">{{$event->type}}</dd>
                            <dt class="col-sm-3">privacy</dt>
                            <dd class="col-sm-9 ">{{$event->privacy ? "Private Event":"Public Event"}}</dd>
                            <dt class="col-sm-3">Offer a Certificate</dt>
                            <dd class="col-sm-9 ">{{$event->certificate? "Yes":"No"}}</dd>
                            <dt class="col-sm-3">Fee</dt>
                            <dd class="col-sm-9 ">
                                @if ($event->fee)
                                @forelse ($event->fees as $fee)
                                <dl class="row mb-0">
                                    <dt class="col-sm-4">{{$fee->type}}</dt>
                                    <dd class="col-sm-8">{{$fee->amount}} dz</dd>
                                </dl>
                                @empty
                                No Fees entred yet
                                @endforelse
                                @else
                                Free
                                @endif
                            </dd>
                        </dl>
                    </div>
                    <form id="edit-mode" class="d-none" action="{{ route('events.update', $event->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <dl class="row mb-0">
                            <dt class="col-sm-3">Event Title:</dt>
                            <dd class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="{{ $event->name }}">
                            </dd>
                            <dt class="col-sm-3">Event Description:</dt>
                            <dd class="col-sm-9">
                                <textarea name="description" class="form-control">{{ $event->description }}</textarea>
                            </dd>
                            <dt class="col-sm-3">Start Date:</dt>
                            <dd class="col-sm-9">
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') }}">
                            </dd>

                            <dt class="col-sm-3">End Date:</dt>
                            <dd class="col-sm-9">
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') }}">
                            </dd>
                            <!-- Categories Field -->
                            <dt class="col-sm-3">Event Categories:</dt>
                            <dd class="col-sm-9">
                                <select name="categories[]" class="form-control" multiple id="categories" data-choice>
                                    @foreach ($availableCategories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id,
                                        $event->categories->pluck('id')->toArray()) ?
                                        'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </dd>

                            <!-- Domains Field -->
                            <dt class="col-sm-3">Event Domains:</dt>
                            <dd class="col-sm-9">
                                <select name="domains[]" class="form-control" multiple id="domains" data-choice>
                                    @foreach ($availableDomains as $domain)
                                    <option value="{{ $domain->id }}" {{ in_array($domain->id,
                                        $event->domains->pluck('id')->toArray()) ? 'selected'
                                        : '' }}>
                                        {{ $domain->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </dd>
                            <dt class="col-sm-3">Type:</dt>
                            <dd class="col-sm-9">
                                <select name="type" class="form-control">
                                    <option value="online" {{ $event->type === 'online' ? 'selected' : '' }}>Online
                                    </option>
                                    <option value="in-person" {{ $event->type === 'in-person' ? 'selected' : ''
                                        }}>In-Person</option>
                                </select>
                            </dd>
                            <!-- Event Privacy (boolean) -->
                            <dt class="col-sm-3">Event Privacy:</dt>
                            <dd class="col-sm-9">
                                <div class="form-check">
                                    <!-- Privacy Checkbox -->
                                    <input type="hidden" name="privacy" value="0">
                                    <!-- Hidden input for unchecked case -->
                                    <input type="checkbox" name="privacy" value="1" {{ $event->privacy ? 'checked' : ''
                                    }} id="privacy" class="form-check-input">
                                    <label class="form-check-label" for="privacy">Private Event</label>
                                </div>
                            </dd>

                            <!-- Certificate (boolean) -->
                            <dt class="col-sm-3">Certificate:</dt>
                            <dd class="col-sm-9">
                                <div class="form-check">
                                    <!-- Certificate Checkbox -->
                                    <input type="hidden" name="certificate" value="0">
                                    <!-- Hidden input for unchecked case -->
                                    <input type="checkbox" name="certificate" value="1" {{ $event->certificate ?
                                    'checked' : '' }} id="certificate" class="form-check-input">
                                    <label class="form-check-label" for="certificate">Offer a Certificate</label>
                                </div>
                            </dd>
                            <dt class="col-sm-3">Fee:</dt>
                            <dd class="col-sm-9">
                                <div class="form-check">
                                    <!-- Fee Checkbox -->
                                    <input type="hidden" name="fee" value="0"> <!-- Hidden input for unchecked case -->
                                    <input type="checkbox" name="fee" value="1" {{ $event->fee ? 'checked' : '' }}
                                    id="fee-checkbox" class="form-check-input">
                                    <label for="fee-checkbox" class="form-check-label">Requires Fee</label>
                                </div>
                                <div id="fee-details" class="{{ $event->fee ? '' : 'd-none' }}">
                                    @forelse ($event->fees as $fee)
                                    <div class="d-flex align-items-center mb-2 fee-row">
                                        <input type="text" name="fee_types[]" class="form-control me-2"
                                            value="{{ $fee->type }}" placeholder="Fee Type">
                                        <input type="number" name="fee_amounts[]" class="form-control"
                                            value="{{ $fee->amount }}" placeholder="Amount (DZ)">
                                        <button type="button" class="btn btn-danger btn-sm remove-fee">Remove</button>
                                    </div>
                                    @empty
                                    <div class="d-flex align-items-center mb-2 ">
                                        <input type="text" name="fee_types[]" class="form-control me-2"
                                            placeholder="Fee Type">
                                        <input type="number" name="fee_amounts[]" class="form-control"
                                            placeholder="Amount (DZ)">
                                        <button type="button" class="btn btn-danger btn-sm remove-fee">Remove</button>
                                    </div>
                                    @endforelse

                                </div>
                                <button type="button" id="add-fee" class="btn btn-success btn-sm">Add Fee</button>
                            </dd>
                        </dl>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">

                    <div class="">
                        <div class="row mb-2">
                            <div class="col-xl-3 col-md-12">
                                <div class="pb-3 pb-xl-0">
                                    <div class="position-relative">

                                        <h5 class="card-title mb-0">Event Tasks</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-md-12">
                                <div class="text-sm-end">
                                    <button type="button"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        data-bs-toggle="modal" data-bs-target=".create-task"><i
                                            class="mdi mdi-plus me-1"></i>
                                        Create Task</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive" style="min-height: 290px">
                        <table class="table table-nowrap align-middle">
                            <tbody>
                                @forelse ($event->tasks as $task)
                                <tr>
                                    <td style="width: 40px;">
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="taskCheck{{ $task->id }}" {{ $task->category !== 'Waiting' ?
                                            'checked' : '' }}
                                            onchange="toggleTaskCategory(this, {{ $task->id }})">
                                            <label class="form-check-label" for="taskCheck{{ $task->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 m-0">
                                            <a href="javascript:void(0);" class="text-body">{{ $task->title }}</a>
                                        </h5>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                                aria-haspopup="true">
                                                description <i class="mdi mdi-chevron-down"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-md p-3">
                                                <p class="m-1 text-wrap text-break" style="max-width: 40ch;">
                                                    {{ $task->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0" id="task-category-{{ $task->id }}">
                                            @if ($task->category == 'Waiting')
                                            <span
                                                class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>
                                            @else
                                            <span
                                                class="badge rounded-pill bg-success-subtle text-success font-size-11">Completed</span>
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        <p class="mb-0">
                                            {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') ?? 'N/A' }}
                                        </p>
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            @forelse ($task->users as $user)
                                            <div class="avatar-group-item">
                                                <a href="javascript:void(0);" class="d-inline-block">
                                                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : URL::asset('build/images/users/avatar-3.jpg') }}"
                                                        alt="{{ $user->name }}" class="rounded-circle avatar-sm">
                                                </a>
                                            </div>
                                            @empty
                                            <p class="mb-0">No Assignees</p>
                                            @endforelse
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No tasks have created yet for this
                                        event.</td>
                                </tr>
                                @endforelse
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
                    <form action="{{ route('task.store', $event->id) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task-Name">Task Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Enter Task Name"
                                        id="CreateTask-Task-Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Team-Member">Team Member</label>
                                    <select class="form-select" name="assigned_users[]" id="CreateTask-Team-Member"
                                        multiple required>
                                        @foreach ($event->teams->members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date</label>
                                    <input type="text" class="form-control" name="due_date"
                                        placeholder="Select Due Date" id="CreateTask-due-date">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="CreateTask-Task Description">Task
                                        Description</label>
                                    <textarea class="form-control" name="description" id="projectdesc" rows="3"
                                        placeholder="Enter Task Description..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                        class="bx bx-x me-1 align-middle"></i> Cancel</button>
                                <button type="submit" class="btn btn-success"><i
                                        class="bx bx-check me-1 align-middle"></i> Confirm</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
                <form id="editSkillForm" method="POST" action="{{ route('event-skill-need.update') }}">
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

    <!-- Modal for Sending Request -->
    <div class="modal fade" id="sendRequestModal" tabindex="-1" aria-labelledby="sendRequestModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="sendRequestForm" method="POST" action="{{ route('teams.requests.send') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="sendRequestModalLabel">Invite Member to Team</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="team_id" id="teamId" value="{{ $event->teams->id }}">

                        <div class="mb-3">
                            <label for="userEmail" class="form-label">User Email</label>
                            <input type="email" class="form-control" id="userEmail" name="email"
                                placeholder="Enter user's email" required>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="Member">Member</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Send Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal -->
    @endsection
    @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const categories = new Choices('#categories', {
            removeItemButton: true,
            searchEnabled: true,
            itemSelectText: 'Press to select', // Custom selection text
            maxItemCount: 5, // Limit the number of selected items
            placeholder: true, // Enable placeholder text
            placeholderValue: 'Choose categories...'
            });
            
            const domains = new Choices('#domains', {
            removeItemButton: true,
            searchEnabled: true,
            itemSelectText: 'Press to select', // Custom selection text
            maxItemCount: 5, // Limit the number of selected items
            placeholder: true, // Enable placeholder text
            placeholderValue: 'Choose domains...'
            });
            const feeDetailsContainer = document.getElementById('fee-details');
            const addFeeButton = document.getElementById('add-fee');
            
            // Add new fee row
            addFeeButton.addEventListener('click', () => {
            const newFeeRow = document.createElement('div');
            newFeeRow.className = 'd-flex align-items-center mb-2 fee-row';
            newFeeRow.innerHTML = `
            <input type="text" name="fee_types[]" class="form-control me-2" placeholder="Fee Type">
            <input type="number" name="fee_amounts[]" class="form-control me-2" placeholder="Amount (DZ)">
            <button type="button" class="btn btn-danger btn-sm remove-fee">Remove</button>
            `;
            feeDetailsContainer.appendChild(newFeeRow);
            });
            
            // Remove fee row
            feeDetailsContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-fee')) {
            const feeRow = event.target.closest('.fee-row');
            if (feeRow) {
            feeRow.remove();
            }
            }
            });
            
            // Show/hide fee details based on checkbox state
            const feeCheckbox = document.getElementById('fee-checkbox');
            feeCheckbox.addEventListener('change', () => {
            if (feeCheckbox.checked) {
            feeDetailsContainer.classList.remove('d-none');
            } else {
            feeDetailsContainer.classList.add('d-none');
            }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const editButton = document.getElementById('edit-button');
        const saveButton = document.getElementById('save-button');
        const cancelButton = document.getElementById('cancel-button');
        const viewMode = document.getElementById('view-mode');
        const editMode = document.getElementById('edit-mode');
        
        // Switch to edit mode
        editButton.addEventListener('click', function () {
        viewMode.classList.add('d-none');
        editMode.classList.remove('d-none');
        editButton.classList.add('d-none');
        saveButton.classList.remove('d-none');
        cancelButton.classList.remove('d-none');
        });
        
        // Switch back to view mode (cancel changes)
        cancelButton.addEventListener('click', function () {
        editMode.classList.add('d-none');
        viewMode.classList.remove('d-none');
        editButton.classList.remove('d-none');
        saveButton.classList.add('d-none');
        cancelButton.classList.add('d-none');
        });
        
        // Submit the form when Save button is clicked
        saveButton.addEventListener('click', function () {
        editMode.submit();
        });
        });
    </script>
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- datepicker js -->
    <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <!--  -->
    <script src="{{ URL::asset('build/js/pages/todo.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                    new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                const teamMemberSelect = document.getElementById('CreateTask-Team-Member');

                if (teamMemberSelect) {
                    new Choices(teamMemberSelect, {
                        removeItemButton: true,
                        placeholder: true,
                        placeholderValue: 'Select team members...',
                        searchPlaceholderValue: 'Type to search team members...',
                    });
                }
            });
    </script>
    <script>
        function toggleTaskCategory(checkbox, taskId) {
                const isChecked = checkbox.checked;
                const category = isChecked ? 'Completed' : 'Waiting';

                fetch(`/tasks/${taskId}/update-category`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            category: category
                        })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Failed to update task category');
                        return response.json();
                    })
                    .then(data => {
                        console.log(data.message);

                        // Update the badge dynamically
                        const categoryElement = document.getElementById(`task-category-${taskId}`);
                        if (category === 'Completed') {
                            categoryElement.innerHTML = `<span
        class="badge rounded-pill bg-success-subtle text-success font-size-11">Completed</span>`;
                        } else {
                            categoryElement.innerHTML = `<span
        class="badge rounded-pill bg-secondary-subtle text-secondary font-size-11">Waiting</span>`;
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        alert('An error occurred while updating the task category.');
                    });
            }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
                const editAssetModal = document.getElementById('editAssetModal');
                const assetForm = document.getElementById('editAssetForm');
                const quantityInput = document.getElementById('quantity');
                const assetIdInput = document.getElementById('assetId');

                editAssetModal.addEventListener('show.bs.modal', function(event) {
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
        document.addEventListener('DOMContentLoaded', function() {
                const editSkillModal = document.getElementById('editSkillModal');
                const skillForm = document.getElementById('editSkillForm');
                const skillQuantityInput = document.getElementById('skillQuantity');
                const skillIdInput = document.getElementById('skillId');

                editSkillModal.addEventListener('show.bs.modal', function(event) {
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        let cropper;
        const fileUpload = document.getElementById('file-upload');
        const imagePreview = document.getElementById('image-preview');
        const cropperModal = new bootstrap.Modal(document.getElementById('cropperModal'));
        const croppedImageInput = document.getElementById('cropped-image');
        const cropAndSubmitBtn = document.getElementById('crop-and-submit');

        // Trigger file input when clicking a button
        document.getElementById('choose-file-button').addEventListener('click', function () {
            fileUpload.click();
        });

        // When user selects a file
        fileUpload.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;

                    // Open modal for cropping
                    cropperModal.show();

                    // Initialize Cropper.js with a 16:9 aspect ratio
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(imagePreview, {
                        aspectRatio: 16 / 9,
                        viewMode: 1,
                        minContainerWidth: 300,
                        minContainerHeight: 200,
                        responsive: true,
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        // When the user clicks "Crop & Submit"
        cropAndSubmitBtn.addEventListener('click', function (event) {
            event.preventDefault();

            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 1600, // Adjust to your preferred resolution
                    height: 900,
                });

                // Convert the canvas to a Base64-encoded image and set it as the value of the hidden input
                canvas.toBlob(function (blob) {
                    const reader = new FileReader();
                    reader.onloadend = function () {
                        croppedImageInput.value = reader.result; // Set the cropped image as a base64 string

                        // Submit the form
                        document.getElementById('banner-form').submit();
                    };
                    reader.readAsDataURL(blob);
                });
            }
        });
    });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let cropper;
            const logoFileUpload = document.getElementById('logo-file-upload');
            const logoImagePreview = document.getElementById('logo-image-preview');
            const logoCropperModal = new bootstrap.Modal(document.getElementById('logoCropperModal'));
            const croppedLogoInput = document.getElementById('cropped-logo');
            const cropLogoButton = document.getElementById('crop-logo-button');
    
            // Trigger file input when clicking a button
            document.getElementById('choose-logo-file-button').addEventListener('click', function () {
                logoFileUpload.click();
            });
    
            // When user selects a file
            logoFileUpload.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        logoImagePreview.src = e.target.result;
    
                        // Open modal for cropping
                        logoCropperModal.show();
    
                        // Initialize Cropper.js with a 1:1 aspect ratio
                        if (cropper) {
                            cropper.destroy();
                        }
                        cropper = new Cropper(logoImagePreview, {
                            aspectRatio: 1, // 1:1 aspect ratio for logos
                            viewMode: 1,
                            minContainerWidth: 300,
                            minContainerHeight: 300,
                            responsive: true,
                        });
                    };
                    reader.readAsDataURL(file);
                }
            });
    
            // When the user clicks "Crop & Submit"
            cropLogoButton.addEventListener('click', function (event) {
                event.preventDefault();
    
                if (cropper) {
                    const canvas = cropper.getCroppedCanvas({
                        width: 300, // Adjust to your preferred resolution
                        height: 300,
                    });
    
                    // Convert the canvas to a Base64-encoded image and set it as the value of the hidden input
                    canvas.toBlob(function (blob) {
                        const reader = new FileReader();
                        reader.onloadend = function () {
                            croppedLogoInput.value = reader.result; // Set the cropped image as a base64 string
    
                            // Submit the form
                            document.getElementById('logo-upload-form').submit();
                        };
                        reader.readAsDataURL(blob);
                    });
                }
            });
        });
    </script>
    @endsection