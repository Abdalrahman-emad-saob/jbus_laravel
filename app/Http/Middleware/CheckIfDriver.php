<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfDriver
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the authenticated user
        $user = auth()->user();

        // Check if the user's role is not equal to User::$driver
        if ($user && $user->role == User::$driver) {
            return $next($request);
        }

        // Return a JSON response with an error message and appropriate status code
        return response()->json(['error' => 'Access denied.'], 403);
    }
}
