<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function uploadImage(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust max size as needed
        ]);

        // Handle the uploaded file
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filePath = $file->store('uploads/images', 'public'); // Store in 'storage/app/public/uploads/images'

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully!',
                'file_path' => url('storage/' . $filePath), // URL for accessing the file
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No file uploaded.',
        ], 400);
    }
}
