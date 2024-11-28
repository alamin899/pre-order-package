<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\Web\Dashboard;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use PreOrder\PreOrderBackend\Features\ProductListFeature;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;
use PreOrder\PreOrderBackend\Operations\ProductSearchValue;

class ProductListController extends Controller
{
    public function __invoke(Request $request): View|Factory|Application
    {
        $filters = (new ProductSearchValue($request))->format();

        $products = (new ProductListFeature(
            query:  $filters['query'],
            column: $filters['column'],
            orderBy: $filters['order_by'],
        ))->handle();
        return view('preorder::dashboard.products',[
            'products' => $products
        ]);
    }
}