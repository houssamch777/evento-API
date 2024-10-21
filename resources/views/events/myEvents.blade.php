@extends('layouts.master')
@section('title')
    Orders
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">

    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css') }}">
@endsection
@section('page-title')
    Orders
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">Active Orders</p>
                                <h4 class="mb-0 mt-2">5263</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">UnFulfilled</p>
                                <h4 class="mb-0 mt-2">3265</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">Pending Replace</p>
                                <h4 class="mb-0 mt-2">2452</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <p class="text-muted text-truncate mb-0 pb-1">Fulfilled</p>
                                <h4 class="mb-0 mt-2">6534</h4>
                            </div>
                            <div class="col-6">
                                <div class="overflow-hidden">
                                    <div id="mini-4"></div>
                                </div>
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
                                    data-bs-toggle="modal" data-bs-target=".add-new-order"><i class="mdi mdi-plus me-1"></i>
                                    Add New Order</button>
                            </div>
                        </div>
                        <div id="table-user-events"></div>
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
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Add New Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Product">Choose Product</label>
                                    <select class="form-select">
                                        <option selected> Select Product </option>
                                        <option>Adidas Running Shoes</option>
                                        <option>Puma P103 Shoes</option>
                                        <option>Adidas AB23 Shoes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Billing-Name">Billing Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Billing Name"
                                        id="AddOrder-Billing-Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="text" class="form-control" placeholder="Select Date" id="order-date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Total">Total</label>
                                    <input type="text" class="form-control" placeholder="$565" id="AddOrder-Total">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Payment-Status">Payment Status</label>
                                    <select class="form-select">
                                        <option selected> Select Card Type </option>
                                        <option>Paid</option>
                                        <option>Chargeback</option>
                                        <option>Refund</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="AddOrder-Payment-Method">Payment Method</label>
                                    <select class="form-select">
                                        <option selected> Select Payment Method </option>
                                        <option> Mastercard</option>
                                        <option>Visa</option>
                                        <option>Paypal</option>
                                        <option>COD</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-danger me-1" data-bs-dismiss="modal"><i
                                        class="bx bx-x me-1"></i> Cancel</button>
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#success-btn" id="btn-save-event"><i class="bx bx-check me-1"></i>
                                    Confirm</button>
                            </div>
                        </div>

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
                            <h4 class="mt-3">Order Completed Successfully</h4>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

