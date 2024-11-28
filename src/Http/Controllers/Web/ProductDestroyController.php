<?php

namespace PreOrder\PreOrderBackend\Http\Controllers\Web;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use PreOrder\PreOrderBackend\Features\ProductDestroyFeature;
use PreOrder\PreOrderBackend\Http\Controllers\Controller;
use PreOrder\PreOrderBackend\Models\Product;

class ProductDestroyController extends Controller
{
    public function __invoke(Product $product): RedirectResponse
    {
        try {
            $response = (new ProductDestroyFeature(product: $product))->handle();
            if ($response) {
                return redirect()->route('dashboard.products')->with('success', 'Product deleted successfully.');
            }
            return redirect()->route('dashboard.products')->with('error', 'Something went wrong.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('dashboard.products')->with('error', 'Product not found.');
        }
    }
}