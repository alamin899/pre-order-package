<?php

namespace PreOrder\PreOrderBackend\Jobs;

use PreOrder\PreOrderBackend\Models\PreOrder;

class PreorderDestroyJob
{
    public function __construct(
        private  int|string $id
    )
    {
    }

    public function handle(): ?bool
    {
        $preOrder = PreOrder::query()->with('preOrderProducts')->find($this->id);
        if (!$preOrder){
            return false;
        }

        /** every order product individually delete for deleted by field filled */
        $preOrder->preOrderProducts()->each(function ($orderProduct) {
            $orderProduct->delete();
        });

        return  $preOrder->delete();
    }
}