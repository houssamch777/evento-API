@if($events->isNotEmpty())
    <div class="row">
        @forelse($events as $event)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/' .$event->visualIdentity->banner_url) }}" class="card-img-top"
                    alt="{{ $event->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $event->name }}</h5>
                    <p class="card-text text-muted text-truncate">{{ $event->description }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-success btn-sm">Learn
                        More</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p class="text-muted">No boosted events available at the moment. Check back later!</p>
        </div>
        @endforelse
    </div>
@else
<p class="text-muted">No results found.</p>
@endif