@extends('layouts.master')
@section('title')
    event create
@endsection
@section('css')
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
    <!-- choices css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
@endsection
@section('page-title')
    New Event Create
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <x-breadcrub :title="'Create'" :link="route('myEvents')" :pagetitle="'My Event'" />
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
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Event creation Steps</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form action="{{ route('events.store') }}" method="POST" id="yourFormId">
                            @csrf
                            <ul class="wizard-nav mb-5">
                                <li class="wizard-list-item">
                                    <div class="list-item">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Seller Details">
                                            <i class="bx bx-user-circle"></i>
                                        </div>
                                    </div>
                                </li>
                                <li class="wizard-list-item">
                                    <div class="list-item">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Company Document">
                                            <i class="bx bx-file"></i>
                                        </div>
                                    </div>
                                </li>

                                <li class="wizard-list-item">
                                    <div class="list-item">
                                        <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Bank Details">
                                            <i class="bx bx-edit"></i>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- wizard-nav -->

                            <div class="wizard-tab">
                                <div class="text-center mb-4">
                                    <h5>Event Details</h5>
                                    <p class="card-title-desc">Fill all the information below</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <!-- Event Name and Date -->
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="mb-3">
                                                    <label for="event-name-input" class="form-label">Event Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('event_name') is-invalid @enderror"
                                                        placeholder="Enter Event Name" id="event-name-input" name="name"
                                                        value="{{ old('name') }}">
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="datepicker-range" class="form-label">Start and End Date
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Select Date Range" id="datepicker-range"
                                                        name="date">
                                                    @error('date')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Event Type and Privacy -->
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="event-type-switch" class="form-label">Event Type</label>
                                                    <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="event-type-switch" checked name="type">
                                                        <label class="form-check-label" for="event-type-switch">
                                                            <span class="text-success">In Person</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="event-privacy-switch" class="form-label">Privacy</label>
                                                    <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="event-privacy-switch" checked name="privacy">
                                                        <label class="form-check-label" for="event-privacy-switch">
                                                            <span class="text-success">Private</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="event-certificate-switch"
                                                        class="form-label">Certificate</label>
                                                    <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="event-certificate-switch" checked name="certificate">
                                                        <label class="form-check-label" for="event-certificate-switch">
                                                            <span class="text-success">Certified</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="event-fee-switch" class="form-label">Fee</label>
                                                    <div class="form-check form-switch form-switch-lg mb-3"
                                                        dir="ltr">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="event-fee-switch" name="fee">
                                                        <label class="form-check-label" for="event-fee-switch">
                                                            <span class="text-success">Fees Required</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Dynamic Fee Input -->
                                        <div class="row" id="fees-section" style="display: none;">
                                            <div class="col-lg-12">
                                                <div id="fee-list">
                                                    <div class="fee-entry mb-3">
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <label for="event-fee-type" class="form-label">Fee
                                                                    Type</label>
                                                                <input type="text" class="form-control fee-type"
                                                                    name="fees[0][type]"
                                                                    placeholder="Enter Fee Type (e.g. Early Bird)"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label for="event-fee-amount"
                                                                    class="form-label">Amount</label>
                                                                <input type="number" class="form-control fee-amount"
                                                                    name="fees[0][amount]" placeholder="Enter Amount"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-2">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-primary" id="add-fee-btn">Add
                                                    Another Fee</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Event Description -->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="event-description-input" class="form-label">Event Description
                                                <span class="text-danger">*</span></label>
                                            <textarea id="event-description-input" class="form-control" placeholder="Enter Event Description" rows="3"
                                                required name="description"></textarea>
                                            <div class="invalid-feedback">Please provide a description for the event.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="wizard-tab">
                                <div class="text-center mb-4">
                                    <h5>Event Categories and Domains</h5>
                                    <p class="card-title-desc">Select relevant categories and domains for your event</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <!-- Event Categories -->
                                        <div class="mb-3">
                                            <label for="event-categories" class="form-label">Categories <span
                                                    class="text-danger">*</span></label>
                                            <select id="event-categories" class="form-control" multiple
                                                name="categories[]" required>
                                                @foreach ($categories as $Category)
                                                    <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select at least one category.</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <!-- Event Domains -->
                                        <div class="mb-3">
                                            <label for="event-domains" class="form-label">Domains <span
                                                    class="text-danger">*</span></label>
                                            <select id="event-domains" class="form-control" multiple name="domains[]"
                                                required>
                                                @foreach ($domains as $domain)
                                                    <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                                                @endforeach

                                            </select>
                                            <div class="invalid-feedback">Please select at least one domain.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- wizard-tab -->

                            <div class="wizard-tab">
                                <div class="text-center mb-4">
                                    <h5>Event Needs</h5>
                                    <p class="card-title-desc">Specify the assets and skills required for your event</p>
                                </div>
                                <div class="row">
                                    <!-- Assets Section -->
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <h6>Assets</h6>
                                            <div id="asset-needs-container">
                                                <!-- Template for Adding Asset Needs -->
                                                <div class="row mb-3 align-items-end asset-row">
                                                    <div class="col-lg-4">
                                                        <label for="asset-type-1" class="form-label">Asset Type</label>
                                                        <select class="form-select asset-type" id="asset-type-1"
                                                            name="assets[0][type]" onchange="loadAssets(1)">
                                                            <option value="Furniture" selected>Furniture</option>
                                                            <option value="Equipment">Equipment</option>
                                                            <option value="Venue">Venue</option>
                                                            <option value="Transportation">Transportation</option>
                                                        </select>
                                                    </div>

                                                    <!-- Asset Name Dropdown (Initially Empty) -->
                                                    <div class="col-lg-4">
                                                        <label for="asset-id-1" class="form-label">Asset Name</label>
                                                        <select class="form-select asset-id" id="asset-id-1"
                                                            name="assets[0][id]">
                                                            @foreach ($furnitureCategories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <label for="asset-quantity-1" class="form-label">Quantity</label>
                                                        <input type="number" class="form-control asset-quantity"
                                                            id="asset-quantity-1" min="1" value="1"
                                                            name="assets[0][quantity]">
                                                    </div>

                                                    <div class="col-lg-2">

                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-success" id="add-asset-btn">Add
                                                Asset</button>
                                        </div>
                                    </div>

                                    <!-- Skills Section -->
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <h6>Skills</h6>
                                            <div id="skill-needs-container">
                                                <!-- Template for Adding Skill Needs -->
                                                <div class="row mb-3 align-items-end skill-row">
                                                    <div class="col-lg-6">
                                                        <label for="skill-name-1" class="form-label">Skill Name</label>
                                                        <select class="form-select skill-name" id="skill-name-1"
                                                            name="skills[0][name]">
                                                            @foreach ($skills as $skill)
                                                                <option value="{{ $skill->id }}">{{ $skill->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label for="skill-quantity-1" class="form-label">Quantity</label>
                                                        <input type="number" class="form-control skill-quantity"
                                                            id="skill-quantity-1" min="1" value="1"
                                                            name="skills[0][quantity]">
                                                    </div>
                                                    <div class="col-lg-2">

                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-success" id="add-skill-btn">Add
                                                Skill</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- wizard-tab -->

                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" class="btn btn-primary w-sm" id="prevBtn"
                                    onclick="nextPrev(-1)">Previous</button>
                                <button type="button" class="btn btn-primary w-sm ms-auto" id="nextBtn"
                                    onclick="nextPrev(1)">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    @endsection
    @section('scripts')
        <!-- datepicker js -->
        <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
        <!-- form wizard init -->
        <script>
            var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab
            function showTab(n) {
                // This function will display the specified tab of the form...
                var x = document.getElementsByClassName("wizard-tab");
                x[n].style.display = "block";
                //... and fix the Previous/Next buttons:
                if (n == 0) {
                    document.getElementById("prevBtn").style.display = "none";
                } else {
                    document.getElementById("prevBtn").style.display = "inline";
                }
                if (n == (x.length - 1)) {
                    document.getElementById("nextBtn").innerHTML = "Submit";
                } else {
                    document.getElementById("nextBtn").innerHTML = "Next";
                }
                //... and run a function that will display the correct step indicator:
                fixStepIndicator(n)
            }

            function nextPrev(n) {
                // This function will figure out which tab to display
                var x = document.getElementsByClassName("wizard-tab");

                // Hide the current tab:
                x[currentTab].style.display = "none";
                // Increase or decrease the current tab by 1:
                currentTab = currentTab + n;
                // if you have reached the end of the form...
                if (currentTab === x.length) {
                    document.getElementById("yourFormId").submit();
                    currentTab = currentTab - n;
                }
                if (currentTab > x.length) {
                    currentTab = currentTab - n;
                    x[currentTab].style.display = "block";
                }

                // Otherwise, display the correct tab:
                showTab(currentTab)
            }

            function fixStepIndicator(n) {
                // This function removes the "active" class of all steps...

                var i, x = document.getElementsByClassName("list-item");

                for (i = 0; i < x.length; i++) {
                    x[i].className = x[i].className.replace(" active", "");
                }

                //... and adds the "active" class on the current step:

                x[n].className += " active";
            }

            // flatpickr

            flatpickr('#datepicker-basic');
        </script>
        <script>
            // Predefined assets for each category
            const assetCategories = {
                Furniture: @json($furnitureCategories->toArray()),
                Equipment: @json($equipmentCategories->toArray()),
                Venue: @json($roomCategories->toArray()),
                Transportation: @json($transportationCategories->toArray())
            };

            let assetCount = document.querySelectorAll('.asset-row').length; // Track the number of rows

            // Function to load assets based on the selected asset type
            function loadAssets(index) {
                const assetType = document.getElementById('asset-type-' + index).value;
                const assetSelect = document.getElementById('asset-id-' + index);

                // Clear the existing options
                assetSelect.innerHTML = '<option value="">Select Asset</option>';

                // Fetch assets based on the selected asset type
                const assets = assetCategories[assetType] || [];

                if (assets.length > 0) {
                    assets.forEach(asset => {
                        const option = document.createElement('option');
                        option.value = asset.id;
                        option.textContent = asset.name;
                        assetSelect.appendChild(option);
                    });
                } else {
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'No assets available';
                    assetSelect.appendChild(option);
                }
            }

            // Add new asset row
            document.getElementById('add-asset-btn').addEventListener('click', function() {
                assetCount++;

                const assetRow = `
        <div class="row mb-3 align-items-end asset-row" id="asset-row-${assetCount}">
            <div class="col-lg-4">
                <label for="asset-type-${assetCount}" class="form-label">Asset Type</label>
                <select class="form-select asset-type" id="asset-type-${assetCount}" name="assets[${assetCount}][type]"  onchange="loadAssets(${assetCount})">
                    <option value="">Select Type</option>
                    <option value="Furniture">Furniture</option>
                    <option value="Equipment">Equipment</option>
                    <option value="Venue">Venue</option>
                    <option value="Transportation">Transportation</option>
                </select>
            </div>
            <div class="col-lg-4">
                <label for="asset-id-${assetCount}" class="form-label">Asset</label>
                <select class="form-select asset-id" id="asset-id-${assetCount}" name="assets[${assetCount}][id]">
                    <option value="">Select Asset</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label for="asset-quantity-${assetCount}" class="form-label">Quantity</label>
                <input type="number" class="form-control asset-quantity" id="asset-quantity-${assetCount}"  min="1" value="1" name="assets[${assetCount}][quantity]">
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-danger remove-asset" onclick="removeAssetRow(${assetCount})">Remove</button>
            </div>
        </div>
        `;
                document.getElementById('asset-needs-container').insertAdjacentHTML('beforeend', assetRow);
            });

            // Function to remove an asset row
            function removeAssetRow(index) {
                const row = document.getElementById('asset-row-' + index);
                if (row) row.remove();
            }
        </script>
        <!-- choices js -->
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
        <script>
            // Initialize Choices.js for Categories and Domains
            document.addEventListener('DOMContentLoaded', function() {
                const categorySelect = new Choices('#event-categories', {
                    removeItemButton: true,
                    searchPlaceholderValue: 'Search categories...',
                });

                const domainSelect = new Choices('#event-domains', {
                    removeItemButton: true,
                    searchPlaceholderValue: 'Search domains...',
                });
            });

            // Collect selected categories and domains when moving to the next tab
            document.getElementById('next-tab-btn').addEventListener('click', function() {
                const selectedCategories = Array.from(document.querySelectorAll('#event-categories option:checked'))
                    .map(opt =>
                        opt.value);
                const selectedDomains = Array.from(document.querySelectorAll('#event-domains option:checked')).map(
                    opt => opt.value);

                const eventData = {
                    categories: selectedCategories,
                    domains: selectedDomains
                };

                console.log(eventData); // Send or use this data as needed
            });
        </script>
        <script>
            flatpickr('#datepicker-range', {
                mode: "range"
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // Handle switch changes
                const switches = [{
                        id: "event-type-switch",
                        texts: ["In Person", "Online"]
                    },
                    {
                        id: "event-privacy-switch",
                        texts: ["Private", "Public"]
                    },
                    {
                        id: "event-certificate-switch",
                        texts: ["Certified", "Not Certified"]
                    },
                    {
                        id: "event-fee-switch",
                        texts: ["Fee Required", "No Fee"]
                    }
                ];

                switches.forEach(switchObj => {
                    const switchElement = document.getElementById(switchObj.id);
                    const labelSpan = switchElement.nextElementSibling.querySelector("span");

                    if (switchElement && labelSpan) {
                        switchElement.addEventListener("change", () => {
                            labelSpan.textContent = switchElement.checked ?
                                switchObj.texts[0] :
                                switchObj.texts[1];

                            // Show or hide fee input row for fee switch
                            if (switchObj.id === "event-fee-switch") {
                                const feeInputRow = document.getElementById("fee-input-row");
                                feeInputRow.style.display = switchElement.checked ? "block" : "none";
                            }
                        });
                    }
                });
            });
        </script>
        <script>
            // Add new skill row
            // Initialize skillCount to track the number of skills added
            let skillCount = document.querySelectorAll('.skill-row').length;

            // Add Skill Button
            document.getElementById('add-skill-btn').addEventListener('click', function() {
                skillCount++;
                const skillRow = `
        <div class="row mb-3 align-items-end skill-row">
            <div class="col-lg-6">
                <label for="skill-name-${skillCount}" class="form-label">Skill Name</label>
                <select class="form-select skill-name" id="skill-name-${skillCount}" name="skills[${skillCount}][name]">
                    @foreach ($skills as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4">
                <label for="skill-quantity-${skillCount}" class="form-label">Quantity</label>
                <input type="number" class="form-control skill-quantity" id="skill-quantity-${skillCount}" 
                       name="skills[${skillCount}][quantity]" min="1" value="1">
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-danger remove-skill">Remove</button>
            </div>
        </div>
    `;
                document.getElementById('skill-needs-container').insertAdjacentHTML('beforeend', skillRow);
            });

            // Event delegation for dynamically added "Remove" buttons
            document.getElementById('skill-needs-container').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-skill')) {
                    const skillRow = e.target.closest('.skill-row');
                    skillRow.remove();
                }
            });


            // Remove asset or skill row
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-asset')) {
                    event.target.closest('.asset-row').remove();
                }
                if (event.target.classList.contains('remove-skill')) {
                    event.target.closest('.skill-row').remove();
                }
            });
        </script>
        <script>
            document.getElementById('event-fee-switch').addEventListener('change', function() {
                const feesSection = document.getElementById('fees-section');
                if (this.checked) {
                    feesSection.style.display = 'block';
                } else {
                    feesSection.style.display = 'none';
                }
            });

            document.getElementById('add-fee-btn').addEventListener('click', function() {
                const feeList = document.getElementById('fee-list');
                const feeCount = feeList.querySelectorAll('.fee-entry').length;
                const newFeeEntry = document.createElement('div');
                newFeeEntry.classList.add('fee-entry', 'mb-3');
                newFeeEntry.innerHTML = `
            <div class="row">
                <div class="col-md-5">
                    <label for="event-fee-type" class="form-label">Fee Type</label>
                    <input type="text" name="fees[${feeCount}][type]" class="form-control fee-type" placeholder="Enter Fee Type (e.g. Early Bird)" required>
                </div>
                <div class="col-md-5">
                    <label for="event-fee-amount" class="form-label">Amount</label>
                    <input type="number" name="fees[${feeCount}][amount]" class="form-control fee-amount" placeholder="Enter Amount" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-fee-btn" style="margin-top: 28px;">Remove</button>
                </div>
            </div>
            `;
                feeList.appendChild(newFeeEntry);

                // Attach remove button functionality
                newFeeEntry.querySelector('.remove-fee-btn').addEventListener('click', function() {
                    feeList.removeChild(newFeeEntry);
                });
            });
        </script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
