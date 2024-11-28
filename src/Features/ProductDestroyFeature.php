<?php

namespace PreOrder\PreOrderBackend\Features;

use PreOrder\PreOrderBackend\Jobs\ProductDestroyJob;
use PreOrder\PreOrderBackend\Models\Product;
class ProductDestroyFeature
{
    public function __construct(
        private  Product $product,
    )
    {
    }

    public function handle(): bool|null
    {
        return (new ProductDestroyJob(product: $this->product))->handle();
    }
}