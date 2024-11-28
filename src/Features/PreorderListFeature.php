<?php

namespace PreOrder\PreOrderBackend\Features;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use PreOrder\PreOrderBackend\Jobs\PreOrderListJob;
class PreorderListFeature
{
    public function __construct(
        private  ?string $query = '',
        private  ?string $column = 'id',
        private  ?string $orderBy = 'desc',
        private  int     $perPage = 15,
    )
    {
    }

    public function handle(): LengthAwarePaginator
    {
        return  (new PreOrderListJob(query: $this->query,perPage: $this->perPage,column: $this->column,orderBy: $this->orderBy))->handle();
    }
}