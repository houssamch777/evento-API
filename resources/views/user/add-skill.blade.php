@extends('layouts.master')
@section('title')
    Add New Skill
@endsection
@section('css')
    <!-- choices css -->
    <link href="{{ URL::asset('build/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- dropzone css -->
    <link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Add New Skill
@endsection
@section('body')

    <body>
    @endsection
    @section('content')

    <form action="{{ route('skills.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div id="addskill-accordion" class="custom-accordion">
                    <div class="card">
                        <a href="#addskill-info-collapse" class="text-body" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="addskill-info-collapse">
                            <div class="p-4">

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                <h5 class="text-primary font-size-17 mb-0">01</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Skill Information</h5>
                                        <p class="text-muted text-truncate mb-0">Fill in the skill details below</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>

                        <div id="addskill-info-collapse" class="collapse show"
                            data-bs-parent="#addskill-accordion">
                            <div class="p-4 border-top">
                                
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Skill Name</label>
                                        <input id="name" name="name" placeholder="Enter Skill Name" type="text" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="experience">Experience Level</label>
                                                <select id="experience" name="experience" class="form-control">
                                                    <option value="Beginner">Beginner</option>
                                                    <option value="Intermediate">Intermediate</option>
                                                    <option value="Expert">Expert</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="offer_as_service">Offer as a Service</label>
                                                <select id="offer_as_service" name="offer_as_service" class="form-control">
                                                    <option value="1">Yes</option>
                                                    <option value="0" selected>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="cost">Skill Cost</label>
                                                <input id="cost" name="cost" placeholder="Enter Cost" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="cost_type">Cost Type</label>
                                                <select id="cost_type" name="cost_type" class="form-control">
                                                    <option value="per_hour">Per Hour</option>
                                                    <option value="per_task">Per Project</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="portfolio_url">Skill portfolio_url</label>
                                                <input id="portfolio_url" name="portfolio_url" placeholder="Enter portfolio URL" type="url" class="form-control">
                                            </div>
                                        </div>
                                    </div>
    
                                
                            </div>
                        </div>
                    </div>

                    <div class="card" id="availability-card" style="display: none;">
                        <a href="#addproduct-img-collapse" class="text-body collbodyd" data-bs-toggle="collapse"
                            aria-haspopup="true" aria-expanded="false" aria-haspopup="true"
                            aria-controls="addproduct-img-collapse">
                            <div class="p-4">

                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <div class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                <h5 class="text-primary font-size-17 mb-0">02</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Availability</h5>
                                                    <p class="text-muted text-truncate mb-0">Set your availability for specific days and times</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                    </div>

                                </div>

                            </div>
                        </a>

                        <div id="addproduct-img-collapse" class="collapse" data-bs-parent="#addskill-accordion">
                            <div class="p-4 border-top">
                                
                                    <div id="availability-container">
                                        <!-- Availability Row -->
                                        <div class="availability-row row mb-3">
                                            <div class="col-md-3">
                                                <label for="day" class="form-label">Day</label>
                                                <select class="form-control" name="day[]">
                                                    <option value="Mo">Monday</option>
                                                    <option value="Tu">Tuesday</option>
                                                    <option value="We">Wednesday</option>
                                                    <option value="Th">Thursday</option>
                                                    <option value="Fr">Friday</option>
                                                    <option value="Sa">Saturday</option>
                                                    <option value="Su">Sunday</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="start-time" class="form-label">Start Time</label>
                                                <input type="time" name="start_time[]" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="end-time" class="form-label">End Time</label>
                                                <input type="time" name="end_time[]" class="form-control">
                                            </div>
                                            <div class="col-md-3 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add Availability Button -->
                                    <button type="button" id="add-availability" class="btn btn-secondary mt-3">Add Availability</button>
                                
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        

            <div class="row mb-4">
                        <div class="col text-end">
                            <a href="#" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Cancel </a>
                            
                            <button type="submit" class="btn btn-success"> <i class="bx bx-file me-1"></i> Save </button>
                        </div> <!-- end col -->
            </div> <!-- end col -->
        </div> <!-- end row-->
    </form>   
    @endsection
    @section('scripts')
        <!-- choices js -->
        <script src="{{ URL::asset('build/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

        <!-- dropzone plugin -->
        <script src="{{ URL::asset('build/libs/dropzone/dropzone-min.js') }}"></script>

        <!-- init js -->
        <script src="{{ URL::asset('build/js/pages/ecommerce-choices.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Show/Hide Availability section based on "Offer as a Service"
                const offer_as_serviceSelect = document.getElementById('offer_as_service');
                const availabilityCard = document.getElementById('availability-card');
    
                offer_as_serviceSelect.addEventListener('change', function () {
                    if (this.value == '1') {
                        availabilityCard.style.display = 'block'; // Show Availability Card
                    } else {
                        availabilityCard.style.display = 'none'; // Hide Availability Card
                    }
                });
    
                // Handle Add Availability
                const addAvailabilityButton = document.getElementById('add-availability');
                const availabilityContainer = document.getElementById('availability-container');
    
                addAvailabilityButton.addEventListener('click', function () {
                    const availabilityRow = `
                    <div class="availability-row row mb-3">
                        <div class="col-md-3">
                            <label for="day" class="form-label">Day</label>
                            <select class="form-control" name="day[]">
                                <option value="Mo">Monday</option>
                                <option value="Tu">Tuesday</option>
                                <option value="We">Wednesday</option>
                                <option value="Th">Thursday</option>
                                <option value="Fr">Friday</option>
                                <option value="Sa">Saturday</option>
                                <option value="Su">Sunday</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="start-time" class="form-label">Start Time</label>
                            <input type="time" name="start_time[]" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="end-time" class="form-label">End Time</label>
                            <input type="time" name="end_time[]" class="form-control">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                        </div>
                    </div>
                `;
                    availabilityContainer.insertAdjacentHTML('beforeend', availabilityRow);
                });
    
                // Handle Remove Availability Row
                availabilityContainer.addEventListener('click', function (e) {
                    if (e.target.classList.contains('remove-row')) {
                        e.target.closest('.availability-row').remove();
                    }
                });
            });
        </script>
    @endsection
