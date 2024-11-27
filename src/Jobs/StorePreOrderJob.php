<?php

namespace PreOrder\PreOrderBackend\Jobs;

use PreOrder\PreOrderBackend\Models\PreOrder;

class StorePreOrderJob
{
    public function __construct(private array $attributes = [])
    {
    }

    public function handle()
    {
        return PreOrder::query()->create($this->attributes);
    }
}