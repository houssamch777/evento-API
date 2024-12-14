<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventAssetNeed;
use App\Models\EventCategory;
use App\Models\EventDomain;
use App\Models\EventSkillNeed;
use App\Models\EventVisualIdentity;
use Auth;
use Illuminate\Http\Request;
use Storage;
use Str;

class EventManagerController extends Controller
{
    //
    public function eventPanel(string $id)
    {
        //
        
        $event = Event::findOrFail($id);
        
        //dd($event->allNeeds);
        //dd($event->organizer_id != auth()->user()->id);
        if($event->organizer_id !=auth()->user()->id)
        {
            return redirect()->route('myEvents')->with('error', 'Unable to get Access to this event.');
        }
        // Get all available categories and domains
        $availableCategories = EventCategory::all();
        $availableDomains = EventDomain::all();
        //$teams = Team::findOrFail($event->teams->id);
        return view('events.panel',compact('event','availableDomains','availableCategories'));
    }

    public function updateAssetNeed(Request $request)
    {
        
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $asset = EventAssetNeed::findOrFail($request->id);
        //dd($asset->event->organizer_id);
        if(auth()->user()->id!=$asset->event->organizer_id)
        {
            return redirect()->back()->withErrors('error', 'you dont have permisson to edit this Asset!');
        }
        $asset->quantity = $validated['quantity'];
        $asset->save();
        return redirect()->back()->with('success', 'Asset quantity updated successfully!');
    }
    public function updateSkill(Request $request)
    {

        //dd($request->input());

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $skill = EventSkillNeed::findOrFail($request->id);
        //dd($asset->event->organizer_id);
        if (auth()->user()->id != $skill->event->organizer_id) {
            return redirect()->back()->withErrors('error', 'you dont have permisson to edit this skill!');
        }
        $skill->quantity = $validated['quantity'];
        $skill->save();
        return redirect()->back()->with('success', 'skill quantity updated successfully!');
    }
    public function uploadLogo(Request $request, $eventId)
    {
        // Validate the cropped image
        //dd($request);
        $request->validate([
            'cropped_logo' => 'required',
        ]);

        $data = $request->input('cropped_logo');

        // Decode the base64 string
        $image = str_replace('data:image/png;base64,', '', $data);
        $image = str_replace(' ', '+', $image);

        // Generate a unique name for the image
        $imageName = Str::uuid() . '_' . time() . '.png';

        // Save the image to storage
        Storage::disk('public')->put('logos/' . $imageName, base64_decode($image));

        // Build the full image path
        $imagePath = 'logos/' . $imageName;

        // Fetch the event
        $event = Event::findOrFail($eventId);

        // Check if the event already has a logo
        if ($event->visualIdentity && $event->visualIdentity->logo_url) {
            if (Storage::disk('public')->exists($event->visualIdentity->logo_url)) {
                Storage::disk('public')->delete($event->visualIdentity->logo_url);
            }
        }

        // Update the logo path in the event's visual identity
        $visualIdentity = $event->visualIdentity ?: new EventVisualIdentity();
        $visualIdentity->logo_url = $imagePath;
        $event->visualIdentity()->save($visualIdentity);

        return back()->with('success', 'Event logo updated successfully.');
    }
    
    public function uploadBanner(Request $request, $eventId)
    {
        // Validate the cropped image
        //dd($request);
        $request->validate([
            'cropped_image' => 'required',
        ]);

        $data = $request->input('cropped_image');

        // Decode the base64 string
        $image = str_replace('data:image/png;base64,', '', $data);
        $image = str_replace(' ', '+', $image);

        // Generate a unique name for the image
        $imageName = Str::uuid() . '_' . time() . '.png';

        // Save the image to storage
        Storage::disk('public')->put('banners/' . $imageName, base64_decode($image));

        // Build the full image path
        $imagePath = 'banners/' . $imageName;

        // Fetch the event
        $event = Event::findOrFail($eventId);

        // Check if the event already has a banner
        if ($event->visualIdentity && $event->visualIdentity->banner_url) {
            if (Storage::disk('public')->exists($event->visualIdentity->banner_url)) {
                Storage::disk('public')->delete($event->visualIdentity->banner_url);
            }
        }

        // Update the banner path in the event's visual identity
        $visualIdentity = $event->visualIdentity ?: new EventVisualIdentity();
        $visualIdentity->banner_url = $imagePath;
        $event->visualIdentity()->save($visualIdentity);

        return back()->with('success', 'Event banner updated successfully.');
    }

    public function destroyEventNeed($id){
        $assetNeed = EventAssetNeed::findOrFail($id);

        // Ensure the user is the organizer of the event
        if ($assetNeed->event->organizer_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this asset need.');
        }
        // Delete the `AssetNeed` itself
        $assetNeed->delete();

        return redirect()->back()->with('success', 'Asset need and associated asset deleted successfully.');
    }

}
