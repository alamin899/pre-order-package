<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\Web\Dashboard;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use PreOrder\PreOrderBackend\Features\ProductListFeature;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;

class ProductListController extends Controller
{
    public function __invoke(Request $request): View|Factory|Application
    {
        $products = (new ProductListFeature($request->input('query','')))->handle();
        return view('preorder::dashboard.products',[
            'products' => $products
        ]);
    }
}