<?php

namespace PreOrder\PreOrderBackend\POEvent;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PreOrder\PreOrderBackend\Models\PreOrder;

class SendOrderEmail implements ShouldQueue
{
    use Dispatchable, SerializesModels, Queueable,InteractsWithQueue;

    public $order;

    public function __construct(PreOrder $order)
    {
        $this->order = $order;
    }
}