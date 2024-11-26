<?php

namespace PreOrder\PreOrderBackend\Foundations\ReCaptcha\Google;

use PreOrder\PreOrderBackend\Foundations\ReCaptcha\ReCaptchaContractor;

class GoogleReCaptcha implements ReCaptchaContractor
{
    public function verify($token): array
    {
        return GoogleReCaptchaTransport::handle(gRecaptchaToken: $token);
    }
}