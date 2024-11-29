<?php

namespace PreOrder\PreOrderBackend\POEvent;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use PreOrder\PreOrderBackend\Models\PreOrder;

class SendOrderEmail
{
    use SerializesModels,Dispatchable;

    public $order;

    public function __construct(PreOrder $order)
    {
        $this->order = $order;
    }
}