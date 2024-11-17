<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class testController extends Controller
{
    //
    public function sendImage(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get the uploaded file
        $image = $request->file('image');

        // Open the file as a resource
        $fileResource = fopen($image->getPathname(), 'r');
        
        // API endpoint URL
        $apiUrl = 'https://evento.witslinks.com/api/upload-image';

        // Send the POST request with the image
        $response = Http::attach(
            'image',                // Field name expected by the API
            $fileResource,          // File resource
            $image->getClientOriginalName() // File name
        )->post($apiUrl);
        // Close the file resource
        dd($response->json());
        fclose($fileResource);

        // Handle response
        if ($response->successful()) {
            return back()->with('success', 'Image uploaded successfully to the API!');
        }

        return back()->with('error', 'Failed to upload the image to the API: ' . $response->body());
    }

}
