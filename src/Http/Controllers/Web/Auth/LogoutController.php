<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->session()->forget('auth_user');

        return redirect()->route('auth.login')->with('success', 'Logged out successfully!');
    }
}