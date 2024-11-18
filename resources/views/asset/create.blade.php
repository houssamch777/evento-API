@extends('layouts.master')
@section('title')
    Form Advanced
@endsection
@section('css')
    <!-- Include Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
@endsection
@section('page-title')
    Form Advanced
@endsection
@section('body')

    <body>
    @endsection
    @section('content')

        <x-breadcrub :title="'Create'" :link="route('asset.index')" :pagetitle="'My Assets'" />
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
        <form action="{{ route('asset.store') }}" method="POST" enctype="multipart/form-data">
            <!-- CSRF Token -->
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="mt-4">

                                <h5 class="mt-4 mb-3">Asset Type</h5>
                                <!-- Asset Type Selection -->
                                <div class="row">
                                    @foreach (['equipment' => 'wrench', 'room' => 'home-alt', 'furniture' => 'cube', 'transportation' => 'car'] as $type => $icon)
                                        <div class="col-lg-3 col-sm-6">
                                            <label class="card-radio-label">
                                                <input type="radio" name="asset_type" value="{{ $type }}"
                                                    class="card-radio-input" onchange="toggleFields('{{ $type }}')">
                                                <span class="card-radio py-3 text-center text-truncate">
                                                    <i class="bx bx-{{ $icon }} d-block h2 mb-3"></i>
                                                    {{ $type }}
                                                </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <h5 class="my-3">General Information</h5>
                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" placeholder="Enter asset name">
                                            <div class="invalid-feedback">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Wilaya -->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="location" class="form-label">Wilaya</label>
                                            <select class="form-control @error('location') is-invalid @enderror"
                                                id="location" name="location">
                                                <option value="" disabled selected>Select your wilaya</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->name }}"
                                                        {{ old('location') == $location->name ? 'selected' : '' }}>
                                                        {{ $location->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                @error('location')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*" onchange="previewImage(event)">
                                    <div class="invalid-feedback">
                                        @error('image')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <img id="imagePreview" src="#" alt="Image Preview"
                                            style="display: none; max-width: 200px;" />
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="3" placeholder="Enter asset description"></textarea>
                                    <div class="invalid-feedback">
                                        @error('description')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <!-- Daily Rental Price -->
                                <div class="mb-3">
                                    <label for="daily_rental_price" class="form-label">Daily Rental Price (DA)</label>
                                    <input type="number"
                                        class="form-control @error('daily_rental_price') is-invalid @enderror"
                                        id="daily_rental_price" name="daily_rental_price"
                                        placeholder="Enter rental price per day" min="0" step="0.01">
                                    <div class="invalid-feedback">
                                        @error('daily_rental_price')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <!-- Dynamic Fields for Each Asset Type -->
                                <div id="typeSpecificFields">
                                    <!-- Equipment Fields -->
                                    <div id="equipmentFields" class="type-fields" style="display: none;">
                                        <h6 class="mt-3">Equipment Details</h6>
                                        <div class="mb-3">
                                            <label for="equipmentCategory" class="form-label">Equipment Category</label>
                                            <select class="form-control" id="equipmentCategory"
                                                name="equipment_category_id">
                                                <option value="">Select Equipment Category</option>
                                                @foreach ($equipmentCategories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="equipmentQuantity" class="form-label">Available Quantity</label>
                                            <input type="number" class="form-control" id="equipmentQuantity"
                                                name="equipment_available_quantity" placeholder="Enter available quantity"
                                                min="0">
                                        </div>
                                        <div class="mb-3">
                                            <label for="equipmentCondition" class="form-label">Condition</label>
                                            <select class="form-control" id="equipmentCondition" name="condition">
                                                <option value="">Select Condition</option>
                                                <option value="new">New</option>
                                                <option value="used">Used</option>
                                                <option value="damaged">Damaged</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Room Fields -->
                                    <div id="roomFields" class="type-fields" style="display: none;">
                                        <h6 class="mt-3">Room Details</h6>
                                        <div class="mb-3">
                                            <label for="roomCategory" class="form-label">Room Category</label>
                                            <select class="form-control" id="roomCategory" name="room_category_id">
                                                <option value="">Select Room Category</option>
                                                @foreach ($roomCategories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="room_capacity" class="form-label">Capacity</label>
                                            <input type="number" class="form-control" id="room_capacity"
                                                name="room_capacity" placeholder="Enter room capacity" min="0">

                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <h5 class="font-size-14 mb-3">Facilities</h5>
                                                <div class="d-flex flex-wrap gap-3 align-items-center">
                                                    <select id="facilities-select" name="facilities[]" multiple>
                                                        @foreach ($facilities as $facility)
                                                            <option value="{{ $facility->name }}">{{ $facility->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('facilities')
                                                        <div class="invalid-feedback d-block">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Furniture Fields -->
                                    <div id="furnitureFields" class="type-fields" style="display: none;">
                                        <h6 class="mt-3">Furniture Details</h6>
                                        <div class="mb-3">
                                            <label for="furnitureCategory" class="form-label">Furniture Category</label>
                                            <select class="form-control" id="furnitureCategory"
                                                name="furniture_category_id">
                                                <option value="">Select Furniture Category</option>
                                                @foreach ($furnitureCategories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="furnitureQuantity" class="form-label">Available Quantity</label>
                                            <input type="number" class="form-control" id="furnitureQuantity"
                                                name="furniture_available_quantity" placeholder="Enter available quantity"
                                                min="0">
                                        </div>
                                    </div>

                                    <!-- Transportation Fields -->
                                    <div id="transportationFields" class="type-fields" style="display: none;">
                                        <h6 class="mt-3">Transportation Details</h6>
                                        <div class="mb-3">
                                            <label for="transportationCategory" class="form-label">Transportation
                                                Category</label>
                                            <select class="form-control" id="transportationCategory"
                                                name="transportation_category_id">
                                                <option value="">Select Transportation Category</option>
                                                @foreach ($transportationCategories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="transportation_capacity" class="form-label">Capacity</label>
                                            <input type="number" class="form-control" id="transportation_capacity"
                                                name="transportation_capacity"
                                                placeholder="Enter capacity (e.g., kg or passengers)" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="mt-4  text-end">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    @endsection
    @section('scripts')
        <!-- Include Choices.js JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
        <script>
            // Initialize Choices.js on the select element
            const choices = new Choices('#facilities-select', {
                removeItemButton: true,
                searchEnabled: true,
                placeholderValue: 'Select facilities...',
            });

            function toggleFields(type) {
                document.querySelectorAll('.type-fields').forEach(field => field.style.display = 'none');
                document.getElementById(type + 'Fields').style.display = 'block';
            }

            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const img = document.getElementById('imagePreview');
                    img.src = reader.result;
                    img.style.display = 'block';
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
