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

    public static function middleware(){
        return [
            new Middleware('auth:sanctum',except:['index','show'])
        ];
    }
    
        /**
         * Display a listing of all skills.
         */
        public function index()
        {
            return Skill::all();
        }
        public function skillsNames()
        {
            return SkillName::all();
        }
    
        /**
         * Store a newly created skill in storage.
         */
        public function store(Request $request)
        {
            // Validate the request data
            $fields = $request->validate([
                'name' => 'required|max:255',
                'experience' => 'required|in:Beginner,Intermediate,Expert',
                'offer_as_service' => 'boolean',
                'portfolio_url' => 'nullable|url',
                'cost' => 'nullable|numeric',
                'cost_type' => 'nullable|in:per_hour,per_task',
                'availability' => 'nullable|array',
            ]);
    
            // Create the skill associated with the authenticated user
            $skill = $request->user()->skills()->create($fields);
    
            return response()->json($skill, 201); // Return the created skill with 201 status code
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
    

