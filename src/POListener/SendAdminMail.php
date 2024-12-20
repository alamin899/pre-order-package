<?php

namespace PreOrder\PreOrderBackend\POListener;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use PreOrder\PreOrderBackend\POEvent\SendOrderEmail;
use PreOrder\PreOrderBackend\POMail\OrderCreateAdminMail;
use PreOrder\PreOrderBackend\Models\User;

class SendAdminMail implements ShouldQueue
{
    use Queueable;
    public function handle(SendOrderEmail $event): void
    {
        $admin = User::query()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->with('roles')
            ->first();

        Mail::to($admin->email ?? 'admin@example.com')->send(new OrderCreateAdminMail($event->order));
    }
}