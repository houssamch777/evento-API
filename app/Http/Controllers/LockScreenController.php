<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LockScreenController extends Controller
{
    //
    public function show()
{
    // Check if the session is locked, if not redirect to index
    if (!Session::get('locked')) {
        
        return redirect()->intended();
    }

    return view('auth.lock-screen');
}

    public function unlock(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);
    
        $password = $request->input('password');
        if (Hash::check($password, Auth::user()->password)) {
            $request->session()->forget('locked');
            return redirect()->intended();
        }

        return back()->withErrors(['password' => 'Incorrect password']);
    }
    public function manualLock()
{
    Session::put('locked', true);
    return redirect()->route('lock.screen');
}
}
