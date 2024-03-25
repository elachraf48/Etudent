<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Log the roles being checked
        Log::debug('Roles being checked:', $roles);

        // Check if the user is authenticated
        if (!Auth::check()) {
            // Log the error
            Log::error('User not authenticated');

            // Redirect to login if not authenticated
            return redirect()->route('login');
        }

        // Get the user's role
        $userRole = Auth::user()->role;

        // Log the user's role
        Log::debug('User role:', ['role' => $userRole]);

        // Check if the user's role is in the allowed roles
        if (!in_array($userRole, $roles)) {
            // Unauthorized access
            Log::warning('Unauthorized access');
    
            return abort(403, 'Unauthorized');
        }
    
        // User has the required role, call the next middleware or controller action
        return $next($request);
    }
}
