<?php

namespace PreOrder\PreOrderBackend\Features;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use PreOrder\PreOrderBackend\Jobs\PreOrderListJob;
use PreOrder\PreOrderBackend\Jobs\ProductListJob;

class PreorderListFeature
{
    public function __construct(
        private  ?string $query = '',
        private  int     $perPage = 15,
    )
    {
    }

    public function handle(): LengthAwarePaginator
    {
        return  (new PreOrderListJob(query: $this->query,perPage: $this->perPage))->handle();
    }
}