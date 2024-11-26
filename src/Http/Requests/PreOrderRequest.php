<?php

namespace PreOrder\PreOrderBackend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PreOrder\PreOrderBackend\Foundations\ReCaptcha\Google\Requests\GoogleReCaptchaRule;

class PreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Add your authorization logic if needed
        return true; // Assuming any user can place a pre-order
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255','email:dns,rfc'],
            'product' => ['required', 'exists:products,slug'],
            'quantity' => ['required', 'integer', 'min:1'],
            'gRecaptchaToken' => ['required', 'min:5', 'max:1000', new GoogleReCaptchaRule()],
        ];

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
            'product.exists' => 'The selected product is invalid.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('customer_phone')) {
            $phone = (string)ltrim($this->phone ?? '', '+88');
            $phone = (string)ltrim($phone, '88');
            $phone = (string)ltrim($phone, '0088');
            $phone = (string)ltrim($phone, '+0088');

            $this->merge([
                'customer_phone' => '0' . $phone
            ]);
        }
    }

}