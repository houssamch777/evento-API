<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;

use App\Models\SkillName;
use App\Notifications\EventoNotification;
use Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class SkillController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    /**
     * Display a listing of all skills.
     */
    public function index()
    {
        
        return response()->json(Skill::all(), 201);
    }
    public function userSkills(){
        $userSkills = Auth::user()->skills;
        return response()->json($userSkills, 201);
    }
    public function skillsNames()
    {
        $skills = SkillName::all()->pluck('name')->toJson();
        return response()->json($skills, 201);
    }

    /**
     * Store a newly created skill in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'experience' => 'required|in:Beginner,Intermediate,Expert',
            'offer_as_service' => 'boolean',
            'portfolio_url' => 'nullable|url',
            'cost' => 'nullable|numeric|min:0',
            'cost_type' => 'nullable|in:per_hour,per_task',
            'availability' => 'nullable|array',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'name.required' => 'The name field is required.',
            'experience.required' => 'Please select your level of experience.',
            'experience.in' => 'The experience must be one of: Beginner, Intermediate, or Expert.',
            'offer_as_service.boolean' => 'The offer_as_service field must be true or false.',
            'portfolio_url.url' => 'The portfolio URL must be a valid URL.',
            'cost.numeric' => 'The cost must be a numeric value.',
            'cost_type.in' => 'The cost type must be either per_hour or per_task.',
            'start_time.required' => 'The start time is required.',
            'end_time.required' => 'The end time is required.',
            'end_time.after' => 'The end time must be after the start time.',
        ]);

        try {
            // Create the skill associated with the authenticated user
            $skill = $request->user()->skills()->create($fields);

            return response()->json([
                'message' => 'Skill created successfully.',
                'data' => $skill,
            ], 201);

        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'message' => 'Failed to create skill.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified skill.
     */
    public function show(Skill $skill)
    {
        return response()->json($skill); // Return the specified skill
    }

    /**
     * Update the specified skill in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        // Ensure the authenticated user is authorized to update the skill
        Gate::authorize('update', $skill);

        // Validate the incoming data
        $fields = $request->validate([
            'name' => 'required|max:255',
            'experience' => 'required|in:Beginner,Intermediate,Expert',
            'offer_as_service' => 'boolean',
            'portfolio_url' => 'nullable|url',
            'cost' => 'nullable|numeric',
            'cost_type' => 'nullable|in:per_hour,per_task',
            'availability' => 'nullable|array',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
        ]);

        // Update the skill with the validated data
        $skill->update($fields);

        return response()->json($skill); // Return the updated skill
    }

    /**
     * Remove the specified skill from storage.
     */
    public function destroy(Skill $skill)
    {
        // Ensure the authenticated user is authorized to delete the skill
        Gate::authorize('delete', $skill);

        // Delete the skill
        $skill->delete();
        $user = Auth::user(); // Example user

        $title = 'New Event Alert';
        $message = 'A new event has been scheduled!';
        $image = 'path/to/image.png'; // Optional



        return response()->json(['message' => 'Skill deleted successfully'], 200);
    }
}


