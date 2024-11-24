<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventReview;
use Auth;
use Illuminate\Http\Request;

class EventReviewController extends Controller
{
    //
    /**
     * Display a listing of reviews for a specific event.
     */
    public function index($eventId)
    {
        $event = Event::findOrFail($eventId);
        $reviews = $event->reviews()->with('user')->get();

        return view('event_reviews.index', compact('event', 'reviews'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create(string $eventId)
    {
        $event = Event::findOrFail($eventId);

        return view('event_reviews.create', compact('event'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_message' => 'nullable|string|max:500',
        ]);
        EventReview::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'rating' => $validated['rating'],
            'comment' => $validated['review_message'],
        ]);

        return redirect()->route('events.show', $eventId)->with('success', 'Review added successfully.');
    }

    /**
     * Show the form for editing an existing review.
     */
    public function edit($reviewId)
    {
        $review = EventReview::findOrFail($reviewId);

        // Ensure the logged-in user owns the review
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('event_reviews.edit', compact('review'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, $reviewId)
    {
        $review = EventReview::findOrFail($reviewId);

        // Ensure the logged-in user owns the review
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $review->update($validated);

        return redirect()->route('event_reviews.index', $review->event_id)->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy($reviewId)
    {
        $review = EventReview::findOrFail($reviewId);

        // Ensure the logged-in user owns the review
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $review->delete();

        return redirect()->route('event_reviews.index', $review->event_id)->with('success', 'Review deleted successfully.');
    }


}
