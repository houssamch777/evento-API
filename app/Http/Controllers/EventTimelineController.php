<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTimeline;
use Illuminate\Http\Request;

class EventTimelineController extends Controller
{
    //
    public function index(Event $event)
    {
        return view('timeline.index', ['event' => $event->load('timeLine')]);
    }

    /**
     * Show the form for creating a new timeline entry.
     */
    public function create(Event $event)
    {
        return view('timeline.create', ['event' => $event]);
    }

    /**
     * Store a newly created timeline entry in storage.
     */
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        $event->timeLine()->create($request->only('title', 'description', 'start_time', 'end_time'));

        return redirect()->route('timeline.index', $event)
            ->with('success', 'Timeline entry created successfully!');
    }

    /**
     * Show the form for editing a timeline entry.
     */
    public function edit(EventTimeline $timeline)
    {
        return view('timeline.edit', ['timeline' => $timeline]);
    }

    /**
     * Update the specified timeline entry in storage.
     */
    public function update(Request $request, EventTimeline $timeline)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        $timeline->update($request->only('title', 'description', 'start_time', 'end_time'));

        return redirect()->route('timeline.index', $timeline->event_id)
            ->with('success', 'Timeline entry updated successfully!');
    }

    /**
     * Remove the specified timeline entry from storage.
     */
    public function destroy(EventTimeline $timeline)
    {
        $eventId = $timeline->event_id;
        $timeline->delete();

        return redirect()->route('timeline.index', $eventId)
            ->with('success', 'Timeline entry deleted successfully!');
    }
}
