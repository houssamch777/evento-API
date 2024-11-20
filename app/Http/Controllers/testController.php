<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Auth;
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
       // dd($fileResource);
        // API endpoint URL
        $apiUrl = 'https://evento.witslinks.com/api/upload-image';

        // Send the POST request with the image
        $assetData = [
            "name" => "jb hotel conference room",
            "location" => "Biskra",
            "description" => "Spacious conference room equipped with a projector and sound system.",
            "daily_rental_price" => "50000",
            "assetable_type" => "room",
            "is_available" => true,
            "available_quantity" => "", // Flattened value from assetable_data
            "condition" => "",
            "facilities" => json_encode([  // Convert array to JSON string
                "Projector",
                "Wi-Fi",
                "Audio System"
            ]),
            "capacity" => "200",
            "room_category_id" => "1",
        ];
        dd($assetData);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer your_api_token',
        ])->attach(
                'image',
                $fileResource,
                $image->getClientOriginalName()
            )->post($apiUrl, $assetData );
        // Close the file resource
        dd($response->json());
        fclose($fileResource);

        // Handle response
        if ($response->successful()) {
            return back()->with('success', 'Image uploaded successfully to the API!');
        }

        return back()->with('error', 'Failed to upload the image to the API: ' . $response->body());
    }
   
public function store(Request $request)
    {
        // Organize the form data into the structure needed by the API
        $assetData = [
            "name" => "jb hotel conferance room",
            "location" => "Biskra",
            "description" => "Spacious conference room equipped with a projector and sound system.",
            "daily_rental_price" => "50000",
            "assetable_type" => "room",
            "is_available" => true,
            "assetable_data" => [
                "available_quantity" => "",
                "condition" => "",
                "facilities" => [
                    0 => "Projector",
                    1 => "Wi-Fi",
                    2 => "Audio System",
                ],
                "capacity" => "200",
                "room_category_id" => "1",
            ]
        ];

        //dd($assetData);
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
        $apiUrl = 'https://evento.witslinks.com/api/upload-image';

        // Send the POST request with the image and other asset data
        $response = Http::withHeaders($headers)
            ->attach(
                'image',                // Field name expected by the API
                $fileResource,          // File resource
                $image->getClientOriginalName() // File name
            )
            ->post($apiUrl, $assetData);  // Send the asset data
        dd($response->json());
        // Close the file resource
        fclose($fileResource);

        // Handle response
        if ($response->successful()) {
            return back()->with('success', 'Image uploaded successfully to the API!');
        }

        return back()->with('error', 'Failed to upload the image to the API: ' . $response->body());
    }
    public function getEventCategory()
    {

        $event = Event::find(2); // Replace with a valid event ID
        $categories = $event->categories->pluck('name')->toArray();
        dd($categories);
    }
}
