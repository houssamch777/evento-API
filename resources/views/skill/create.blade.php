@extends('layouts.master')
@section('title')
    Add New Skill
@endsection
@section('css')
    <!-- choices css -->
    <link href="{{ URL::asset('build/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- dropzone css -->
    <link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <!-- choices css -->
    <link href="{{ URL::asset('build/libs/choices.js/public/assets/styles/choices.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    New Skill
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
    <x-breadcrub :title="'Create'" :link="route('skills.index')" :pagetitle="'My skills'" />
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

                                            <label for="skills-select" class="form-label font-size-13 text-muted">Select a Skill</label>
                                            <select class="form-control" data-trigger  id="name" name="name">
                                                <option value="">Choose a skill</option>
                                                <optgroup label="Communication Skills">
                                                    <option value="active-listening">Active Listening</option>
                                                    <option value="storytelling">Storytelling</option>
                                                    <option value="written-communication">Written Communication</option>
                                                    <option value="editing">Editing</option>
                                                    <option value="teaching">Teaching</option>
                                                    <option value="negotiating">Negotiating</option>
                                                    <option value="open-mindedness">Open-mindedness</option>
                                                    <option value="inquiring">Inquiring</option>
                                                    <option value="body-language">Body Language</option>
                                                    <option value="customer-service">Customer Service</option>
                                                    <option value="presenting">Presenting</option>
                                                    <option value="summarizing">Summarizing</option>
                                                    <option value="nonverbal-communication">Nonverbal Communication</option>
                                                    <option value="documenting">Documenting</option>
                                                    <option value="reporting">Reporting</option>
                                                </optgroup>
                                                <optgroup label="Interpersonal Skills">
                                                    <option value="patience">Patience</option>
                                                    <option value="positivity">Positivity</option>
                                                    <option value="conflict-management">Conflict Management</option>
                                                    <option value="coaching">Coaching</option>
                                                    <option value="mediating">Mediating</option>
                                                    <option value="motivating">Motivating</option>
                                                    <option value="compassion">Compassion</option>
                                                    <option value="caring">Caring</option>
                                                    <option value="networking">Networking</option>
                                                    <option value="inspiring">Inspiring</option>
                                                    <option value="flexibility">Flexibility</option>
                                                    <option value="collaboration">Collaboration</option>
                                                    <option value="sourcing-feedback">Sourcing Feedback</option>
                                                    <option value="reliability">Reliability</option>
                                                    <option value="empathy">Empathy</option>
                                                </optgroup>
                                                <optgroup label="Critical Thinking Skills">
                                                    <option value="observing">Observing</option>
                                                    <option value="problem-solving">Problem-solving</option>
                                                    <option value="inferring">Inferring</option>
                                                    <option value="simplifying">Simplifying</option>
                                                    <option value="conceptual-thinking">Conceptual Thinking</option>
                                                    <option value="evaluating">Evaluating</option>
                                                    <option value="streamlining">Streamlining</option>
                                                    <option value="creative-thinking">Creative Thinking</option>
                                                    <option value="brainstorming">Brainstorming</option>
                                                    <option value="cost-benefit-analyzing">Cost-benefit Analyzing</option>
                                                    <option value="deductive-reasoning">Deductive Reasoning</option>
                                                    <option value="inductive-reasoning">Inductive Reasoning</option>
                                                    <option value="assessing">Assessing</option>
                                                    <option value="evidence-collecting">Evidence Collecting</option>
                                                    <option value="troubleshooting">Troubleshooting</option>
                                                </optgroup>
                                                <optgroup label="Leadership Skills">
                                                    <option value="mentoring">Mentoring</option>
                                                    <option value="envisioning">Envisioning</option>
                                                    <option value="goal-setting">Goal-setting</option>
                                                    <option value="employee-development">Employee Development</option>
                                                    <option value="performance-reviewing">Performance Reviewing</option>
                                                    <option value="managing">Managing</option>
                                                    <option value="planning">Planning</option>
                                                    <option value="delegating">Delegating</option>
                                                    <option value="directing">Directing</option>
                                                    <option value="supervising">Supervising</option>
                                                    <option value="training">Training</option>
                                                    <option value="earning-trust">Earning Trust</option>
                                                    <option value="influencing">Influencing</option>
                                                    <option value="adapting">Adapting</option>
                                                    <option value="crisis-managing">Crisis Managing</option>
                                                </optgroup>
                                                <optgroup label="Technical Skills">
                                                    <option value="accounting">Accounting</option>
                                                    <option value="word-processing">Word Processing</option>
                                                    <option value="spreadsheet-building">Spreadsheet Building</option>
                                                    <option value="coding">Coding</option>
                                                    <option value="programming">Programming</option>
                                                    <option value="operating-equipment">Operating Equipment</option>
                                                    <option value="engineering">Engineering</option>
                                                    <option value="experimenting">Experimenting</option>
                                                    <option value="testing">Testing</option>
                                                    <option value="constructing">Constructing</option>
                                                    <option value="restoring">Restoring</option>
                                                    <option value="product-developing">Product Developing</option>
                                                    <option value="quality-controlling">Quality Controlling</option>
                                                    <option value="blueprint-drafting">Blueprint Drafting</option>
                                                    <option value="repairing">Repairing</option>
                                                </optgroup>
                                                <optgroup label="Language Skills">
                                                    <option value="translating">Translating</option>
                                                    <option value="speaking">Speaking</option>
                                                    <option value="writing">Writing</option>
                                                    <option value="conversing">Conversing</option>
                                                    <option value="reinterpretating">Reinterpreting</option>
                                                    <option value="public-speaking">Public Speaking</option>
                                                    <option value="following-etiquette">Following Etiquette</option>
                                                    <option value="explaining">Explaining</option>
                                                    <option value="respecting">Respecting</option>
                                                    <option value="signaling">Signaling</option>
                                                    <option value="proofreading">Proofreading</option>
                                                    <option value="introducing">Introducing</option>
                                                    <option value="representing">Representing</option>
                                                    <option value="rephrasing">Rephrasing</option>
                                                    <option value="code-switching">Code-switching</option>
                                                </optgroup>
                                                <optgroup label="Design Skills">
                                                    <option value="graphic-design">Graphic Design</option>
                                                    <option value="user-experience-development">User Experience Development</option>
                                                    <option value="user-interface-development">User Interface Development</option>
                                                    <option value="typography">Typography</option>
                                                    <option value="layout-development">Layout Development</option>
                                                    <option value="web-design">Web Design</option>
                                                    <option value="data-visualization">Data Visualization</option>
                                                    <option value="photo-and-video-editing">Photo and Video Editing</option>
                                                    <option value="wireframing">Wireframing</option>
                                                </optgroup>
                                                <optgroup label="Analytical Skills">
                                                    <option value="researching">Researching</option>
                                                    <option value="interpreting">Interpreting</option>
                                                    <option value="information-processing">Information Processing</option>
                                                    <option value="organizing">Organizing</option>
                                                    <option value="processing">Processing</option>
                                                    <option value="graphing">Graphing</option>
                                                    <option value="computing">Computing</option>
                                                    <option value="calculating">Calculating</option>
                                                    <option value="modeling">Modeling</option>
                                                    <option value="extrapolating">Extrapolating</option>
                                                    <option value="predicting">Predicting</option>
                                                    <option value="forecasting">Forecasting</option>
                                                    <option value="investigating">Investigating</option>
                                                    <option value="surveying">Surveying</option>
                                                    <option value="statistical-analysis">Statistical Analysis</option>
                                                </optgroup>
                                            </select>
                                        
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
                                                <label class="form-label" for="cost_type">Cost Type</label>
                                                <select id="cost_type" name="cost_type" class="form-control">
                                                    <option value="per_hour">Per Hour</option>
                                                    <option value="per_task">Per Project</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="cost">Skill Cost</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">dz</span>
                                                    </div>
                                                    <input id="cost" name="cost" placeholder="Enter Cost" type="number" class="form-control text-end" min="0" step="100">

                                                    <div class="input-group-append">
                                                      <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="mb-3">
                                                <label class="form-label" for="portfolio_url">Skill portfolio_url</label>
                                                <input id="portfolio_url" name="portfolio_url" placeholder="Enter portfolio URL" type="url" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="offer_as_service">Offer as a Service</label>
                                                <select id="offer_as_service" name="offer_as_service" class="form-control">
                                                    <option value="1" >Yes</option>
                                                    <option value="0" selected>No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="availability-row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="day-select">work days</label>
                                                    <select id="day-select" name="day[]" multiple>
                                                        <option value="Mo">Monday</option>
                                                        <option value="Tu">Tuesday</option>
                                                        <option value="We">Wednesday</option>
                                                        <option value="Th">Thursday</option>
                                                        <option value="Fr">Friday</option>
                                                        <option value="Sa">Saturday</option>
                                                        <option value="Su">Sunday</option>
                                                    </select>
                                                    @error('facilities')
                                                    <div class="invalid-feedback d-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="start_time">Start Time</label>
                                                <input id="start_time" name="start_time" placeholder="start time" type="time" class="form-control">

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="end_time">End Time</label>
                                                <input id="end_time" name="end_time" placeholder="end ime" type="time" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
    
                                
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
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Show/Hide Availability section based on "Offer as a Service"
                const offer_as_serviceSelect = document.getElementById('offer_as_service');
                const availabilityRow = document.getElementById('availability-row');
    
                offer_as_serviceSelect.addEventListener('change', function () {
                    if (this.value == '1') {
                        availabilityRow.classList.remove('d-none'); // Remove the class to make it visible
                    } else {
                        availabilityRow.classList.add('d-none'); // Remove the class to make it visible
                    }
                });
            });
        </script>
        <script>
            // Initialize Choices.js on the select element
                    const choices = new Choices('#day-select', {
                        removeItemButton: true,
                        searchEnabled: true,
                        placeholderValue: 'Select days...',
                    });
    
        </script>
        <!-- choices js -->
        <script src="{{ URL::asset('build/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    @endsection
