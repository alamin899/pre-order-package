<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\Web\Dashboard;

use PreOrder\PreOrderBackend\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('preorder::dashboard.dashboard');
    }
}