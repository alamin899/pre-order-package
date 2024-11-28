<?php

namespace PreOrder\PreOrderBackend\Features;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use PreOrder\PreOrderBackend\Jobs\ProductListJob;

class ProductListFeature
{
    public function __construct(
        private  ?string $query = '',
        private  int     $perPage = 15,
    )
    {
    }

    public function handle(): LengthAwarePaginator
    {
        return (new ProductListJob(query: $this->query, perPage: $this->perPage))->handle();
    }
}