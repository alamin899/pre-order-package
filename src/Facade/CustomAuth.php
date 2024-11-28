<?php

namespace PreOrder\PreOrderBackend\Facade;

use Illuminate\Support\Facades\Facade;

class CustomAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'customauth';
    }
}