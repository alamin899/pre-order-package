<?php

namespace PreOrder\PreOrderBackend\Facades\Services;

use Illuminate\Support\Facades\Session;

class AuthService
{
    public function check(): bool
    {
        return Session::has('auth_user');
    }

    /**
     * Get the 'auth_user' from the session.
     *
     * @return mixed
     */
    public function user(): mixed
    {
        return $this->check() ? Session::get('auth_user'):null;
    }

    public function id(): int|string
    {
        return ($this->user()) ? $this->user()->id:'';
    }
}