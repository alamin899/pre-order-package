<?php

namespace PreOrder\PreOrderBackend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PreOrder\PreOrderBackend\Facade\CustomAuth;

class CustomAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!CustomAuth::check()) {
            return redirect()->route('auth.login')->with('error', 'Please log in first.');
        }

        return $next($request);
    }
}