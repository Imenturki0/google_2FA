<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureSingleSession
{
   
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        if ($user && $user->session_id !== $request->session()->getId()) {
            // Log the user out if the session_token doesn't match
            Auth::logout();

            // Redirect to the login page with a message
            return redirect()->route('login')->with('error', 'You have been logged out because of multiple logins.');
        }

        return $next($request);
    }
}
