<?php

namespace PreOrder\PreOrderBackend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PreOrder\PreOrderBackend\Foundations\ReCaptcha\Google\Requests\GoogleReCaptchaRule;

class PreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'products' => ['required', 'array', 'min:1'],
            'products.*.slug' => ['required', 'exists:po_products,slug'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
        ];

        $recaptcha = config('setting.google');
        if (!$recaptcha['bypass_captcha']) {
            $rules['gRecaptchaToken'] = ['required', new GoogleReCaptchaRule()];
        }
        if ($this->filled('customer_email') && str_ends_with($this->input('customer_email'), '@xyz.com')) {
            $rules['customer_phone'] = ['required', 'max:16', 'min:11', 'regex:/^(\+88|88|0088|\+0088)?(01[3-9]\d{8})$/'];
        }

        return $rules;
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'customer_phone.required' => 'A phone number is required if your email ends with @xyz.com.',
            'products.*.slug.required' => 'A product slug is required.',
            'products.*.slug.exists' => 'The selected product is invalid.',
            'products.*.quantity.required' => 'A quantity is required for each product.',
            'products.*.quantity.min' => 'Each product must have a quantity of at least 1.',
        ];
    }
}
