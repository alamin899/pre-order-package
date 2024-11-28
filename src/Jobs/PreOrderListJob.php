<?php

namespace PreOrder\PreOrderBackend\Jobs;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use PreOrder\PreOrderBackend\Models\PreOrder;

class PreOrderListJob
{
    public function __construct(
        private  ?string $query = '',
        private  int     $perPage = 15
    )
    {
    }

    public function handle(): LengthAwarePaginator
    {
        $products = PreOrder::query()
            ->select('id','customer_name', 'customer_phone', 'customer_email', 'quantity', 'total_amount')
            ->where('status', true);

        if ($this->query) {
            $products->where('customer_name', 'like', "%{$this->query}%")
            ->orWhere('customer_email', 'like', "%{$this->query}%");
        }

        return $products->paginate($this->perPage);
    }
}