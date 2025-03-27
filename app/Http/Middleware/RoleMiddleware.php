<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
{
    // Cek apakah user sudah login
    if (!Auth::check()) {
        abort(403, 'User not authenticated.');
    }

    // Cek apakah role sesuai
    if (Auth::user()->role !== $role) {
        abort(403, 'Unauthorized.');
    }

    return $next($request);
}


}
