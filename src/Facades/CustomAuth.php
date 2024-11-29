<?php

namespace PreOrder\PreOrderBackend\Facades;

use Illuminate\Support\Facades\Facade;

class CustomAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'customauth';
    }
}