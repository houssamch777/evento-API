@extends('layouts.master')
@section('title')
    Skills
@endsection
@section('css')
    <!-- gridjs css -->
    <link rel="stylesheet" href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}">
@endsection
@section('page-title')
    show skill
@endsection

@section('body')

    <body>
        
    @endsection
    @section('content')
    <!-- start content here -->
    <x-breadcrub :title="$skill->name" :link="route('skills.index')" :pagetitle="'My skills'" />

    <div class="row">
        <div class="col-12">

            <!-- Left sidebar -->
            <div class="email-leftbar">
                <div class="card" >
                    <div class="card-body">
                        <!--
                        <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-primary waves-effect waves-light w-100"><h5 class="font-size-15  text-white">Edit</h5></a>
                        <a href="{{ route('skills.destroy', $skill->id) }}" class="btn btn-danger waves-effect waves-light w-100 mt-3"><h5 class="font-size-15  text-white">Delete</h5></a>
                        -->
                        
                        <h5 class="mt-4 font-size-15 ">Other Skills</h5>
                        <div  data-simplebar style="max-height: 420px;">
                        <div class="overflow-hidden mt-3">
                            @foreach ($skills as $item)
                            <Li class="mt-2">
                                <a href="{{ route('skills.show', $item->id) }}" class=" font-size-13 text-muted text-uppercase" >
                                    {{$item->name}}
                                </a>
                            </Li>
                            @endforeach
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
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-grow-1">
                                <h6 class="text-muted text-uppercase mb-3">{{$skill->name.' skill info'}}</h6>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class="fw-semibold">Action</span> <span class="text-muted"><i
                                                class="mdi mdi-chevron-down ms-1"></i></span>
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
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-xxl-7">
                                <div class="py-3">
                                    <div id="availabilityChart" data-colors='["#1f58c7"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>

                            <div class="col-xl-5">
                                <h5 class="mb-3 display-6"><Strong>Skills Information</Strong></h5> <!-- Adjust the heading size with display-6 or another class -->
                            
                                <ul class="list-unstyled">
                                    <li class="fs-4"> <!-- Use fs-5 for larger font size -->
                                        <strong>Skill Name:</strong> {{$skill->name}}
                                    </li>
                                    <li class="fs-4">
                                        <strong>Experience:</strong> {{$skill->experience}}
                                    </li>
                                    <li class="fs-4">
                                        <strong>Offer as Service:</strong> {{ $skill->offer_as_service ? 'Yes' : 'No' }}
                                    </li>
                                    <li class="fs-4">
                                        <strong>Portfolio URL:</strong> <a href="{{ $skill->portfolio_url }}">{{ $skill->portfolio_url }}</a><br>
                                    </li>
                                    <li class="fs-4">
                                        <strong>Cost:</strong> {{ $skill->cost }} dz ({{ $skill->cost_type }})<br>
                                    </li>
                                    <!-- Add more skill-related information as needed -->
                                </ul>
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
             <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Get the hours data
                var hoursData = @json(array_values($hoursPerDay)); // Rounded values
        
                // Calculate the maximum hour value
                var maxHours = Math.max(...hoursData);
        
                var options = {
                    chart: {
                        type: 'bar',
                        height: 580
                    },
                    title: {
                        text: 'Skill Availability by Day',
                        align: 'center',
                        style: {
                            fontSize: '20px',
                            fontWeight: 'bold',
                            color: '#263238'
                        }
                    },
                    series: [{
                        name: 'Hours',
                        data: hoursData
                    }],
                    xaxis: {
                        categories: @json(array_keys($hoursPerDay)), // Day names
                    },
                    yaxis: {
                        title: {
                            text: 'Hours'
                        },
                        min: 0,
                        max: maxHours + 2 // Set max to max hour value + 2
                    },
                    fill: {
                        colors: ['#1E90FF']
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return val + " hrs";
                            }
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '15%' // Adjust this to make bars slimmer (e.g., 30% for slim bars)
                        }
                    }
                };
        
                var chart = new ApexCharts(document.querySelector("#availabilityChart"), options);
                chart.render();
            });
        </script>
        
        
        
    @endsection
