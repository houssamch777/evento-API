<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\EquipmentCategory;
use App\Models\EquipmentType;
use App\Models\Facility;
use App\Models\FurnitureCategory;
use App\Models\FurnitureType;
use App\Models\Location;
use App\Models\RoomCategory;
use App\Models\RoomType;
use App\Models\TransportationCategory;
use App\Models\TransportationType;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Redirect;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'asset_type' => 'required|string|in:equipment,room,furniture,transportation',
            'name' => 'required|string|max:255',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'daily_rental_price' => 'required|numeric|min:0',
            'room_category_id' => 'nullable|exists:room_categories,id', // Allow null or valid ID
            'equipment_category_id' => 'nullable|exists:equipment_categories,id', // Allow null or valid ID
            'furniture_category_id' => 'nullable|exists:furniture_categories,id', // Allow null or valid ID
            'transportation_category_id' => 'nullable|exists:transportation_categories,id', // Allow null or valid ID
            'available_quantity' => 'nullable|integer|min:1',
            'condition' => 'nullable|string|in:new,good,fair,poor',
            'capacity' => 'nullable|integer|min:1',
            'facilities' => 'nullable|array',
            'facilities.*' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // Add validation for the image
        ]);

        // Organize the form data into the structure needed by the API
        $assetData = [
            'name' => $validatedData['name'],
            'location' => $validatedData['location'],
            'description' => $validatedData['description'] ?? null,
            'daily_rental_price' => $validatedData['daily_rental_price'],
            'assetable_type' => $validatedData['asset_type'], // Room, Equipment, etc.
            'is_available'=>true,
            'assetable_data' => [
                'available_quantity' => $validatedData['available_quantity'],
                'condition' => $validatedData['condition'],
                'capacity' => $validatedData['capacity'],
                'facilities' => $validatedData['facilities'] ?? [], // Array of facilities (if provided)
            ]
        ];

        // Add categories only if they are not null
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

        // Prepare the image if it's provided
        $imageFile = $request->file('image');
        // Get the authenticated user and their token
        $user = Auth::user();
        $token = $user->createToken('assts-token')->plainTextToken;
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];

        // Prepare the data to send to the API
        $apiData = $assetData;
        if (isset($imageFile)) {
            $apiData['image'] = $imageFile; // Attach the image file to the API data
        }
        // Send the data to the API
        $response = Http::withHeaders($headers)->post('https://evento.witslinks.com/api/assets', $apiData);

        if ($response->successful()) {
            return redirect()->route('asset.index')->with('success', 'Asset successfully created');
        } else {
            dd($response->json()['message']);
            return back()->withErrors(['error' => $response->json()['message']]);
        }
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
