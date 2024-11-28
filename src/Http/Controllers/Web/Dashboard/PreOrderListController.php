<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\Web\Dashboard;

use Illuminate\Http\Request;
use PreOrder\PreOrderBackend\Features\PreorderListFeature;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;
use PreOrder\PreOrderBackend\Jobs\PreOrderListJob;
use PreOrder\PreOrderBackend\Operations\ProductSearchValue;

class PreOrderListController extends Controller
{
    public function __invoke(Request $request)
    {
        $filters = (new ProductSearchValue($request))->format();

        $preorders = (new PreorderListFeature(
            query:  $filters['query'],
            column: $filters['column'],
            orderBy: $filters['order_by'],
        ))->handle();
        return view('preorder::dashboard.preorders',[
            'preorders' => $preorders
        ]);
    }
}