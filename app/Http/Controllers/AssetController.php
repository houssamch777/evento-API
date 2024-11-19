<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetReview;
use App\Models\EquipmentCategory;
use App\Models\Facility;
use App\Models\FurnitureCategory;
use App\Models\Location;
use App\Models\RoomCategory;
use App\Models\TransportationCategory;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve the authenticated user's assets with their associated assetable models
        $assets = Auth::user()->assets;


        // Pass the categorized assets to the view
        return view('asset.index', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $equipmentCategories = EquipmentCategory::all();
        $facilities = Facility::all();
        $furnitureCategories = FurnitureCategory::all();
        $roomCategories = RoomCategory::all();
        $transportationCategories = TransportationCategory::all();
        $locations = Location::all();
        return view('asset.create', compact(
            'equipmentCategories',
            'facilities',
            'furnitureCategories',
            'roomCategories',
            'transportationCategories',
            'locations'
        ));
    }





    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'asset_type' => 'required|string|in:equipment,room,furniture,transportation',
            'name' => 'required|string|max:255',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'daily_rental_price' => 'required|numeric|min:0',
            'room_category_id' => 'nullable|exists:room_categories,id',
            'equipment_category_id' => 'nullable|exists:equipment_categories,id',
            'furniture_category_id' => 'nullable|exists:furniture_categories,id',
            'transportation_category_id' => 'nullable|exists:transportation_categories,id',
            'equipment_available_quantity' => 'nullable|integer|min:1',
            'furniture_available_quantity' => 'nullable|integer|min:1',
            'condition' => 'nullable|string|in:new,good,fair,poor',
            'room_capacity' => 'nullable|integer|min:1',
            'transportation_capacity' => 'nullable|integer|min:1',
            'facilities' => 'nullable|array',
            'facilities.*' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // Validate the image
        ]);
        //dd($validatedData);
        // Organize the form data into the structure needed by the API
        $assetData = [
            'name' => $validatedData['name'],
            'location' => $validatedData['location'],
            'description' => $validatedData['description'] ?? null,
            'daily_rental_price' => $validatedData['daily_rental_price'],
            'assetable_type' => $validatedData['asset_type'],
            'is_available' => true,
            'assetable_data' => [],
        ];

        // Convert to JSON string
        
        // Additional logic for asset type
        if ($validatedData['asset_type'] === 'room') {
            $assetData['assetable_data']['capacity'] = $validatedData['room_capacity'];
            $assetData['assetable_data']['facilities'] = $validatedData['facilities'];
        }

        if ($validatedData['asset_type'] === 'transportation') {
            $assetData['assetable_data']['capacity'] = $validatedData['transportation_capacity'];
        }
        // Additional logic for asset type
        if ($validatedData['asset_type'] === 'equipment') {
            $assetData['assetable_data']['available_quantity'] = $validatedData['equipment_available_quantity'];
            $assetData['assetable_data']['condition'] = $validatedData['condition'];
        }

        if ($validatedData['asset_type'] === 'furniture') {
            $assetData['assetable_data']['available_quantity'] = $validatedData['furniture_available_quantity'];
        }

        // Handle category-specific fields
        if ($validatedData['asset_type'] === 'room' && $validatedData['room_category_id']) {
            $assetData['assetable_data']['room_category_id'] = $validatedData['room_category_id'];
        }

        if ($validatedData['asset_type'] === 'equipment' && $validatedData['equipment_category_id']) {
            $assetData['assetable_data']['equipment_category_id'] = $validatedData['equipment_category_id'];
        }

        if ($validatedData['asset_type'] === 'furniture' && $validatedData['furniture_category_id']) {
            $assetData['assetable_data']['furniture_category_id'] = $validatedData['furniture_category_id'];
        }

        if ($validatedData['asset_type'] === 'transportation' && $validatedData['transportation_category_id']) {
            $assetData['assetable_data']['transportation_category_id'] = $validatedData['transportation_category_id'];
        }
        $assetableDataJson = json_encode($assetData['assetable_data']);
        
        $asset= [
            'name' => $validatedData['name'],
            'location' => $validatedData['location'],
            'description' => $validatedData['description'] ?? null,
            'daily_rental_price' => $validatedData['daily_rental_price'],
            'assetable_type' => $validatedData['asset_type'],
            'is_available' => true,
            'assetable_data' => $assetableDataJson
        ];
        //dd($asset);
        // Get authenticated user and token
        $user = Auth::user();
        $token = $user->createToken('asset-token')->plainTextToken;

        // Build the headers
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];

        // Get the uploaded image
        $image = $request->file('image');

        // Open the file as a resource
        $fileResource = fopen($image->getPathname(), 'r');

        // API endpoint URL
        $apiUrl = 'https://evento.witslinks.com/api/assets';
       //dd($asset);
        // Send the POST request with the image and other asset data
        $response = Http::withHeaders($headers)
            ->attach(
                'image',                // Field name expected by the API
                $fileResource,          // File resource
                $image->getClientOriginalName() // File name
            )
            ->post($apiUrl, $asset);  // Send the asset data
        // Close the file resource
        fclose($fileResource);

        // Handle response
        if ($response->successful()) {
            return redirect()->route('asset.index')->with('success', 'asset created successfully!');
        }

        return back()->with('error', 'Failed to add new asset: ' . $response->body());
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $asset = Asset::with('assetable')->findOrFail($id);
        $rating = $asset->averageRating(); // Get the rating value
        $fullStars = floor($rating); // Number of full stars
        $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0; // Check if there's a half star
        $emptyStars = 5 - ($fullStars + $halfStar); // Remaining stars
        $userReview = $asset->reviews()->where('user_id', auth()->id())->first(); // Get the user's review if it exists
        return view('asset.show',compact('asset','rating','fullStars','halfStar','emptyStars','userReview'));
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
        
        $user = Auth::user();
        $token = $user->createToken('asset-token')->plainTextToken;
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];
        $url = 'https://evento.witslinks.com/api/assets/' . $id;
        $response = Http::withHeaders($headers)->delete($url);
        
        if ($response->successful()) {

            return redirect()->route('asset.index')->with('success', 'asset link deleted successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this asset link.']);
        }

    }



    public function addReview(Request $request, $assetId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $review = AssetReview::updateOrCreate(
            ['asset_id' => $assetId, 'user_id' => auth()->id()],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );

        return redirect()->back()->with(['success' => 'Review submitted successfully!', 'data' => $review], 200);
    }
    public function storeOrUpdate(Request $request, $assetId)
    {
        $request->validate([
            'review_message' => 'required|string|max:500',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $asset = Asset::findOrFail($assetId);
        $user = auth()->user();

        // Check if the user has already reviewed the asset
        $review = $asset->reviews()->where('user_id', $user->id)->first();

        if ($review) {
            // Update existing review
            $review->message = $request->input('review_message');
            $review->save();
        } else {
            // Create a new review
            $asset->reviews()->create([
                'user_id' => $user->id,
                'message' => $request->input('review_message'),
                'rating' => $request->input('rating', 5), // Optional rating input
            ]);
        }

        return redirect()->route('assets.show', $assetId)->with('success', 'Your review has been submitted/updated.');
    }





}
