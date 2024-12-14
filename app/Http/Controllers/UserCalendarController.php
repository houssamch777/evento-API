<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Notifications\EventoNotification;
use Illuminate\Http\Request;

class UserCalendarController extends Controller
{
    //
    public function viewCalendar()
    {
        $user = auth()->user();

        // Get all events from the user's calendar
        $events = $user->calendarEvents()->with('event:id,name,start_date,end_date')->get();

        return view('user.calendar.view', compact('events'));
    }

    /**
     * Add an event to the user's calendar.
     */
    public function addToCalendar(Request $request, string $eventId)
    {
        $user = auth()->user();

        // Find the event
        $event = Event::findOrFail($eventId);


        // Check if the event is already in the user's calendar
        if ($user->calendarEvents()->where('event_id', $eventId)->exists()) {
            return back()->withErrors(['success' => 'Event is already in your calendar.']);
        }

        // Attach the event to the user's calendar
        $user->calendarEvents()->create([
        'event_id' => $eventId,
    ]);

        
        
        $message = 'Event added to your calendar successfully.';
        $title = 'Save Event !';

        $user->notify(new EventoNotification($title, $message, $user->profile_picture, route('profile')));
        return redirect()->route('calendar.view')->with(['success' => 'Event added to your calendar successfully.']);
    }

    /**
     * Remove an event from the user's calendar.
     */
    public function removeFromCalendar(Request $request)
    {
        $user = auth()->user();
        $eventId = $request->input('event_id');
        //dd($eventId);
        // Detach the event from the user's calendar
        // Check if the user has the event in their calendar
        $userEvent = $user->calendarEvents()->where('event_id', $eventId)->first();
        if ($userEvent) {
            // If the event exists in the user's calendar, delete it
            $userEvent->delete();

            // Optionally, return a success response or redirect
            $message = 'Event removed from your calendar successfully.';
            $title = 'Remove Event !';

            $user->notify(new EventoNotification($title, $message, $user->profile_picture, route('profile')));
            return redirect()->route('calendar.view')->with('success', 'Event removed from calendar successfully!');
        } else {
            // If the event is not found in the user's calendar
            return redirect()->route('calendar.view')->with('error', 'Event not found in your calendar!');
        }
    }
}
