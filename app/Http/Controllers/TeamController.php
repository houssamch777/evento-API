<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Event;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //
    public function store(Request $request, Event $event)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'members' => 'required|array', // Members should be an array of user IDs
            'members.*' => 'exists:users,id', // Each member must exist in the users table
        ]);

        // Create the team
        $team = Team::create([
            'event_id' => $event->id,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        // Attach members to the team
        $team->members()->sync($validated['members']);

        return redirect()->route('events.show', $event->id)
            ->with('success', 'Team created and members assigned successfully.');
    }
    
}
