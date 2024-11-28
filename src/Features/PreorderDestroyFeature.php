<?php

namespace PreOrder\PreOrderBackend\Features;

use PreOrder\PreOrderBackend\Jobs\PreorderDestroyJob;
class PreorderDestroyFeature
{
    public function __construct(
        private  int|string $id,
    )
    {
    }

    public function handle(): bool|null
    {
        return (new PreorderDestroyJob(id: $this->id))->handle();
    }
}