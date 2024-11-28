<?php

namespace PreOrder\PreOrderBackend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PreOrder\PreOrderBackend\Facade\CustomAuth;

class CustomGuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (CustomAuth::check()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}