<!-- Modal -->
@foreach ($events as $event)
    <div class="modal fade eventsdetailsModal" id="eventModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="eventsdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventsdetailsModalLabel">Event Details - {{ $event->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Event ID: <span class="text-primary">{{ $event->id }}</span></p>
                    <p class="mb-4">Event Name: <span class="text-primary">{{ $event->name }}</span></p>
                    <p class="mb-2">Categories: <span class="text-primary">{{ implode(', ', $event->categories->pluck('name')->toArray()) }}</span></p>
                    <p class="mb-4">Domains: <span class="text-primary">{{ implode(', ', $event->domains->pluck('name')->toArray()) }}</span></p>

                    <!-- Assets Table -->
                    @if ($event->assetNeeds->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Asset</th>
                                    <th scope="col">Asset Name</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event->assetNeeds as $asset)
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                
                                                @if ($asset->{'asset-type'} == 'equipment' && $asset->equipmentType)
                                                <img src="{{ URL::asset('build/images/assettype/' . ($asset->{'asset-type'}.'.png' ?? 'default.png')) }}" alt="" class="rounded avatar-md">
                                                @elseif ($asset->{'asset-type'} == 'furniture' && $asset->furnitureType)
                                                <img src="{{ URL::asset('build/images/assettype/' . ($asset->{'asset-type'}.'.png' ?? 'default.png')) }}" alt="" class="rounded avatar-md">
                                                @elseif ($asset->{'asset-type'} == 'room' && $asset->roomType)
                                                <img src="{{ URL::asset('build/images/assettype/' . ($asset->{'asset-type'}.'.png' ?? 'default.png')) }}" alt="" class="rounded avatar-md">
                                                @elseif ($asset->{'asset-type'} == 'transportation' && $asset->transportationType)
                                                <img src="{{ URL::asset('build/images/assettype/' . ($asset->{'asset-type'}.'.png' ?? 'default.png')) }}" alt="" class="rounded avatar-md">
                                                @endif
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                @if ($asset->{'asset-type'} == 'equipment' && $asset->equipmentType)
                                                    <h5 class="text-truncate font-size-14">Need Equipment: {{ $asset->equipmentType->name }}</h5>
                                                @elseif ($asset->{'asset-type'} == 'furniture' && $asset->furnitureType)
                                                    <h5 class="text-truncate font-size-14">Need Furniture : {{ $asset->furnitureType->name }}</h5>
                                                @elseif ($asset->{'asset-type'} == 'room' && $asset->roomType)
                                                    <h5 class="text-truncate font-size-14">Need Room : {{ $asset->roomType->name }}</h5>
                                                @elseif ($asset->{'asset-type'} == 'transportation' && $asset->transportationType)
                                                    <h5 class="text-truncate font-size-14">NeedTransportation : {{ $asset->transportationType->name }}</h5>
                                                @else
                                                    <h5 class="text-truncate font-size-14">Need Asset : {{ $asset->{'asset-type'} }}</h5>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $asset->quantity }}</td>
                                    </tr>
                                @endforeach
                            



                            </tbody>
                        </table>
                    </div>

                    @else
                        
                    @endif

                    <!-- Skills Table -->
                    @if ($event->skillNeeds->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Skill Type</th>
                                    <th scope="col">Skill Name</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event->skillNeeds as $skill)

                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <h5 class="text-truncate font-size-14">{{ $skill->skillName->type }}</h5>
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">{{ $skill->skillName->name }}</h5>
                                            </div>
                                        </td>
                                        <td>{{ $skill->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach


<!-- End Modal -->

        <!-- end modal -->
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <!-- gridjs js -->
        <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

        <!-- datepicker js -->
        <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

        <script>
            new gridjs.Grid({
            columns: [
                {
                name: '#',
                sort: {
                    enabled: false
                },
                formatter: (function (cell) {
                    return gridjs.html('<div class="form-check font-size-16"><input class="form-check-input" type="checkbox" id="orderidcheck01"><label class="form-check-label" for="orderidcheck01"></label></div>');
                })
                },
                {
                name: 'Event ID',
                formatter: (function (cell) {
                    return gridjs.html('<span class="fw-semibold">' + cell + '</span>');
                })
                },
                {
                name: 'Event Name',
                formatter: (function (cell) {
                    return gridjs.html('<a href="#" class="text-body">' + cell + "</a>");
                })
                },
                "start Date", "end Date",
                {
                name: 'Type',
                formatter: (function (cell) {
                    switch (cell) {
                    case "online":
                        return gridjs.html('<span class="badge badge-pill bg-success-subtle text-success font-size-12">' + cell + '</span>');
                    case "in-person":
                        return gridjs.html('<span class="badge badge-pill bg-warning-subtle text-warning font-size-12">' + cell + '</span>');
                    default:
                        return gridjs.html('<span class="badge badge-pill bg-success-subtle text-success font-size-12">' + cell + '</span>');
                    }
                })
                },
                {
                name: "Status",
                formatter: (function (cell) {
                    switch (cell) {
                    case "Scheduled":
                        return gridjs.html('<span class="text-body">' + cell + '</span>');
                    case "Completed":
                        return gridjs.html('<span class="text-body">' + cell + '</span>');
                    case "Cancelled":
                        return gridjs.html('<span class="text-body">' + cell + '</span>');
                    case "Ongoing":
                        return gridjs.html('<span class="text-body">' + cell + '</span>');
                    }
                })
                },
                {
                name: "View Details",
                formatter: (function (cell, row) {
                    return gridjs.html('<button type="button" class="btn btn-primary btn-sm btn-rounded view-details" data-bs-toggle="modal" data-bs-target="#eventModal' + row.cells[1].data + '">' + cell + '</button>');
                })
                },
                {
                name: "Action",
                sort: {
                    enabled: false
                },
                formatter: (function (cell) {
                    return gridjs.html('<div class="d-flex gap-3"><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a><a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a></div>');
                })
                }
            ],
            pagination: {
                limit: 7
            },
            sort: true,
            search: true,
            data: [
                @foreach ($events as $event)
                ["", "{{$event->id}}", "{{$event->name}}", "{{$event->start_date}}", "{{$event->end_date}}", "{{$event->type}}", "{{$event->status}}", "View Details"],
                @endforeach
            ]
            }).render(document.getElementById("table-user-events"));


        </script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection