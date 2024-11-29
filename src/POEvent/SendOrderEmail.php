<?php

namespace PreOrder\PreOrderBackend\POEvent;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use PreOrder\PreOrderBackend\Models\PreOrder;

class SendOrderEmail
{
    use Dispatchable, SerializesModels;

    public $order;

    public function __construct(PreOrder $order)
    {
        $this->order = $order;
    }
}