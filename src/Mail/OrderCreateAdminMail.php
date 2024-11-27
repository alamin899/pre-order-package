<?php

namespace PreOrder\PreOrderBackend\Mail;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PreOrder\PreOrderBackend\Models\PreOrder;
use PreOrder\PreOrderBackend\Models\User;

class OrderCreateAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(PreOrder $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $orderId = $this->order->id;
        $orderTotal = $this->order->total_amount;

        return $this->subject('New Order Created')
            ->html("
                        <h1>New Order Alert</h1>
                        <p>A new order has been placed.</p>
                        <p><strong>Order ID:</strong> {$orderId}</p>
                        <p><strong>Total:</strong> {$orderTotal}</p>
                        <p>Kindly check the admin panel for more details.</p>
                    ");
    }
}