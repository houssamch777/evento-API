@extends('layouts.master')
@section('title')
    Edit Skill
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
    {{$skill->name}} Skill
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
    <x-breadcrub :title="'Update'" :link="route('skills.index')" :pagetitle="'My skills'" />
    <form action="{{ route('skills.update',$skill->id) }}" method="POST">
        @csrf
        @method('PUT')
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
                                            <select class="form-control"  data-trigger id="name" name="name">
                                                <option value="">Choose a skill</option>
                                                <optgroup label="Communication Skills">
                                                    <option value="active-listening" {{ $skill->name == 'active-listening' ? 'selected' : '' }}>Active Listening</option>
                                                    <option value="storytelling" {{ $skill->name == 'storytelling' ? 'selected' : '' }}>Storytelling</option>
                                                    <option value="written-communication" {{ $skill->name == 'written-communication' ? 'selected' : '' }}>Written Communication</option>
                                                    <option value="editing" {{ $skill->name == 'editing' ? 'selected' : '' }}>Editing</option>
                                                    <option value="teaching" {{ $skill->name == 'teaching' ? 'selected' : '' }}>Teaching</option>
                                                    <option value="negotiating" {{ $skill->name == 'negotiating' ? 'selected' : '' }}>Negotiating</option>
                                                    <option value="open-mindedness" {{ $skill->name == 'open-mindedness' ? 'selected' : '' }}>Open-mindedness</option>
                                                    <option value="inquiring" {{ $skill->name == 'inquiring' ? 'selected' : '' }}>Inquiring</option>
                                                    <option value="body-language" {{ $skill->name == 'body-language' ? 'selected' : '' }}>Body Language</option>
                                                    <option value="customer-service" {{ $skill->name == 'customer-service' ? 'selected' : '' }}>Customer Service</option>
                                                    <option value="presenting" {{ $skill->name == 'presenting' ? 'selected' : '' }}>Presenting</option>
                                                    <option value="summarizing" {{ $skill->name == 'summarizing' ? 'selected' : '' }}>Summarizing</option>
                                                    <option value="nonverbal-communication" {{ $skill->name == 'nonverbal-communication' ? 'selected' : '' }}>Nonverbal Communication</option>
                                                    <option value="documenting" {{ $skill->name == 'documenting' ? 'selected' : '' }}>Documenting</option>
                                                    <option value="reporting" {{ $skill->name == 'reporting' ? 'selected' : '' }}>Reporting</option>
                                                </optgroup>
                                                <optgroup label="Interpersonal Skills">
                                                    <option value="patience" {{ $skill->name == 'patience' ? 'selected' : '' }}>Patience</option>
                                                    <option value="positivity" {{ $skill->name == 'positivity' ? 'selected' : '' }}>Positivity</option>
                                                    <option value="conflict-management" {{ $skill->name == 'conflict-management' ? 'selected' : '' }}>Conflict Management</option>
                                                    <option value="coaching" {{ $skill->name == 'coaching' ? 'selected' : '' }}>Coaching</option>
                                                    <option value="mediating" {{ $skill->name == 'mediating' ? 'selected' : '' }}>Mediating</option>
                                                    <option value="motivating" {{ $skill->name == 'motivating' ? 'selected' : '' }}>Motivating</option>
                                                    <option value="compassion" {{ $skill->name == 'compassion' ? 'selected' : '' }}>Compassion</option>
                                                    <option value="caring" {{ $skill->name == 'caring' ? 'selected' : '' }}>Caring</option>
                                                    <option value="networking" {{ $skill->name == 'networking' ? 'selected' : '' }}>Networking</option>
                                                    <option value="inspiring" {{ $skill->name == 'inspiring' ? 'selected' : '' }}>Inspiring</option>
                                                    <option value="flexibility" {{ $skill->name == 'flexibility' ? 'selected' : '' }}>Flexibility</option>
                                                    <option value="collaboration" {{ $skill->name == 'collaboration' ? 'selected' : '' }}>Collaboration</option>
                                                    <option value="sourcing-feedback" {{ $skill->name == 'sourcing-feedback' ? 'selected' : '' }}>Sourcing Feedback</option>
                                                    <option value="reliability" {{ $skill->name == 'reliability' ? 'selected' : '' }}>Reliability</option>
                                                    <option value="empathy" {{ $skill->name == 'empathy' ? 'selected' : '' }}>Empathy</option>
                                                </optgroup>
                                                <optgroup label="Critical Thinking Skills">
                                                    <option value="observing" {{ $skill->name == 'observing' ? 'selected' : '' }}>Observing</option>
                                                    <option value="problem-solving" {{ $skill->name == 'problem-solving' ? 'selected' : '' }}>Problem-solving</option>
                                                    <option value="inferring" {{ $skill->name == 'inferring' ? 'selected' : '' }}>Inferring</option>
                                                    <option value="simplifying" {{ $skill->name == 'simplifying' ? 'selected' : '' }}>Simplifying</option>
                                                    <option value="conceptual-thinking" {{ $skill->name == 'conceptual-thinking' ? 'selected' : '' }}>Conceptual Thinking</option>
                                                    <option value="evaluating" {{ $skill->name == 'evaluating' ? 'selected' : '' }}>Evaluating</option>
                                                    <option value="streamlining" {{ $skill->name == 'streamlining' ? 'selected' : '' }}>Streamlining</option>
                                                    <option value="creative-thinking" {{ $skill->name == 'creative-thinking' ? 'selected' : '' }}>Creative Thinking</option>
                                                    <option value="brainstorming" {{ $skill->name == 'brainstorming' ? 'selected' : '' }}>Brainstorming</option>
                                                    <option value="cost-benefit-analyzing" {{ $skill->name == 'cost-benefit-analyzing' ? 'selected' : '' }}>Cost-benefit Analyzing</option>
                                                    <option value="deductive-reasoning" {{ $skill->name == 'deductive-reasoning' ? 'selected' : '' }}>Deductive Reasoning</option>
                                                    <option value="inductive-reasoning" {{ $skill->name == 'inductive-reasoning' ? 'selected' : '' }}>Inductive Reasoning</option>
                                                    <option value="assessing" {{ $skill->name == 'assessing' ? 'selected' : '' }}>Assessing</option>
                                                    <option value="evidence-collecting" {{ $skill->name == 'evidence-collecting' ? 'selected' : '' }}>Evidence Collecting</option>
                                                    <option value="troubleshooting" {{ $skill->name == 'troubleshooting' ? 'selected' : '' }}>Troubleshooting</option>
                                                </optgroup>
                                                <optgroup label="Leadership Skills">
                                                    <option value="mentoring" {{ $skill->name == 'mentoring' ? 'selected' : '' }}>Mentoring</option>
                                                    <option value="envisioning" {{ $skill->name == 'envisioning' ? 'selected' : '' }}>Envisioning</option>
                                                    <option value="goal-setting" {{ $skill->name == 'goal-setting' ? 'selected' : '' }}>Goal-setting</option>
                                                    <option value="employee-development" {{ $skill->name == 'employee-development' ? 'selected' : '' }}>Employee Development</option>
                                                    <option value="performance-reviewing" {{ $skill->name == 'performance-reviewing' ? 'selected' : '' }}>Performance Reviewing</option>
                                                    <option value="managing" {{ $skill->name == 'managing' ? 'selected' : '' }}>Managing</option>
                                                    <option value="planning" {{ $skill->name == 'planning' ? 'selected' : '' }}>Planning</option>
                                                    <option value="delegating" {{ $skill->name == 'delegating' ? 'selected' : '' }}>Delegating</option>
                                                    <option value="directing" {{ $skill->name == 'directing' ? 'selected' : '' }}>Directing</option>
                                                    <option value="supervising" {{ $skill->name == 'supervising' ? 'selected' : '' }}>Supervising</option>
                                                    <option value="training" {{ $skill->name == 'training' ? 'selected' : '' }}>Training</option>
                                                    <option value="earning-trust" {{ $skill->name == 'earning-trust' ? 'selected' : '' }}>Earning Trust</option>
                                                    <option value="influencing" {{ $skill->name == 'influencing' ? 'selected' : '' }}>Influencing</option>
                                                    <option value="adapting" {{ $skill->name == 'adapting' ? 'selected' : '' }}>Adapting</option>
                                                    <option value="crisis-managing" {{ $skill->name == 'crisis-managing' ? 'selected' : '' }}>Crisis Managing</option>
                                                </optgroup>
                                                <optgroup label="Technical Skills">
                                                    <option value="accounting" {{ $skill->name == 'accounting' ? 'selected' : '' }}>Accounting</option>
                                                    <option value="word-processing" {{ $skill->name == 'word-processing' ? 'selected' : '' }}>Word Processing</option>
                                                    <option value="spreadsheet-building" {{ $skill->name == 'spreadsheet-building' ? 'selected' : '' }}>Spreadsheet Building</option>
                                                    <option value="coding" {{ $skill->name == 'coding' ? 'selected' : '' }}>Coding</option>
                                                    <option value="programming" {{ $skill->name == 'programming' ? 'selected' : '' }}>Programming</option>
                                                    <option value="operating-equipment" {{ $skill->name == 'operating-equipment' ? 'selected' : '' }}>Operating Equipment</option>
                                                    <option value="engineering" {{ $skill->name == 'engineering' ? 'selected' : '' }}>Engineering</option>
                                                    <option value="experimenting" {{ $skill->name == 'experimenting' ? 'selected' : '' }}>Experimenting</option>
                                                    <option value="testing" {{ $skill->name == 'testing' ? 'selected' : '' }}>Testing</option>
                                                    <option value="constructing" {{ $skill->name == 'constructing' ? 'selected' : '' }}>Constructing</option>
                                                    <option value="restoring" {{ $skill->name == 'restoring' ? 'selected' : '' }}>Restoring</option>
                                                    <option value="product-developing" {{ $skill->name == 'product-developing' ? 'selected' : '' }}>Product Developing</option>
                                                    <option value="quality-controlling" {{ $skill->name == 'quality-controlling' ? 'selected' : '' }}>Quality Controlling</option>
                                                    <option value="blueprint-drafting" {{ $skill->name == 'blueprint-drafting' ? 'selected' : '' }}>Blueprint Drafting</option>
                                                    <option value="repairing" {{ $skill->name == 'repairing' ? 'selected' : '' }}>Repairing</option>
                                                </optgroup>
                                                <optgroup label="Language Skills">
                                                    <option value="translating" {{ $skill->name == 'translating' ? 'selected' : '' }}>Translating</option>
                                                    <option value="speaking" {{ $skill->name == 'speaking' ? 'selected' : '' }}>Speaking</option>
                                                    <option value="writing" {{ $skill->name == 'writing' ? 'selected' : '' }}>Writing</option>
                                                    <option value="conversing" {{ $skill->name == 'conversing' ? 'selected' : '' }}>Conversing</option>
                                                    <option value="reinterpretating" {{ $skill->name == 'reinterpretating' ? 'selected' : '' }}>Reinterpreting</option>
                                                    <option value="public-speaking" {{ $skill->name == 'public-speaking' ? 'selected' : '' }}>Public Speaking</option>
                                                    <option value="following-etiquette" {{ $skill->name == 'following-etiquette' ? 'selected' : '' }}>Following Etiquette</option>
                                                    <option value="explaining" {{ $skill->name == 'explaining' ? 'selected' : '' }}>Explaining</option>
                                                    <option value="respecting" {{ $skill->name == 'respecting' ? 'selected' : '' }}>Respecting</option>
                                                    <option value="signaling" {{ $skill->name == 'signaling' ? 'selected' : '' }}>Signaling</option>
                                                    <option value="proofreading" {{ $skill->name == 'proofreading' ? 'selected' : '' }}>Proofreading</option>
                                                    <option value="introducing" {{ $skill->name == 'introducing' ? 'selected' : '' }}>Introducing</option>
                                                    <option value="representing" {{ $skill->name == 'representing' ? 'selected' : '' }}>Representing</option>
                                                    <option value="rephrasing" {{ $skill->name == 'rephrasing' ? 'selected' : '' }}>Rephrasing</option>
                                                    <option value="code-switching" {{ $skill->name == 'code-switching' ? 'selected' : '' }}>Code-switching</option>
                                                </optgroup>
                                                <optgroup label="Design Skills">
                                                    <option value="graphic-design" {{ $skill->name == 'graphic-design' ? 'selected' : '' }}>Graphic Design</option>
                                                    <option value="user-experience-development" {{ $skill->name == 'user-experience-development' ? 'selected' : '' }}>User Experience Development</option>
                                                    <option value="user-interface-development" {{ $skill->name == 'user-interface-development' ? 'selected' : '' }}>User Interface Development</option>
                                                    <option value="typography" {{ $skill->name == 'typography' ? 'selected' : '' }}>Typography</option>
                                                    <option value="layout-development" {{ $skill->name == 'layout-development' ? 'selected' : '' }}>Layout Development</option>
                                                    <option value="web-design" {{ $skill->name == 'web-design' ? 'selected' : '' }}>Web Design</option>
                                                    <option value="data-visualization" {{ $skill->name == 'data-visualization' ? 'selected' : '' }}>Data Visualization</option>
                                                    <option value="photo-and-video-editing" {{ $skill->name == 'photo-and-video-editing' ? 'selected' : '' }}>Photo and Video Editing</option>
                                                    <option value="wireframing" {{ $skill->name == 'wireframing' ? 'selected' : '' }}>Wireframing</option>
                                                </optgroup>
                                                <optgroup label="Analytical Skills">
                                                    <option value="researching" {{ $skill->name == 'researching' ? 'selected' : '' }}>Researching</option>
                                                    <option value="interpreting" {{ $skill->name == 'interpreting' ? 'selected' : '' }}>Interpreting</option>
                                                    <option value="information-processing" {{ $skill->name == 'information-processing' ? 'selected' : '' }}>Information Processing</option>
                                                    <option value="organizing" {{ $skill->name == 'organizing' ? 'selected' : '' }}>Organizing</option>
                                                    <option value="processing" {{ $skill->name == 'processing' ? 'selected' : '' }}>Processing</option>
                                                    <option value="graphing" {{ $skill->name == 'graphing' ? 'selected' : '' }}>Graphing</option>
                                                    <option value="computing" {{ $skill->name == 'computing' ? 'selected' : '' }}>Computing</option>
                                                    <option value="calculating" {{ $skill->name == 'calculating' ? 'selected' : '' }}>Calculating</option>
                                                    <option value="modeling" {{ $skill->name == 'modeling' ? 'selected' : '' }}>Modeling</option>
                                                    <option value="extrapolating" {{ $skill->name == 'extrapolating' ? 'selected' : '' }}>Extrapolating</option>
                                                    <option value="predicting" {{ $skill->name == 'predicting' ? 'selected' : '' }}>Predicting</option>
                                                    <option value="forecasting" {{ $skill->name == 'forecasting' ? 'selected' : '' }}>Forecasting</option>
                                                    <option value="investigating" {{ $skill->name == 'investigating' ? 'selected' : '' }}>Investigating</option>
                                                    <option value="surveying" {{ $skill->name == 'surveying' ? 'selected' : '' }}>Surveying</option>
                                                    <option value="statistical-analysis" {{ $skill->name == 'statistical-analysis' ? 'selected' : '' }}>Statistical Analysis</option>
                                                </optgroup>

                                            </select>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="experience">Experience Level</label>
                                                <select id="experience" name="experience" class="form-control">
                                                    <option value="Beginner" {{ $skill->experience == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                                    <option value="Intermediate" {{ $skill->experience == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                    <option value="Expert" {{ $skill->experience == 'Expert' ? 'selected' : '' }}>Expert</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="cost_type">Cost Type</label>
                                                <select id="cost_type" name="cost_type" class="form-control">
                                                    <option value="per_hour" {{ $skill->cost_type == 'per_hour' ? 'selected' : '' }}>Per Hour</option>
                                                    <option value="per_task"{{ $skill->cost_type == 'per_task' ? 'selected' : '' }}>Per Project</option>
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
                                                    <input id="cost" name="cost" placeholder="Enter Cost" type="number" class="form-control text-end" min="0" step="100" value="{{$skill->cost}}">

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
                                                <input id="portfolio_url" name="portfolio_url" placeholder="Enter portfolio URL" type="url" class="form-control" value="{{$skill->portfolio_url}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="offer_as_service">Offer as a Service</label>
                                                <select id="offer_as_service" name="offer_as_service" class="form-control">
                                                    <option value="1" {{ $skill->availability ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ !$skill->availability ? 'selected' : '' }}>No</option>
                                                </select>

                                            </div>
                                        </div>
                                        
                                    </div>
    
                                
                            </div>
                        </div>
                    </div>

                    <div class="card" id="availability-card" style=" {{ !$skill->availability ? 'display: none;' : '' }}" >
                        <a href="#addproduct-img-collapse" class="text-body collbodyd" data-bs-toggle="collapse"
                            aria-haspopup="true" aria-expanded="true"
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
                                        @if(!empty($days))
                                            @foreach($days as $index => $day)
                                                <div class="availability-row row mb-3">
                                                    <div class="col-md-3">
                                                        <label for="day" class="form-label">Day</label>
                                                        <select class="form-control" name="day[]">
                                                            <option value="Mo" {{ $day == 'Mo' ? 'selected' : '' }}>Monday</option>
                                                            <option value="Tu" {{ $day == 'Tu' ? 'selected' : '' }}>Tuesday</option>
                                                            <option value="We" {{ $day == 'We' ? 'selected' : '' }}>Wednesday</option>
                                                            <option value="Th" {{ $day == 'Th' ? 'selected' : '' }}>Thursday</option>
                                                            <option value="Fr" {{ $day == 'Fr' ? 'selected' : '' }}>Friday</option>
                                                            <option value="Sa" {{ $day == 'Sa' ? 'selected' : '' }}>Saturday</option>
                                                            <option value="Su" {{ $day == 'Su' ? 'selected' : '' }}>Sunday</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="start-time" class="form-label">Start Time</label>
                                                        <input type="time" name="start_time[]" class="form-control" value="{{ $startTimes[$index] }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="end-time" class="form-label">End Time</label>
                                                        <input type="time" name="end_time[]" class="form-control" value="{{ $endTimes[$index] }}">
                                                    </div>
                                                    <div class="col-md-3 d-flex align-items-end">
                                                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
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
                                                <input type="time" name="start_time[]" class="form-control" >
                                            </div>
                                            <div class="col-md-3">
                                                <label for="end-time" class="form-label">End Time</label>
                                                <input type="time" name="end_time[]" class="form-control" >
                                            </div>
                                            <div class="col-md-3 d-flex align-items-end">
                                                <button type="button" class="btn btn-danger remove-row">Remove</button>
                                            </div>
                                        </div>
                                        @endif
                                        
                                    </div>
                                    <!-- Add Availability Button -->
                                    <button type="button" id="add-availability" class="btn btn-primary mt-3">Add</button>
                                
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        

            <div class="row mb-4">
                        <div class="col text-end">
                            <a href="#" class="btn btn-danger"> <i class="bx bx-x me-1"></i> Cancel </a>
                            
                            <button type="submit" class="btn btn-success"> <i class="bx bx-file me-1"></i> Update </button>
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
