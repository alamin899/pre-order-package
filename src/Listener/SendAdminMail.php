<?php

namespace PreOrder\PreOrderBackend\Listener;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use PreOrder\PreOrderBackend\Events\SendOrderEmail;
use PreOrder\PreOrderBackend\Mail\OrderCreateAdminMail;
use PreOrder\PreOrderBackend\Models\User;

class SendAdminMail implements ShouldQueue
{
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