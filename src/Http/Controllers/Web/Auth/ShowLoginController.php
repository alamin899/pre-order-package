<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\Web\Auth;

use PreOrder\PreOrderBackend\Http\Controllers\Controller;

class ShowLoginController extends Controller
{
    public function __invoke()
    {
        return view('preorder::auth.login');
    }
}