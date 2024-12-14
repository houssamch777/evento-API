@extends('layouts.admin.master')
@section('title')
    Events
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">

    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    Events
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row justify-content-center">
            <div class="col-xl-2 col-md-6">
                <div class="card bg-info border-info text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-white  mb-0 pb-1">Scheduled Events</p>
                                <h4 class="mb-0 mt-2 text-white">{{ $scheduledCount }}</h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6">
                <div class="card bg-success border-success text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-white  mb-0 pb-1">Completed Events</p>
                                <h4 class="mb-0 mt-2 text-white">{{ $completedCount }}</h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-12">
                <div class="card border border-success">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-success  mb-0 pb-1">Bosted Events</p>
                                <h4 class="mb-0 mt-2 text-success">{{ $boostedEvents->count() }}</h4>
                            </div>
                    
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-2 col-md-6">
                <div class="card bg-danger border-danger text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-white  mb-0 pb-1">Cancelled Events</p>
                                <h4 class="mb-0 mt-2 text-white">{{ $cancelledCount }}</h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6">
                <div class="card bg-warning border-warning text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class=" mb-0 pb-1">Ongoing Events</p>
                                <h4 class="mb-0 mt-2 text-white">{{ $ongoingCount }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="position-relative">
                            <div class="modal-button mt-2">
                                <button type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                    data-bs-toggle="modal" data-bs-target=".add-new-order"><i
                                        class="mdi mdi-rocket-launch me-1"></i>
                                    Boost Event</button>
                            </div>
                        </div>
                        <div id="gridjs-table"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->


        </div>
        <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!--  Extra Large modal example -->
        <div class="modal fade add-new-order" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Boost Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('events.boost') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Select Event -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="event_id">Select Event</label>
                                        <select class="form-select" id="event_id" name="event_id" required>
                                            <option selected disabled>Choose an Event</option>
                                            @foreach($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                
                                <!-- Boost Start Date -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="boost_start">Boost Start</label>
                                        <input type="datetime-local" class="form-control" id="boost_start" name="boost_start" required>
                                    </div>
                                </div>
                
                                <!-- Boost End Date -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="boost_end">Boost End</label>
                                        <input type="datetime-local" class="form-control" id="boost_end" name="boost_end" required>
                                    </div>
                                </div>
                            </div>
                
                            <div class="row mt-2">
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal">
                                        <i class="bx bx-x me-1"></i> Cancel
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="bx bx-check me-1"></i> Confirm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                            <h4 class="mt-3">Order Completed Successfully</h4>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Modal -->
        <div class="modal fade orderdetailsModal" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderdetailsModalLabel">Order Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                        <p class="mb-4">Billing Name: <span class="text-primary">Martin Gurley</span></p>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <img src="{{ URL::asset('build/images/product/img-1.png') }}"
                                                    alt="" class="rounded avatar-md">
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">Home & Office Chair Crime</h5>
                                                <p class="text-muted mb-0">$ 225 x 1</p>
                                            </div>
                                        </td>
                                        <td>$ 255</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <img src="{{ URL::asset('build/images/product/img-2.png') }}"
                                                    alt="" class="rounded avatar-md">
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">Tuition Classes Chair Crime</h5>
                                                <p class="text-muted mb-0">$ 145 x 1</p>
                                            </div>
                                        </td>
                                        <td>$ 145</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Sub Total:</h6>
                                        </td>
                                        <td>
                                            $ 400
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Shipping:</h6>
                                        </td>
                                        <td>
                                            Free
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Total:</h6>
                                        </td>
                                        <td>
                                            $ 400
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- gridjs js -->
        <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>
        <script>
            // Pass events data from Laravel to JavaScript
            const eventsData = @json($events);
            const boostedEventsData = @json($boostedEvents); // Added boosted events data
        
            // Function to check if an event is boosted
            function isBoosted(eventId) {
                return boostedEventsData.some(boostedEvent => boostedEvent.event_id === eventId);
            }
        
            // Initialize Grid.js
            new gridjs.Grid({
                columns: [{
                        id: 'id',
                        name: 'ID'
                    },
                    {
                        id: 'name',
                        name: 'Event Name'
                    },
                    {
                        id: 'status',
                        name: 'Status',
                        formatter: (cell) => {
                            const statusClass = {
                                'Scheduled': 'badge bg-info',
                                'Completed': 'badge bg-success',
                                'Cancelled': 'badge bg-danger',
                                'Ongoing': 'badge bg-warning'
                            };
                            return gridjs.html(`<div class="d-flex gap-3">
                                <span class="${statusClass[cell]}">${cell}</span></div>`);
                        }
                    },
                    {
                        id: 'start_date',
                        name: 'Start Date'
                    },
                    {
                        id: 'end_date',
                        name: 'End Date'
                    },
                    {
                        name: 'Actions',
                        formatter: (_, row) => {
                            const eventId = row.cells[0].data;
                            const isEventBoosted = isBoosted(eventId);
                            const rocketColor = isEventBoosted ? 'text-success' : 'text-warning'; // Rocket color based on boosted status
        
                            return gridjs.html(`
                                <div class="d-flex gap-3">
                                    <a class="text-success" onclick="viewDetails(${eventId})">
                                        <i class="mdi mdi-pencil font-size-18"></i>
                                    </a>
                                    <a class="${rocketColor}" onclick="boostEvent(${eventId})">
                                        <i class="mdi mdi-rocket-launch me-1"></i>
                                    </a>
                                    <a class="text-danger" onclick="deleteEvent(${eventId})">
                                        <i class="mdi mdi-delete font-size-18"></i>
                                    </a>
                                </div>
                            `);
                        }
                    }
                ],
                data: eventsData.map(event => ({
                    ...event,
                    boosted: isBoosted(event.id) ? 'Boosted' : '' // Add boosted info to each event data
                })),
                pagination: {
                    enabled: true,
                    limit: 8,
                },
                sort: true,
                search: true,
                language: {
                    search: {
                        placeholder: '🔍 Search events...'
                    },
                    pagination: {
                        previous: '⬅️',
                        next: '➡️',
                        showing: 'Showing',
                        to: 'to',
                        of: 'of',
                        results: 'entries'
                    }
                }
            }).render(document.getElementById('gridjs-table'));
        
            // Example Action Handlers
            function viewDetails(eventId) {
                alert('View details for Event ID: ' + eventId);
            }
        
            function boostEvent(eventId) {
                alert('Boost Event ID: ' + eventId);
                // Add logic to boost the event or trigger boost action
            }
        
            function deleteEvent(eventId) {
                if (confirm('Are you sure you want to delete Event ID: ' + eventId + '?')) {
                    // Perform delete action via AJAX or redirect
                    alert('Event ID: ' + eventId + ' deleted.');
                }
            }
        </script>

        <!-- datepicker js -->
        <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/ecommerce-orders.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
