<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            if (!auth()->user()->roles->contains('name', 'admin')) {
                // Redirect them away from admin area
                return redirect('/'); // Change this to your desired redirect route
            }
        }
        return $next($request);
    }
}
