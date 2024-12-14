<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Models\BoostedEvent;
use App\Models\Event;
use Illuminate\Http\Request;

class BoostedEventController extends Controller
{
    //
    public function boostEvent(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'boost_start' => 'required|date',
            'boost_end' => 'required|date|after:boost_start',
        ]);

        // Use a direct query to check and update the record if it exists
        $updated = BoostedEvent::where('event_id', $request->input('event_id'))
            ->update([
                'boost_start' => $request->input('boost_start'),
                'boost_end' => $request->input('boost_end'),
            ]);

        if (!$updated) {
            // If no record was updated, create a new one
            BoostedEvent::create([
                'event_id' => $request->input('event_id'),
                'boost_start' => $request->input('boost_start'),
                'boost_end' => $request->input('boost_end'),
            ]);
        }

        return back()->with('success', $updated ? 'Event boost updated successfully.' : 'Event boosted successfully.');
    }


}
