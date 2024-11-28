<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\Web\Auth;

use Illuminate\Support\Facades\Hash;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;
use PreOrder\PreOrderBackend\Http\Requests\LoginRequest;
use PreOrder\PreOrderBackend\Models\User;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $user = User::query()->where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['auth_user' => $user]);

            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
}