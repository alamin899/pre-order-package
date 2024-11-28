<?php

namespace PreOrder\PreOrderBackend\Jobs;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use PreOrder\PreOrderBackend\Models\Product;

class ProductListJob
{
    public function __construct(
        private ?string $query = '',
        private int     $perPage = 15,
        private string  $column = 'id',
        private string  $orderBy = 'desc',
    )
    {
    }

    public function handle(): LengthAwarePaginator
    {
        $columns = ['id','name', 'slug', 'description', 'price', 'status'];
        $column = in_array($this->column, $columns) ? $this->column : 'id';

        $products = Product::query()
            ->select($columns)
            ->where('status', true);

        if ($this->query) {
            $products->where('name', 'like', "%{$this->query}%")
                ->orWhere('slug', 'like', "%{$this->query}%");
        }

        $products->orderBy($column, $this->orderBy);

        return $products->paginate($this->perPage);
    }
}