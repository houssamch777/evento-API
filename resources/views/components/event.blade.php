

<div id="post">
        <div class="col-sm-6 col-lg-12">
        <div class="card">
                    <!-- Event Image -->
        <img src="{{$event->visualIdentity->banner_url}}" class="card-img-top" alt="{{ $event->name }}">
        <!-- Event Information -->
        <div class="card-body">
            <h5 class="card-title">{{ $event->name }}</h5>
            <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
            
            <!-- Event Type (e.g., online or in-person) -->
            <span class="badge badge-info">{{ $event->event_type }}</span>
            
            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary mt-3">View Details</a>
        </div>
        </div>
    </div><!-- end col -->
</div>