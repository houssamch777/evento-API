<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoostedEvent;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = Event::all();
        $scheduledCount = $events->where('status', 'Scheduled')->count();
        $completedCount = $events->where('status', 'Completed')->count();
        $cancelledCount = $events->where('status', 'Cancelled')->count();
        $ongoingCount = $events->where('status', 'Ongoing')->count();
        $boostedEvents = BoostedEvent::with('event')->where('boost_end', '>', now())->get();
        return view('admin.events.index',compact(['events',
            'scheduledCount',
            'completedCount',
            'cancelledCount',
            'ongoingCount',
            'boostedEvents'
        ]));        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
