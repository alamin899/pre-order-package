<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\Web\Dashboard;

use Illuminate\Http\Request;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;
use PreOrder\PreOrderBackend\Jobs\ProductListJob;

class ProductListController extends Controller
{
    public function __invoke(Request $request)
    {
        $products = (new ProductListJob($request->input('query','')))->handle();
        return view('preorder::dashboard.products',[
            'products' => $products
        ]);
    }
}