<?php

namespace PreOrder\PreOrderBackend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('auth_user')) {
            return redirect()->route('auth.login')->with('error', 'Please log in first.');
        }

        return $next($request);
    }
}