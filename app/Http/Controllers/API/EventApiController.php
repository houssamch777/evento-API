<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\EventDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = Event::paginate(10);
        return response()->json($events);
    }
    public function userEvents(Request $request)
    {
        $user = $request->user();

        // Retrieve events where the organizer_id matches the authenticated user's ID
        $events = Event::where('organizer_id', $user->id)->with(['categories', 'domains', 'fees', 'assetNeeds'])->get();

        return response()->json([
            'success' => true,
            'message' => 'User\'s own events retrieved successfully.',
            'data' => $events,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user(); // Get the authenticated user
    
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'fee' => 'required|boolean',
            'privacy' => 'required|boolean',
            'type' => 'required|string|in:online,in-person',
            'certificate' => 'required|boolean',
            'categories' => 'array',
            'categories.*' => 'integer|exists:event_categories,id',
            'domains' => 'array',
            'domains.*' => 'integer|exists:event_domains,id',
            'event_fees' => 'array',
            'event_fees.*.type' => 'required|string',
            'event_fees.*.amount' => 'required|numeric|min:0',
            'asset_needs' => 'array',
            'asset_needs.*.equipment_type_id' => 'required|integer|exists:equipment_types,id',
            'asset_needs.*.furniture_type_id' => 'required|integer|exists:furniture_types,id',
            'asset_needs.*.room_type_id' => 'required|integer|exists:room_types,id',
            'asset_needs.*.quantity' => 'required|integer|min:1',
            'asset_needs.*.notes' => 'nullable|string',
            // Validate skills needs
            'skill_needs' => 'array',
            'skill_needs.*.skill_name_id' => 'required|integer|exists:skill_names,id',
            'skill_needs.*.quantity' => 'required|integer|min:1',
        ]);
    
        // Create the event with the authenticated user's ID as organizer_id
        $event = Event::create(array_merge(
            $request->only([
                'name', 'description', 'start_date', 'end_date', 'fee', 'privacy', 'type', 'certificate'
            ]),
            ['organizer_id' => $user->id]
        ));
    
        // Attach categories and domains
        $event->categories()->attach($request->input('categories'));
        $event->domains()->attach($request->input('domains'));
    
        // Add event fees
        foreach ($request->input('event_fees', []) as $fee) {
            $event->fees()->create($fee);
        }
    
        // Add asset needs
        foreach ($request->input('asset_needs', []) as $need) {
            $event->assetNeeds()->create($need);
        }
    
        // Add skill needs
        foreach ($request->input('skill_needs', []) as $skillNeed) {
            $event->skillNeeds()->create([
                'skill_name_id' => $skillNeed['skill_name_id'],
                'quantity' => $skillNeed['quantity']
            ]);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Event created successfully',
            'data' => $event
        ], 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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





        // Get all event domains
        public function getDomains()
        {
            $domains = EventDomain::all();
            return response()->json($domains);
        }
    
        // Get all event categories
        public function getCategories()
        {
            $categories = EventCategory::all();
            return response()->json($categories);
        }

}
