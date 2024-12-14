<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    //
    /**
     * Show the edit profile form.
     */
    public function edit()
    {
        $user = auth()->user();
        $social_links = json_decode(auth()->user()->social_links);
        $icons = [
            'telegram' => 'fab fa-telegram-plane',
            'behance' => 'fab fa-behance',
            'linkedin' => 'fab fa-linkedin-in',
            'github' => 'fab fa-github',
            'twitter' => 'fab fa-twitter',
        ];
        $locationNames = Location::pluck('name');
        return view('user.edit', compact('user','icons','locationNames', 'social_links'));
    }

    /**
     * Update profile information.
     */
    public function update(Request $request)
    {
        
        //dd($request->input());
        // Validate the input fields
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'date_of_birth' => 'nullable|integer|min:1940|max:' . date('Y'),
                'gender' => 'nullable|in:male,female',
                'bio' => 'nullable|string|max:255',
            ]);


        // Get the authenticated user
        $user = auth()->user();
        // Update user data
            // Log user data before updating
            //dd('User Before Update', $user, 'Request Data', $request->all());

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
            $user->date_of_birth = $request->input('date_of_birth');
            $user->gender = $request->input('gender');
            $user->bio = $request->input('bio');
            $user->save();


            //dd('User Updated', $user);


        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function updateContact(Request $request)
    {

        //dd($request->input());
        // Validate the input fields
        $validatedData = $request->validate([
            'phone_number' => [
                'required',
                'string',
                'max:15',
                Rule::unique('users')->ignore(auth()->id()) // Ignore current user's phone number in validation
            ],
            'location' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->id()) // Ignore current user's email in validation
            ],
        ]);


        // Get the authenticated user
        $user = auth()->user();
        // Update user data
        // Log user data before updating
        //dd('User Before Update', $user, 'Request Data', $request->all());

        $user->phone_number = $request->input('phone_number');
        $user->location = $request->input('location');
        $user->email = $request->input('email') ;
        $user->save();


        //dd('User Updated', $user);


        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
    public function updateLinks(Request $request)
    {
        // Validate the input (ensure they are valid URLs where applicable)
        $validatedData = $request->validate([
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'behance' => 'nullable|url',
            'youtube' => 'nullable|url',
            'github' => 'nullable|url',
            'job' => 'nullable|string|max:255',  // Job is a string
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Decode the current social_links if it exists (convert the JSON string into an array)
        $socialLinks = json_decode($user->social_links, true) ?? [];

        // Remove the 'job' field from the validated data to ensure it's not included in the social_links array
        $validatedDataWithoutJob = Arr::except($validatedData, ['job']);

        // Merge the new validated social links into the existing social_links array
        $mergedSocialLinks = array_merge($socialLinks, $validatedDataWithoutJob);

        // Encode the array back to JSON before saving
        $user->social_links = json_encode($mergedSocialLinks);

        // Save the 'job' field separately (not in social_links)
        $user->job = $validatedData['job'] ?? $user->job;

        // Save the user
        $user->save();

        // Redirect with a success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
    /**
     * Change the user's password.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', Password::defaults()],
            'confirm_new_password' => 'required|same:new_password',
        ]);

        $user = auth()->user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('profile.edit')->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile')->with('success', 'Password changed successfully.');
    }

}
