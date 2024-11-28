<?php

namespace PreOrder\PreOrderBackend\Listener;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use PreOrder\PreOrderBackend\Events\SendOrderEmail;
use PreOrder\PreOrderBackend\Mail\OrderCreateCustomerMail;

class SendCustomerMail implements ShouldQueue
{
    public function handle(SendOrderEmail $event): void
    {
        Mail::to($event->order->customer_email)->send(new OrderCreateCustomerMail($event->order));
    }

}