<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    public function login(Request $request)
{

    $fields=$request->validate([
        'email'=>'required|email|exists:users,email',
        'password'=>'required',
    ]);
    if (Auth::attempt($fields,$request->rememberCheck)) {
        return redirect()->intended();
        
    } else {
        return back()->withErrors(['fialed' => 'The provided password is incorrect!']);
    }
}

public function register(Request $request)
{
    
    $fields=$request->validate([
            
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15|unique:users',
            'location' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:Y',
            'gender' => 'required|in:male,female',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
        ]);
    $user=User::create($fields);
    Auth::login($user);
    return redirect()->intended();
}

    // نموذج لتسجيل الخروج
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('logout');
    }


    public function profile_image_upload(Request $request) {
        // Validate the cropped image
        $request->validate([
            'cropped_image' => 'required',
        ]);
    
        $data = $request->input('cropped_image');
    
        // Decode the base64 string
        $image = str_replace('data:image/png;base64,', '', $data);
        $image = str_replace(' ', '+', $image);
    
        // Generate a unique name for the image (UUID + timestamp)
        $imageName = Str::uuid() . '_' . time() . '.png';
    
        // Save the image to storage (using public disk, or any other configured disk)
        Storage::disk('public')->put('profile_images/' . $imageName, base64_decode($image));
    
        // Build the full image path
        $imagePath = 'profile_images/' . $imageName;
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Check if the user already has a profile picture
        if ($user->profile_picture) {
            // Delete the old profile picture from storage
            if (Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
        }
    
        // Update the profile picture path in the user's profile
        $user->profile_picture = $imagePath;
        $user->save();  // Save the updated user with the new profile picture path
    
        return back()->with('success', 'Profile image updated successfully.');
    }

    public function add_Portfolios(Request $request) {
        $fields=$request->validate([
            'link' => 'required|url|unique:portfolios',
        ]);
         // Get the authenticated user and their token
        $user = Auth::user();
        $token = $user->createToken('portfolio-token')->plainTextToken;
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => 'Bearer ' . $token,
    
        ];
        $response = Http::withHeaders($headers)->post('https://evento.witslinks.com/api/store_Portfolio', [
            // حقول التسجيل
            'link' => $request->input('link'),
        ]);
        
        if ($response->successful()) {
            return back()->with('success', 'Portfolio link updated successfully.');
        } else {
    
            return back()->withErrors(['error' => $response->json()['message']]);
        }
    

    }
    public function destroy_Portfolio_web($id)
{
    $user = Auth::user();
    $token = $user->createToken('portfolio-token')->plainTextToken;
        $headers = [
            'Accept' => 'application/json', 
            'Authorization' => 'Bearer ' . $token,
        ];
        $url='https://evento.witslinks.com/api/delete_Portfolio/'.$id;
        $response = Http::withToken($token)->delete($url);
        
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Portfolio link deleted successfully.');
        } else {
    
            return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this portfolio link.']);
        }
    
}

    

}
