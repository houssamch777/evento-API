@extends('layouts.master')
@section('title')
    event create
@endsection
@section('css')
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    New Event Create
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Event creation Steps</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <form action="#">
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
                                <div>
                                    <!-- Event Name and Date -->
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label for="event-name-input" class="form-label">Event Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter Event Name"
                                                    id="event-name-input" required>
                                                <div class="invalid-feedback">Please enter a valid event name.</div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="event-date-input" class="form-label">Date <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" placeholder="Select Date"
                                                    id="event-date-input" required>
                                                <div class="invalid-feedback">Please select a valid date.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Switches -->
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="event-type-switch" class="form-label">Type</label>
                                                <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                    <input type="checkbox" class="form-check-input" id="event-type-switch"
                                                        checked>
                                                    <label class="form-check-label" for="event-type-switch">
                                                        <span class="text-success">In Person</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="event-privacy-switch" class="form-label">Privacy</label>
                                                <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="event-privacy-switch" checked>
                                                    <label class="form-check-label" for="event-privacy-switch">
                                                        <span class="text-success">Private</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="event-certificate-switch" class="form-label">Certificate</label>
                                                <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="event-certificate-switch" checked>
                                                    <label class="form-check-label" for="event-certificate-switch">
                                                        <span class="text-success">Certified</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="event-fee-switch" class="form-label">Fee</label>
                                                <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                    <input type="checkbox" class="form-check-input" id="event-fee-switch">
                                                    <label class="form-check-label" for="event-fee-switch">
                                                        <span class="text-success">No Fee</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="event-description-input" class="form-label">Description <span
                                                        class="text-danger">*</span></label>
                                                <textarea id="event-description-input" class="form-control" placeholder="Enter Event Description" rows="3"
                                                    required></textarea>
                                                <div class="invalid-feedback">Please provide a description for the event.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Conditional Fee Input -->
                                    <div class="row">
                                        <div class="col-lg-4" id="fee-input-row" style="display: none;">
                                            <div class="mb-3">
                                                <label for="event-fee-amount" class="form-label">Fee Amount <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" placeholder="Enter Fee Amount"
                                                    id="event-fee-amount">
                                                <div class="invalid-feedback">Please enter a valid fee amount.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <!-- wizard-tab -->

                            <div class="wizard-tab">
                                <div>
                                    <div class="text-center mb-4">
                                        <h5>Company Document</h5>
                                        <p class="card-title-desc">Fill all information below</p>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-pancard-input" class="form-label">PAN
                                                        Card</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Pan Card" id="basicpill-pancard-input">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-vatno-input" class="form-label">VAT/TIN
                                                        No.</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter VAT/TIN No." id="basicpill-vatno-input">
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-cstno-input" class="form-label">CST
                                                        No.</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter CST No." id="basicpill-cstno-input">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-servicetax-input" class="form-label">Service Tax
                                                        No.</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Service Tax No."
                                                        id="basicpill-servicetax-input">
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-companyuin-input" class="form-label">Company
                                                        UIN</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Company UIN" id="basicpill-companyuin-input">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-declaration-input"
                                                        class="form-label">Declaration</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Declaration" id="basicpill-declaration-input">
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row-->
                                    </div><!-- end form -->
                                </div>
                            </div>
                            <!-- wizard-tab -->

                            <div class="wizard-tab">
                                <div>
                                    <div class="text-center mb-4">
                                        <h5>Bank Details</h5>
                                        <p class="card-title-desc">Fill all information below</p>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-namecard-input" class="form-label">Name On
                                                        Card</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Name On Card" id="basicpill-namecard-input">
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Credit Card Type</label>
                                                    <select class="form-select">
                                                        <option selected>Select Card Type</option>
                                                        <option value="AE">American Express</option>
                                                        <option value="VI">Visa</option>
                                                        <option value="MC">MasterCard</option>
                                                        <option value="DI">Discover</option>
                                                    </select>
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-cardno-input" class="form-label">Credit Card
                                                        Number</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Credit Card Number"
                                                        id="basicpill-cardno-input">
                                                </div>
                                            </div><!-- end col -->

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-card-verification-input" class="form-label">Card
                                                        Verification Number</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Card Verification Number"
                                                        id="basicpill-card-verification-input">
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="basicpill-expiration-input" class="form-label">Expiration
                                                        Date</label>
                                                    <input type="text" class="form-control" id="datepicker-basic"
                                                        placeholder="Enter Expiration Date"
                                                        id="basicpill-expiration-input">
                                                </div>
                                            </div>
                                        </div><!-- end row -->
                                    </div><!-- end form -->

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
        <!-- form wizard init -->
        <script src="{{ URL::asset('build/js/pages/form-wizard.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
