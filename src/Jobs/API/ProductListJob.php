<?php

namespace PreOrder\PreOrderBackend\Jobs\API;

class ProductListJob
{
    public function __construct(private int $perPage = 10)
    {
    }

    public function handle()
    {
        return [
            'id'=>1,
            "name" => "product name",
            "price" => 200,
        ];
//        return Product::query()->paginate($this->perPage);
    }
}