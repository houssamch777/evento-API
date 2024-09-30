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
    
    private function getFontAwesomeIconForLink($link)
    {
        $icons = [
            'facebook.com' => 'fab fa-facebook',
            'twitter.com' => 'fab fa-twitter',
            'instagram.com' => 'fab fa-instagram',
            'linkedin.com' => 'fab fa-linkedin',
            'github.com' => 'fab fa-github',
        ];

        foreach ($icons as $domain => $iconClass) {
            if (strpos($link, $domain) !== false) {
                return $iconClass;
            }
        }
      
        return 'fas fa-link'; // Default icon
    }

    

}
