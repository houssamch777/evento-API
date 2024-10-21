<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use App\Models\EventDomain;
use App\Models\Event;
use Auth;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Retrieve the authenticated user's assets with their associated assetable models
        

        // Pass the categorized assets to the view
        return null;
    }
    public function myEvents()
    {
        $events = Auth::user()->events()->paginate(8);
        return view('events.myEvents', compact('events'));
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
