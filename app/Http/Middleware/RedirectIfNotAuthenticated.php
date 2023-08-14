<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
   
    public function handle(Request $request, Closure $next): Response
    {

        
       if (!Auth::check()) {
            return redirect()->route('login'); // Replace 'login' with your login route name
        }

        return $next($request);
    }
}
