<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\Web\Dashboard;

use Illuminate\Http\Request;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;
use PreOrder\PreOrderBackend\Jobs\PreOrderListJob;

class PreOrderListController extends Controller
{
    public function __invoke(Request $request)
    {
        $preorders = (new PreOrderListJob($request->input('query','')))->handle();
        return view('preorder::dashboard.preorders',[
            'preorders' => $preorders
        ]);
    }
}