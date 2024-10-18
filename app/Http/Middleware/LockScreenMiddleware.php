<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class LockScreenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $inactivityLimit = 36000; 
        $lastActivity = Session::get('lastActivityTime');
        $currentTime = time();

        // Check if the session is already locked
        if (Session::get('locked')) {
            return redirect()->route('lock.screen');
        }

        // Check for inactivity
        if ($lastActivity && ($currentTime - $lastActivity > $inactivityLimit)) {

            Session::put('locked', true);
            return redirect()->route('lock.screen');
        }

        // Update the last activity time
        Session::put('lastActivityTime', $currentTime);

        return $next($request);
    }
}
