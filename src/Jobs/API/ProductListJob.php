<?php

namespace PreOrder\PreOrderBackend\Jobs\API;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use PreOrder\PreOrderBackend\Models\Product;

class ProductListJob
{
    public function __construct(
        private  ?string $query = '',
        private  int     $perPage = 15
    )
    {
    }

    public function handle(): LengthAwarePaginator
    {
        $products = Product::query()
            ->select('name','slug','description','price','status')
            ->where('status', true);

        if ($this->query) {
            $products->where('name', 'like', "%{$this->query}%")
            ->orWhere('slug', 'like', "%{$this->query}%");
        }

        return $products->paginate($this->perPage);
    }
}