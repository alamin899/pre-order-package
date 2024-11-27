<?php

namespace PreOrder\PreOrderBackend\Foundations\ReCaptcha;

interface ReCaptchaContractor
{
    public function verify($token): array;
}