@extends('layouts.master')
@section('title')
    Assets 
@endsection
@section('css')
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('page-title')
     My Assets
    
@endsection

@section('body')

    <body>
    @endsection

    @section('content')
   
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <h5 class="card-title">Asset List <span class="text-muted fw-normal ms-2">({{ $assets->count() }})</span></h5>
                </div>
            </div>
        </div>

        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="position-relative">
                            <div class="modal-button mt-2">
                                <a  href="{{route('asset.create')}}"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                    ><i class="mdi mdi-plus me-1"></i>
                                    Add New Asset</a>
                            </div>
                        </div>
                        <div id="table-asset-list"></div>
                    </div>
                </div>
            </div>
        </div>



    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
                <!-- gridjs js -->
                <script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>

                <script src="{{ URL::asset('build/js/pages/gridjs.init.js') }}"></script>


                <script>
                    new gridjs.Grid({
                        columns: [
                            {
                                name: '#',
                                sort: { enabled: false },
                                formatter: () => gridjs.html('<div class="form-check font-size-16"><input class="form-check-input" type="checkbox"></div>')
                            },
                            {
                                name: 'Asset ID',
                                formatter: cell => gridjs.html('<span class="fw-semibold">' + cell + '</span>')
                            },
                            {
                                name: 'Asset Name',
                                formatter: cell => gridjs.html('<a href="#" class="text-body">' + cell + '</a>')
                            },
                            "Location", // assuming this is a column for asset location
                            {
                                name: 'Type',
                                formatter: cell => {
                                    let badgeClass = cell === "Equipment" ? 'bg-primary-subtle' : cell === "Furniture" ? 'bg-warning-subtle' : 'bg-secondary-subtle';
                                    return gridjs.html(`<span class="badge badge-pill ${badgeClass} text-uppercase font-size-12">${cell}</span>`);
                                }
                            },
                            {
                                name: "Status",
                                formatter: cell => {
                                    let statusClass = cell === "1" ? 'text-success' : cell === "0" ? 'text-danger' : 'text-muted';
                                    let cellClass = cell === "1" ? 'Available' : cell === "0" ? 'Unavailable' : 'text-muted';
                                    return gridjs.html('<span class="' + statusClass + '">' + cellClass + '</span>');
                                }
                            },
                            {
                                name: "View Details",
                                formatter: (cell, row) => gridjs.html(`
                                    <a href="{{ route('asset.show', '') }}/${row.cells[1].data}" 
                                    class="btn btn-primary btn-sm btn-rounded">
                                    View Details
                                    </a>`)
                            },
                            {
                                name: "Action",
                                sort: { enabled: false },
                                formatter: () => gridjs.html(`
                                    <div class="d-flex gap-3">
                                        <a href="javascript:void(0);" class="text-success" title="Edit"><i class="mdi mdi-pencil font-size-18"></i></a>
                                        <a href="javascript:void(0);" class="text-danger" title="Delete"><i class="mdi mdi-delete font-size-18"></i></a>
                                    </div>
                                `)
                            }
                        ],
                        pagination: { limit: 7 },
                        sort: true,
                        search: true,
                        data: [
                            @foreach ($assets as $asset)
                                ["", "{{$asset->id}}", "{{$asset->name}}", "{{$asset->location}}", "{{ class_basename($asset->assetable_type) }}", "{{$asset->is_available}}", "View Details"],
                            @endforeach
                        ]
                    }).render(document.getElementById("table-asset-list"));
                </script>
                         
    @endsection
