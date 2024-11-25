<?php

namespace App\Http\Controllers;

use App\Models\EquipmentCategory;
use App\Models\EventCategory;
use App\Models\EventDomain;
use App\Models\Event;

use App\Models\FurnitureCategory;
use App\Models\Post;
use App\Models\RoomCategory;
use App\Models\SkillName;
use App\Models\TransportationCategory;
use Auth;
use Illuminate\Http\Request;
use Log;

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
        $events = Auth::user()->events()->paginate(8);
        return view('events.myEvents', compact('events'));
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
        $categories=EventCategory::all();
        $domains = EventDomain::all();
        $skills = SkillName::all();
        // Fetch asset type categories
        $furnitureCategories = FurnitureCategory::all();
        $transportationCategories = TransportationCategory::all();
        $roomCategories = RoomCategory::all();
        $equipmentCategories = EquipmentCategory::all();
       
        return view('events.create',compact('categories','domains','skills',
            'furnitureCategories',
            'transportationCategories',
            'roomCategories',
            'equipmentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        dd($request->input());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $event = Event::with(['categories', 'domains', 'organizer', 'reviews','timeLine'])->findOrFail($id);
        $userReview = $event->reviews()->where('user_id', auth()->id())->first(); // Get the user's review if it exists
        //dd($event);
        $timelineEvents = [
            [
                'date' => '25',
                'month' => 'June',
                'title' => 'Timeline Event One',
                'description' => 'Perspitis unde omnis iste natus error sit voluptatem accusantium doloremque.',
                'icon' => 'bx-briefcase-alt-2',
                'images' => [],
                'button' => false,
                'link' => null,
                'alignment' => 'right',
            ],
            [
                'date' => '25',
                'month' => 'June',
                'title' => 'Timeline Event Two',
                'description' => 'At vero eos dignissimos ducimus quos dolores.',
                'icon' => 'bx-user-pin',
                'images' => ['img-2.jpg', 'img-5.jpg'],
                'button' => false,
                'link' => null,
                'alignment' => 'left',
            ],
            [
                'date' => '28',
                'month' => 'Dec',
                'title' => 'Timeline Event Three',
                'description' => 'Vivamus ultrices massa interdum eu.',
                'icon' => 'bx-bar-chart-square',
                'images' => [],
                'button' => false,
                'link' => null,
                'alignment' => 'right',
            ],
            // Add more events...
        ];

        return view('events.show',compact('event','timelineEvents','userReview'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        return view('events.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try
        {
            $event = Event::findOrFail($id);
            return view('events.edit', compact('event'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log the error if the event is not found  
            Log::error("Event with ID {$id} not found. Deletion failed.");

            return redirect()->back()->with('error', 'Event not found. Unable to delete.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the event by ID
            $event = Event::findOrFail($id);

            // Check if the authenticated user is the organizer of the event
            if (auth()->id() !== $event->organizer_id) {
                Log::warning("Unauthorized deletion attempt by user ID: " . auth()->id() . " for event ID: {$id}");

                return redirect()->route('events.index')->with('error', 'You are not authorized to delete this event.');
            }

            // Log the event deletion attempt
            Log::info("User ID: " . auth()->id() . " is attempting to delete event ID: {$id}");

            // Delete the event
            $event->delete();

            // Log the successful deletion
            Log::info("Event with ID {$id} deleted successfully by user ID: " . auth()->id());

            return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log the error if the event is not found
            Log::error("Event with ID {$id} not found. Deletion failed.");

            return redirect()->route('events.index')->with('error', 'Event not found. Unable to delete.');
        } catch (\Exception $e) {
            // Log any other exceptions
            Log::error("An error occurred while deleting the event with ID {$id}: {$e->getMessage()}");

            return redirect()->route('events.index')->with('error', 'An error occurred while trying to delete the event.');
        }
    }
    public function eventsByCategory(){
        $categories = EventCategory::all();
        $posts = Post::orderBy('updated_at', 'desc')->with(['comments', 'likes'])->paginate(10);
        return view('events.category.index',compact('categories','posts'));
    }
    public function eventsByCategoryName(string $name)
    {
        $categories = EventCategory::all();
        return $name;
    }
}
