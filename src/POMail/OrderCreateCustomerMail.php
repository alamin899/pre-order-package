<?php

namespace PreOrder\PreOrderBackend\POMail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PreOrder\PreOrderBackend\Models\PreOrder;

class OrderCreateCustomerMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(PreOrder $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $userName = $this->order->customer_name;
        $orderId = $this->order->id;
        $orderTotal = $this->order->total_amount;

        return $this->subject('Your Order Confirmation')
            ->html("
                        <h1>Order Confirmation</h1>
                        <p>Thank you for your order, {$userName}!</p>
                        <p><strong>Order ID:</strong> {$orderId}</p>
                        <p><strong>Total:</strong> {$orderTotal}</p>
                        <p>We appreciate your business.</p>
                    ");
    }
}