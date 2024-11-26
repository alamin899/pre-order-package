<?php

namespace PreOrder\PreOrderBackend\Foundations\ReCaptcha\Google\Requests;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use PreOrder\PreOrderBackend\Foundations\ReCaptcha\Google\GoogleReCaptcha;
use PreOrder\PreOrderBackend\Foundations\ReCaptcha\ReCaptchaContractor;

class GoogleReCaptchaRule implements ValidationRule
{

    public function __construct(private ?ReCaptchaContractor $reCaptcha = null)
    {
        $this->reCaptcha = new GoogleReCaptcha();
    }
    /**
     * Validate the reCAPTCHA score and success.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $response = $this->reCaptcha->verify($value);

        if (!isset($response['success']) || !$response['success']) {
            $fail('The :attribute validation failed due to reCAPTCHA verification.');
            return;
        }

        if (!isset($response['score']) || $response['score'] < 0.2) {
            $fail('The google recaptcha score must be at least 0.2. You received :score.', [
                'score' => $response['score'] ?? 0.0
            ]);
            return;
        }
        $this->score = $response['score'];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The reCAPTCHA verification failed. Minimum score required: 0.2.';
    }
}