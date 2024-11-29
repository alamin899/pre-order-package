<?php

namespace PreOrder\PreOrderBackend\POListener;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use PreOrder\PreOrderBackend\POEvent\SendOrderEmail;
use PreOrder\PreOrderBackend\POMail\OrderCreateCustomerMail;

class SendCustomerMail implements ShouldQueue
{
    public function handle(SendOrderEmail $event): void
    {
        Mail::to($event->order->customer_email)->send(new OrderCreateCustomerMail($event->order));
    }
}