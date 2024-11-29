<?php

namespace PreOrder\PreOrderBackend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PreOrder\PreOrderBackend\Facades\CustomAuth;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!CustomAuth::check()) {
            return redirect()->route('auth.login')->with('error', 'Please log in first.');
        } else {
            $user = CustomAuth::user();

            if ($user && $user->roles->contains('name', 'admin')) {
                return $next($request);
            } else {
                abort(403);
            }
        }
    }
}