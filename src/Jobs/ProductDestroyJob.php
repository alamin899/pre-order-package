<?php

namespace PreOrder\PreOrderBackend\Jobs;

use PreOrder\PreOrderBackend\Models\Product;

class ProductDestroyJob
{
    public function __construct(
        private  Product $product
    )
    {
    }

    public function handle(): ?bool
    {
        return  $this->product->delete();
    }
}