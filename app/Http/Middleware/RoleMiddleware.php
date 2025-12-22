<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        // Belum login → ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Login tapi role tidak sesuai → 403
        if (Auth::user()->role !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
