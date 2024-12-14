<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Event;
use App\Models\TeamRequest;
use App\Models\User;
use App\Notifications\TeamRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

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
    public function sendTeamRequest(Request $request)
    {
        //dd($request->input());
        $validated = $request->validate([
            'team_id' => 'required|exists:teams,id',
            'email' => 'required|email|exists:users,email',
            'role' => 'required|in:Member,Admin',
        ]);

        // Find the user by email
        $user = User::where('email', $validated['email'])->firstOrFail();
        //dd($user);
        // Check if the user is already in the team
        $team = Team::findOrFail($validated['team_id']);
        
        if ($team->members()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'This user is already a team member.');
        }

        // Create the team request
        $teamRequest = TeamRequest::create([
            'team_id' => $team->id,
            'user_id' => $user->id, // The user receiving the request
            'role' =>$validated['role'],
            'status' => 'pending',
        ]);
        $user->notify(new TeamRequestNotification($teamRequest));
        return redirect()->back()->with('success', 'Request sent successfully!');
    }
    public function acceptRequest(Request $request,$id)
    {
        $notification = DatabaseNotification::findOrFail($request->notification_id);

        // Update the notification status
        $data = $notification->data;
        $data['status'] = 'accepted';
        $notification->data = $data;
        $notification->markAsRead();
        $notification->save();
        $teamRequest = TeamRequest::findOrFail($id);
        //dd($teamRequest);
        // Ensure the authenticated user is the recipient
        if (auth()->id() !== $teamRequest->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to accept this request.');
        }

        // Check if already accepted
        if ($teamRequest->isAccepted()) {
            return redirect()->back()->with('info', 'This request has already been accepted.');
        }

        // Accept the request
        $teamRequest->accept();

        // Add the user to the team
        $teamRequest->team->members()->attach($teamRequest->user_id,[
            'role' => $teamRequest->role ?? 'Member',
        ]);

        return redirect()->back()->with('success', 'You have successfully joined the team.');
    }
    public function rejectRequest(Request $request,$id)
    {
        $teamRequest = TeamRequest::findOrFail($id);
        $notification = DatabaseNotification::findOrFail($request->notification_id);

        // Update the notification status
        $data = $notification->data;
        $data['status'] = 'rejected';
        $notification->data = $data;
        $notification->markAsRead();
        $notification->save();
        $teamRequest = TeamRequest::findOrFail($id);

        // Ensure the authenticated user is the recipient
        if (auth()->id() !== $teamRequest->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to reject this request.');
        }

        // Check if already rejected
        if ($teamRequest->isRejected()) {
            return redirect()->back()->with('info', 'This request has already been rejected.');
        }

        // Reject the request
        $teamRequest->reject();

        return redirect()->back()->with('success', 'You have successfully rejected the team request.');
    }

    




}
