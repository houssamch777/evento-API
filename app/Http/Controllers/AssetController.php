<?php

namespace App\Http\Controllers;

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
            'available_quantity' => 'nullable|integer|min:1',
            'condition' => 'nullable|string|in:new,good,fair,poor',
            'room_capacity' => 'nullable|integer|min:1',
            'transportation_capacity' => 'nullable|integer|min:1',
            'facilities' => 'nullable|array',
            'facilities.*' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // Validate the image
        ]);

        // Organize the form data into the structure needed by the API
        $assetData = [
            'name' => $validatedData['name'],
            'location' => $validatedData['location'],
            'description' => $validatedData['description'] ?? null,
            'daily_rental_price' => $validatedData['daily_rental_price'],
            'assetable_type' => $validatedData['asset_type'],
            'is_available' => true,
            'assetable_data' => [
                'available_quantity' => $validatedData['available_quantity'] ?? '',
                'condition' => $validatedData['condition'] ?? '',
                'facilities' => $validatedData['facilities'] ?? [],
            ],
        ];

        // Convert to JSON string
        
        // Additional logic for asset type
        if ($validatedData['asset_type'] === 'room') {
            $assetData['assetable_data']['capacity'] = $validatedData['room_capacity'];
        }

        if ($validatedData['asset_type'] === 'transportation') {
            $assetData['assetable_data']['capacity'] = $validatedData['transportation_capacity'];
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
        dd($asset);
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

        // Send the POST request with the image and other asset data
        $response = Http::withHeaders($headers)
            ->attach(
                'image',                // Field name expected by the API
                $fileResource,          // File resource
                $image->getClientOriginalName() // File name
            )
            ->post($apiUrl, $asset);  // Send the asset data
        dd($response->json());
        // Close the file resource
        fclose($fileResource);

        // Handle response
        if ($response->successful()) {
            return back()->with('success', 'Image uploaded successfully to the API!');
        }

        return back()->with('error', 'Failed to upload the image to the API: ' . $response->body());
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        dd($id);
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
