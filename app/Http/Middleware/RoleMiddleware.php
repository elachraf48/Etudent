<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to login if not authenticated
            return redirect()->route('login');
        }

        // Get the user's role
        $userRole = Auth::user()->role;

        // Check if the user's role is in the allowed roles
        if (!in_array($userRole, $roles)) {
            // Unauthorized access
            abort(403, 'Unauthorized');
        }

        // User has the required role, proceed with the request
        return $next($request);
    }
}
