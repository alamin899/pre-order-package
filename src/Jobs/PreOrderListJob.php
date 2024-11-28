<?php

namespace PreOrder\PreOrderBackend\Jobs;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use PreOrder\PreOrderBackend\Models\PreOrder;

class PreOrderListJob
{
    public function __construct(
        private  ?string $query = '',
        private  int     $perPage = 15,
        private  string     $column = 'id',
        private  string     $orderBy = 'desc',
    )
    {
    }

    public function handle(): LengthAwarePaginator
    {
        $preOrders = PreOrder::query()
            ->select('id','customer_name', 'customer_phone', 'customer_email', 'quantity', 'total_amount','created_at')
            ->where('status', true);

        if ($this->query) {
            $preOrders->where('customer_name', 'like', "%{$this->query}%")
            ->orWhere('customer_email', 'like', "%{$this->query}%");
        }

        $preOrders->orderBy($this->column, $this->orderBy);

        return $preOrders->paginate($this->perPage);
    }
}