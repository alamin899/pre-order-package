<?php

namespace PreOrder\PreOrderBackend\Foundations\ReCaptcha\Google;

use Illuminate\Support\Facades\Http;

class GoogleReCaptchaTransport
{
    public static function handle($gRecaptchaToken = ''): array
    {
        $recaptcha = config('recaptcha.google');
        return Http::withHeaders(['Content-Type' => 'application/x-www-form-urlencoded'])->asForm()
            ->post($recaptcha['token_verify_url'], [
                "secret" => $recaptcha['api_secret_key'],
                "response" => $gRecaptchaToken,
            ])->json();
    }
}