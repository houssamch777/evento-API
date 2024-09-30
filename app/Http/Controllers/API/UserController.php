<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\File; // Assuming a File model for storing file info
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
class UserController extends Controller
{
    // Upload profile image API
    public function uploadProfileImage(Request $request): JsonResponse
    {
        // Validate that a file is provided and is an image
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Adjust validation rules if needed
        ]);

        // Retrieve the uploaded file
        $file = $request->file('image');
        // Generate a unique file name
        $fileName = Str::uuid()  . '.' . $file->getClientOriginalExtension();

        // Store the file in the 'profile_images' directory within the 'public' disk
        $file->storeAs('profile_images', $fileName, 'public');

        // Get the authenticated user
        $user = $request->user();

        // If the user has an existing profile picture, delete it
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Update the user's profile with the new image path
        $user->profile_picture = 'profile_images/' . $fileName;
        $user->save();

        // Return a success message with the updated image path
        return response()->json([
            'message' => 'Profile image uploaded successfully',
            
            'profile_picture_url' => asset('storage/' . $user->profile_picture),
        ]);
    }



    // Download a file by generated name (for reference)
    public function downloadProfileImage(): Response
    {
        // Get the authenticated user
        $user = Auth::guard('api')->user();

        // Check if the user has a profile picture
        if (!$user->profile_picture || !Storage::disk('public')->exists($user->profile_picture)) {
            return response()->json(['message' => 'Profile picture not found'], 404);
        }

        // Get the file path
        $filePath = storage_path('app/public/' . $user->profile_picture);

        // Download the file with the original name or a default name
        return response()->download($filePath, 'profile_image.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }

    public function storePortfolio(Request $request)
    {
        $request->validate([
            'link' => 'required|url|unique:portfolios',
        ]);

        $user = $request->user();

        

        Portfolio::create([
            'user_id' => $user->id,
            'link' => $request->link,
        ]);
        return response()->json([
            'success' => 'Portfolio link and icon added successfully.',
        ]);
    }

    



}
