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
use App\Models\Team;
use App\Models\TransportationCategory;
use App\Notifications\EventoNotification;
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
        $events = Event::orderBy('created_at', 'desc')->with(['categories', 'visualIdentity','domains'])->paginate(10);
        return view('events.index', compact('events'));
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
        // Fetch the event with related models (excluding reviews for eager loading)
        $event = Event::with([
            'categories:id,name',
            'domains:id,name',
            'organizer:id,name,profile_picture',
            'visualIdentity',
            'timeLine'
        ])->findOrFail($id);

        $rating = $event->getAverageRatingAttribute(); // Get the rating value
        $fullStars = floor($rating); // Number of full stars
        $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0; // Check if there's a half star
        $emptyStars = 5 - ($fullStars + $halfStar); // Remaining stars

        // Fetch paginated reviews for the event
        $reviews = $event->reviews()->paginate(5); // Paginate 5 reviews per page

        // Get the authenticated user's review, if it exists
        $userReview = $event->reviews()->where('user_id', auth()->id())->first();

        return view('events.show', compact('event', 'userReview', 'rating', 'fullStars', 'halfStar', 'emptyStars', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
        $event = Event::findOrFail($id);
        //dd($event->allNeeds);
        //dd($event->organizer_id != auth()->user()->id);
        if($event->organizer_id !=auth()->user()->id)
        {
            return redirect()->route('myEvents')->with('error', 'Unable to get Access to this event.');
        }
        //$teams = Team::findOrFail($event->teams->id);
        return view('events.edit',compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Get the authenticated user
        $organizer = auth()->user();

        // Check if the user is the organizer of the event
        $event = Event::findOrFail($id);
        if ($event->organizer_id !== $organizer->id) {
            return redirect()->route('events.index')
                ->with('error', 'You do not have permission to update this event.');
        }

        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:event_categories,id',
            'domains' => 'nullable|array',
            'domains.*' => 'exists:event_domains,id',
            'type' => 'required|in:in-person,online',
            'privacy' => 'nullable|boolean',
            'certificate' => 'nullable|boolean',
            'fee' => 'nullable|boolean',
            'fee_types' => 'nullable|array',
            'fee_amounts' => 'nullable|array',
            'fee_types.*' => 'nullable|string|max:255',
            'fee_amounts.*' => 'nullable|numeric|min:0',
        ]);
        //dd($validatedData, $event, $organizer, $event->categories(), $event->domains());
        try {
            // Update basic details
            $event->name = $validatedData['name'];
            $event->description = $validatedData['description'];
            $event->start_date = $validatedData['start_date'];
            $event->end_date = $validatedData['end_date'];
            $event->type = $validatedData['type'];
            $event->privacy = isset($validatedData['privacy']) ? true : false;
            $event->certificate = isset($validatedData['certificate']) ? true : false;
            $event->fee = isset($validatedData['fee']) ? true : false;

            // Update categories and domains
            $event->categories()->sync($validatedData['categories'] ?? []);
            $event->domains()->sync($validatedData['domains'] ?? []);

            // Update fees
            if ($event->fee && isset($validatedData['fee_types'], $validatedData['fee_amounts'])) {
                $event->fees()->delete(); // Clear previous fees
                foreach ($validatedData['fee_types'] as $index => $type) {
                    $event->fees()->create([
                        'type' => $type,
                        'amount' => $validatedData['fee_amounts'][$index],
                    ]);
                }
            }

            // Save the event
            $event->save();

            // Send notification to the organizer
            $title = 'Event Updated Successfully';
            $message = "Your event '{$event->name}' has been updated successfully.";
            $imagePath = null; // Update this with the actual path
            $url = route('events-panel', $event->id); // Event detail page URL
            $organizer->notify(new EventoNotification($title, $message, $imagePath, $url));

            return redirect()->route('events-panel', $event->id)
                ->with('success', 'Event updated successfully.');
        } catch (\Exception $e) {
            // Handle any exceptions
            return redirect()->route('events-panel', $event->id)
                ->with('error', 'An error occurred while updating the event. Please try again.');
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
    public function loadMoreReviews(Request $request, string $eventId)
    {
        $event = Event::findOrFail($eventId);
        $reviews = $event->reviews()
            ->with('user:id,first_name,last_name,profile_picture')
            ->latest()
            ->paginate(5, ['*'], 'page', $request->get('page', 1));

        return response()->json($reviews);
    }
    public function fetchEvents(Request $request)
    {
        $events = Event::query()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.event', compact('events'))->render(),
            ]);
        }

        return view('events.index', compact('events'));
    }


    public function liveSearch(Request $request)
    {
        $query = $request->input('query');
        $location = $request->input('location');
        $date = $request->input('date');

        // Fetch matching events
        $events = Event::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })->get();
        /*->when($location, function ($q) use ($location) {
                $q->where('location', 'like', "%{$location}%");
            })
            ->when($date, function ($q) use ($date) {
                $q->whereDate('event_date', $date);
            })*/
        // Return results as a view
        return response()->json(view('events.partials.live_search_results', compact('events'))->render());
    }

}
