<?php

namespace PreOrder\PreOrderBackend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomGuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('auth_user')) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}