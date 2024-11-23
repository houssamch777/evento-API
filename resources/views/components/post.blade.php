
<div id="post">
    <div class="col-sm-6 col-lg-12">
        <div class="card">
            @if ($post->image_url)
                <img src="{{ asset($post->image_url) }}" class="card-img-top" alt="{{ $post->title }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ Str::limit($post->content, 100, '...') }}</p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <!-- Likes Section -->
                    <button type="button" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-thumbs-up"></i> {{ $post->likes->count() ?? 0 }} Likes
                    </button>
                    <!-- Share Button -->
                    <button type="button" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-share"></i> Share
                    </button>
                </div>
                <p class="card-text mt-3"><small class="text-muted">Last updated
                        </small></p>
            </div>
        </div>
    </div><!-- end col -->
</div>
