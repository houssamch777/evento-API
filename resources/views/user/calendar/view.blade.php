@extends('layouts.master')
@section('title')
Calendar
@endsection
@section('css')
@endsection
@section('page-title')
Calendar
@endsection
@section('body')

<body>
    @endsection
    @section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <a href="{{route('events.create')}}" class="btn btn-outline-success w-100" id="btn-new-event"><i class="mdi mdi-plus"></i> Create
                                New Event</a>
                            <div id="external-events">
                                <br>
                                <p class="text-muted">your saved Events</p>
                                <!-- Dynamically generated events -->
                                <div id="external-events-list"></div>
                            </div>
                            <div class="row justify-content-center mt-5">
                                <img src="{{ URL::asset('build/images/calendar-img.png') }}" alt=""
                                    class="img-fluid d-block">
                            </div>

                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-xl-9">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

            <div style="clear:both"></div>


            <!-- end modal-->
            <!-- Modal Confirmation -->
            <div class="modal fade" id="eventConfirmationModal" tabindex="-1"
                aria-labelledby="eventConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eventConfirmationModalLabel">Do you want to visit the event
                                page?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            You will be redirected to the event details page. Are you sure?
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" id="confirmVisitEvent">Yes, Visit</button>
                            <!-- Button to remove the event -->
                            <!-- Form to remove event -->
                            <form id="removeEventForm" method="POST" action="{{ route('calendar.remove') }}">
                                @csrf
                                <input type="hidden" name="event_id" id="event_id">
                                <button type="submit" class="btn btn-warning">Remove Event</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    @endsection
    @section('scripts')
    <!-- plugin js -->
    <script src="{{ URL::asset('build/libs/fullcalendar/index.global.min.js') }}"></script>

    <!-- Calendar init -->
    <script>
        /*
        Template Name: webadmin - Admin & Dashboard Template
        Author: Themesdesign
        Website: https://Themesdesign.com/
        Contact: Themesdesign@gmail.com
        File: Calendar init js
        */
    
        document.addEventListener("DOMContentLoaded", function() {
            
            var eventsData = @json($events); // Passing data from Laravel to JavaScript
            var eventClasses = ['bg-primary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info'];
    
            // Convert events data to the format required by FullCalendar
            var fullCalendarEvents = eventsData.map(function(event) {
                var randomClass = eventClasses[Math.floor(Math.random() * eventClasses.length)];
                return {
                    title: event.event.name, // Event title
                    start: event.event.start_date, // Event start date
                    end: event.event.end_date, // Event end date
                    id: event.event.id, // Event ID
                    className: randomClass // Event class (you can customize this)
                };
            });
            // Dynamically add events to the external-events section
            var externalEventsList = document.getElementById('external-events-list');
            fullCalendarEvents.forEach(function(event) {
            var eventElement = document.createElement('div');
            eventElement.classList.add('external-event', 'fc-event', event.className);
            eventElement.setAttribute('data-class', event.className);
            eventElement.innerHTML = `
            <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>${event.title}
            `;
            externalEventsList.appendChild(eventElement);
            });
            var calendarEl = document.getElementById('calendar');
    
            function getInitialView() {
                if (window.innerWidth >= 768 && window.innerWidth < 1200) {
                    return 'timeGridWeek';
                } else if (window.innerWidth <= 768) {
                    return 'listMonth';
                } else {
                    return 'dayGridMonth';
                }
            }
    
            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'local',
                editable: false, // Disable editing (dragging and resizing events)
                droppable: false, // Disable dragging events
                selectable: true, // Enable date selection
                initialView: getInitialView(),
                themeSystem: 'bootstrap',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                windowResize: function(view) {
                    var newView = getInitialView();
                    calendar.changeView(newView);
                },
                eventClick: function(info) {
                    var eventId = info.event.id;
    
                    // Show the confirmation modal
                    var modal = new bootstrap.Modal(document.getElementById('eventConfirmationModal'), {
                        keyboard: false
                    });
                    modal.show();
    
                    // When the user clicks "Yes, Visit"
                    document.getElementById('confirmVisitEvent').addEventListener('click', function() {
                        var routeUrl = '{{ route("events.show", ":id") }}';
                        routeUrl = routeUrl.replace(':id', eventId);  // Replace :id with the actual event ID
                        window.location.href = routeUrl;  // Redirect to the event page
                    });
                    document.getElementById('event_id').value = eventId;
                    // When the user clicks "Remove Event", the form is submitted
                    document.getElementById('removeEventForm').addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent the default form submission
                        // Submit the form to the backend route
                        this.submit();
                        modal.hide(); // Close the modal after submitting
                    });
    
                    // Close the modal if the user cancels
                    document.getElementById('eventConfirmationModal').addEventListener('hidden.bs.modal', function () {
                        // You can add any other actions here if needed
                    });
                },
                events: fullCalendarEvents
            });
    
            calendar.render();
        });
    </script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection