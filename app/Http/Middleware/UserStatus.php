<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            $user = Auth::user();
            //$user->update(['active_status' => true]);

            // Schedule the user to go offline after a timeout (e.g., using Redis, cache, or database directly)
            $expiresAt = now()->addMinutes(5);
            cache()->put('user-is-online-' . $user->id, true, $expiresAt);
        }

        return $next($request);
    }
}
