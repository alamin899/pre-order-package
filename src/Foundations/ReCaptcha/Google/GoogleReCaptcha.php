<?php

namespace PreOrder\PreOrderBackend\Foundations\ReCaptcha\Google;

use PreOrder\PreOrderBackend\Foundations\ReCaptcha\ReCaptchaContractor;

class GoogleReCaptcha implements ReCaptchaContractor
{
    public function verify($token): array
    {
        $recaptcha = config('setting.google');
        if ($recaptcha['bypass_captcha']) {
            return [
                'success' => true,
                'score' => 100,
            ];
        }
        return GoogleReCaptchaTransport::handle(gRecaptchaToken: $token);
    }
}