<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function updateProfilePicture(Request $request)
{
    try {
        // Validate the base64 image input
        $request->validate([
            'image' => 'required',
        ]);

        // Extract and clean the base64 string
        $data = $request->input('image');
        $image = str_replace('data:image/png;base64,', '', $data);
        $image = str_replace(' ', '+', $image);

        // Generate a unique name for the image
        $imageName = Str::uuid() . '_' . time() . '.png';

        // Save the image to the public disk (storage/app/public)
        Storage::disk('public')->put('profile_images/' . $imageName, base64_decode($image));

        // Build the image path
        $imagePath = 'profile_images/' . $imageName;

        // Get the authenticated user
        $user = Auth::user();

        // Delete the old profile picture if exists
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Update the user's profile picture path in the database
        $user->profile_picture = $imagePath;
        $user->save();

        // Return a success response with the new profile picture URL
        return response()->json([
            'message' => 'Profile image updated successfully.',
            'profile_picture_url' => asset('storage/' . $imagePath),
        ], 200);

    } catch (\Exception $e) {
        // Return an error response if something went wrong
        return response()->json([
            'message' => 'Failed to update profile image.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


}
