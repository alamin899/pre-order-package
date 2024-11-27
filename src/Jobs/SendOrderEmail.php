<?php

namespace PreOrder\PreOrderBackend\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use PreOrder\PreOrderBackend\Mail\OrderCreateAdminMail;
use PreOrder\PreOrderBackend\Mail\OrderCreateCustomerMail;
use PreOrder\PreOrderBackend\Models\PreOrder;
use PreOrder\PreOrderBackend\Models\User;

class SendOrderEmail implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $order;

    public function __construct(PreOrder $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        $admin = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->with('roles')
            ->first();

        Mail::to($admin->email ?? 'admin@example.com')->send(new OrderCreateAdminMail($this->order));

        Mail::to($this->order->customer_email)->send(new OrderCreateCustomerMail($this->order));
    }
}