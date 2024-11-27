<?php

namespace PreOrder\PreOrderBackend\Jobs\API;

use PreOrder\PreOrderBackend\Models\Product;

class GetProductBySlugJob
{
    public function __construct(
        private string|array $slug = '',
    )
    {
    }

    public function handle()
    {
        $query = Product::query()
            ->select('id','name', 'slug', 'description', 'price', 'status')
            ->where('status', true);

        if (is_array($this->slug)) {
            return $query->whereIn('slug', $this->slug)->get();
        }
        return $query->where('slug', $this->slug)->first();
    }
}