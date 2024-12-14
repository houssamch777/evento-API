<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Task;
use App\Notifications\EventoNotification;
use Illuminate\Http\Request;

class UserTasksController extends Controller
{
    //
    public function index(){
        return view('user.task.index');
    }
    public function create($eventId)
    {
        // Fetch event and associated team members
        $event = Event::findOrFail($eventId);
        $teamMembers = $event->teams()->with('users')->get()->pluck('users')->flatten();

        return view('admin.tasks.create', compact('event', 'teamMembers'));
    }

    public function store(Request $request, $eventId)
    {
        //dd($request->input(),$eventId);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'assigned_users' => 'required|array',
            'assigned_users.*' => 'exists:users,id',
        ]);
        //dd($request->input(), $eventId);
        $task = Task::create([
            'event_id' => $eventId,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'category' => "Waiting",
        ]);

        // Attach users to the task
        $task->users()->attach($request->assigned_users);
        // Notify each assigned user
        $title = "New Task Assigned: " . $task->title;
        $message = "You have been assigned a new task for the event.";
        $imagePath = null; // Set to an appropriate image path if needed
        $url = route('task.index'); // Example task details route

        foreach ($task->users as $user) {
            $user->notify(new EventoNotification($title, $message, $imagePath, $url));
        }
        //dd($request->input(), $eventId, $task);
        return redirect()->route('events-panel', $eventId)->with('success', 'Task created and assigned successfully.');
    }
    // TaskController.php
    public function updateCategory(Request $request, Task $task)
    {
        $validated = $request->validate([
            'category' => 'required|string',
        ]);

        $task->update(['category' => $validated['category']]);

        return response()->json(['message' => 'Task category updated successfully.']);
    }
}
