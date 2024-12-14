<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// app/Http/Controllers/NotificationController.php
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function markAllAsRead()
{
    Auth::user()->unreadNotifications->markAsRead();
    return redirect()->back();
}
    public function index()
    {
        $notifications=Auth::user()->notifications;
        //dd($notifications);
        return view('notification.index',compact('notifications'));
    }
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back()->with('success', 'Notification marked as read.');
    }



    public function updateStatus(Request $request, $notificationId)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:accepted,rejected,pending',
        ]);

        // Find the notification
        $notification = DatabaseNotification::findOrFail($notificationId);

        // Decode the current data
        $data = $notification->data;

        // Update the status
        $data['status'] = $request->status;

        // Save the updated data
        $notification->data = $data;
        $notification->save();

        return response()->json([
            'success' => true,
            'message' => 'Notification status updated successfully.',
        ]);
    }

}
