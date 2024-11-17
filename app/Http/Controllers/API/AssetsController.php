<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AssetResource;
use App\Http\Resources\AssetableResource;
use App\Models\Facility;
use Illuminate\Support\Facades\Log;
use App\Models\Asset;
use App\Models\Equipment;
use App\Models\Furniture;
use App\Models\Room;
use App\Models\Transportation;
use App\Notifications\EventoNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class AssetsController extends Controller implements HasMiddleware
{
    /**
     * Apply middleware to ensure only authenticated users can access these methods.
     */
    public static function middleware(){
        return [
            new Middleware('auth:sanctum')
        ];
    }

    /**
     * Display a listing of the authenticated user's assets.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Retrieve authenticated user's assets with their associated assetable models
        $assets = Auth::user()->assets()->with('assetable')->get();

        return response()->json([
            'success' => true,
            'data' => AssetResource::collection($assets),
        ], 200);
    }

    /**
     * Store a newly created asset and its related assetable entity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
 

     public function store(Request $request)
     {
         // Validate the incoming request data
         $validatedData = $request->validate([
             'assetable_type' => 'required|string|in:equipment,room,furniture,transportation',
             'assetable_data' => 'required|array',
             'assetable_data.equipment_category_id' => 'nullable|exists:equipment_categories,id',
             'assetable_data.furniture_category_id' => 'nullable|exists:furniture_categories,id',
             'assetable_data.room_category_id' => 'nullable|exists:room_categories,id',
             'assetable_data.transportation_category_id' => 'nullable|exists:transportation_categories,id',
             'assetable_data.available_quantity' => 'nullable|integer|min:1',
             'assetable_data.condition' => 'nullable|in:new,good,fair,poor',
             'assetable_data.capacity' => 'nullable|integer|min:1',
             'assetable_data.facilities' => 'nullable|array', // Validate the facilities field as an array
             'assetable_data.facilities.*' => 'nullable|string|exists:facilities,name', // If facilities are linked to a 'facilities' table
             'daily_rental_price' => 'required|numeric|min:0',
             'name' => 'required|string|max:255',
             'description' => 'nullable|string',
             'is_available' => 'required|boolean',
             'location' => 'nullable|string',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
         ]);
         // Handle image upload if provided
         $imageUrl = null;
         if ($request->hasFile('image')) {
             // Store the image in the 'public/assets/images' directory
             $path = $request->file('image')->store('assets/images', 'public');
             $imageUrl = Storage::url($path); // Get the URL to the stored image
         }
     
         // Create the assetable entity based on the assetable_type
         $assetable = $this->createAssetable(
             $validatedData['assetable_type'],
             $validatedData['assetable_data']
         );
     
         // If the assetable entity could not be created, return an error
         if (!$assetable) {
             // Optionally, delete the uploaded image if asset creation fails
             if (isset($path) && Storage::disk('public')->exists($path)) {
                 Storage::disk('public')->delete($path);
             }
     
             return response()->json([
                 'success' => false,
                 'message' => 'Invalid assetable type provided. Please check the asset type and try again.',
             ], 400);
         }
     
         // Create the Asset and associate it with the assetable model
         $asset = Asset::create([
             'user_id' => Auth::id(),
             'name' => $validatedData['name'],
             'description' => $validatedData['description'] ?? null,
             'daily_rental_price' => $validatedData['daily_rental_price'],
             'is_available' => $validatedData['is_available'],
             'location' => $validatedData['location'] ?? null,
             'image_url' => $imageUrl,
             'assetable_id' => $assetable->id,
             'assetable_type' => get_class($assetable),
         ]);
     
         // Notify the user
         $user = auth()->user(); // Get the currently authenticated user
         $title = "New Asset Created";
         $message = "Your asset '{$asset->name}' of type '{$validatedData['assetable_type']}' has been successfully added.";
         $imagePath = $asset->image_url ?? asset('images/default-asset.png');
         $url = route('assets.show', $asset);
     
         $user->notify(new EventoNotification($title, $message, $imagePath, $url));
     
         // Load the assetable relationship
         $asset->load('assetable');
     
         return response()->json([
             'success' => true,
             'message' => 'Asset successfully created.',
             'data' => new AssetResource($asset),
         ], 201);
     }
     
     
    

    /**
     * Display the specified asset.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // Retrieve the asset with its associated assetable model
        $asset = Asset::with('assetable')->findOrFail($id);

        // Check if the asset belongs to the authenticated user
        if ($asset->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => new AssetResource($asset),
        ], 200);
    }

    /**
     * Update the specified asset and its related assetable entity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Retrieve the asset with its associated assetable model
        $asset = Asset::with('assetable')->findOrFail($id);

        // Check if the asset belongs to the authenticated user
        if ($asset->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.',
            ], 403);
        }

        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_available' => 'sometimes|required|boolean',
            'location' => 'nullable|string',
            'assetable_data' => 'nullable|array',
            'assetable_data.equipment_category_id' => 'sometimes|required_if:assetable_type,equipment|exists:equipment_categories,id',
            'assetable_data.furniture_category_id' => 'sometimes|required_if:assetable_type,furniture|exists:furniture_categories,id',
            'assetable_data.room_category_id' => 'sometimes|required_if:assetable_type,room|exists:room_categories,id',
            'assetable_data.transportation_category_id' => 'sometimes|required_if:assetable_type,transportation|exists:transportation_categories,id',
            'assetable_data.available_quantity' => 'sometimes|required_if:assetable_type,equipment,furniture|integer|min:1',
            'assetable_data.condition' => 'sometimes|required_if:assetable_type,equipment|in:new,good,fair,poor',
            'assetable_data.capacity' => 'sometimes|required_if:assetable_type,room,transportation|integer|min:1',
            'assetable_data.daily_rental_price' => 'sometimes|required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Start a database transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Handle image upload if provided
            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($asset->image_url) {
                    $oldImagePath = str_replace('/storage/', '', parse_url($asset->image_url, PHP_URL_PATH));
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }

                // Store the new image
                $path = $request->file('image')->store('assets/images', 'public');
                $imageUrl = Storage::url($path); // Get the URL to the stored image
                $asset->image_url = $imageUrl;
            }

            // Update the Asset model
            if (isset($validatedData['name'])) {
                $asset->name = $validatedData['name'];
            }
            if (isset($validatedData['description'])) {
                $asset->description = $validatedData['description'];
            }
            if (isset($validatedData['is_available'])) {
                $asset->is_available = $validatedData['is_available'];
            }
            if (isset($validatedData['location'])) {
                $asset->location = $validatedData['location'];
            }
            if (isset($imageUrl)) {
                $asset->image_url = $imageUrl;
            }

            $asset->save();

            // Update the assetable entity if assetable_data is provided
            if (isset($validatedData['assetable_data'])) {
                $this->updateAssetable(
                    $asset->assetable,
                    $validatedData['assetable_data']
                );
            }

            // Commit the transaction
            DB::commit();

            // Reload the asset with assetable relationship
            $asset->load('assetable');

            return response()->json([
                'success' => true,
                'data' => new AssetResource($asset),
            ], 200);
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Optionally, delete the uploaded image if asset update fails
            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return response()->json([
                'success' => false,
                'message' => 'Asset update failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified asset and its related assetable entity from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Retrieve the asset with its associated assetable model
        $asset = Asset::with('assetable')->findOrFail($id);

        // Check if the asset belongs to the authenticated user
        if ($asset->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.',
            ], 403);
        }

        // Start a database transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Delete the associated assetable model
            $assetable = $asset->assetable;

            if ($assetable) {
                $assetable->delete();
            }

            // Optionally, delete the image if exists
            if ($asset->image_url) {
                $imagePath = str_replace('/storage/', '', parse_url($asset->image_url, PHP_URL_PATH));
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }

            // Delete the Asset model
            $asset->delete();

            // Commit the transaction
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Asset deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Asset deletion failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Create an assetable entity based on the asset type.
     *
     * @param string $type
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws \Exception
     */
    private function createAssetable(string $type, array $data)
{
    switch ($type) {
        case 'equipment':
            // Ensure the equipment category and available quantity are present in $data
            if (!isset($data['equipment_category_id']) || !isset($data['available_quantity']) || !isset($data['condition'])) {
                throw new \InvalidArgumentException('Missing required fields for equipment.');
            }
            return Equipment::create([
                'equipment_category_id' => $data['equipment_category_id'],
                'available_quantity' => $data['available_quantity'],
                'condition' => $data['condition'],
            ]);

        case 'room':
            // Ensure the room category and capacity are present
            if (!isset($data['room_category_id']) || !isset($data['capacity'])) {
                throw new \InvalidArgumentException('Missing required fields for room.');
            }
            // Create the room
            $room = Room::create([
                'room_category_id' => $data['room_category_id'],
                'location' => $data['location'] ?? null, // Default to null if not provided
                'capacity' => $data['capacity'],
            ]);

            // Attach facilities if provided
            if (isset($data['facilities']) && is_array($data['facilities'])) {
                // Assuming facilities is an array of IDs or names, depending on your setup
                // If facilities are stored as names, you may want to resolve them to IDs first
                $facilityIds = Facility::whereIn('name', $data['facilities'])->pluck('id');
                $room->facilities()->sync($facilityIds);
            }

            return $room;

        case 'furniture':
            // Ensure the furniture category and available quantity are present
            if (!isset($data['furniture_category_id']) || !isset($data['available_quantity'])) {
                throw new \InvalidArgumentException('Missing required fields for furniture.');
            }
            return Furniture::create([
                'furniture_category_id' => $data['furniture_category_id'],
                'available_quantity' => $data['available_quantity'],
            ]);

        case 'transportation':
            // Ensure transportation category and capacity are provided
            if (!isset($data['transportation_category_id']) || !isset($data['capacity'])) {
                throw new \InvalidArgumentException('Missing required fields for transportation.');
            }
            return Transportation::create([
                'transportation_category_id' => $data['transportation_category_id'],
                'capacity' => $data['capacity'],
            ]);

        default:
            throw new \Exception('Invalid assetable type.');
    }
}


    /**
     * Update the assetable entity with provided details.
     *
     * @param \Illuminate\Database\Eloquent\Model $assetable
     * @param array $data
     * @return void
     * @throws \Exception
     */
    private function updateAssetable($assetable, array $data): void
    {
        switch (get_class($assetable)) {
            case Equipment::class:
                $assetable->update([
                    'equipment_category_id' => $data['equipment_category_id'] ?? $assetable->equipment_category_id,
                    'available_quantity' => $data['available_quantity'] ?? $assetable->available_quantity,
                    'condition' => $data['condition'] ?? $assetable->condition,
                ]);
                break;

            case Room::class:
                $assetable->update([
                    'room_category_id' => $data['room_category_id'] ?? $assetable->room_category_id,
                    'location' => $data['location'] ?? $assetable->location,
                    'capacity' => $data['capacity'] ?? $assetable->capacity,
                ]);
                break;

            case Furniture::class:
                $assetable->update([
                    'furniture_category_id' => $data['furniture_category_id'] ?? $assetable->furniture_category_id,
                    'available_quantity' => $data['available_quantity'] ?? $assetable->available_quantity,
                ]);
                break;

            case Transportation::class:
                $assetable->update([
                    'transportation_category_id' => $data['transportation_category_id'] ?? $assetable->transportation_category_id,
                    'capacity' => $data['capacity'] ?? $assetable->capacity,
                ]);
                break;

            default:
                throw new \Exception('Invalid assetable type.');
        }
    }
}
