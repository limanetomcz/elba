<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaymentPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric',
            'payment_method' => 'required|string|in:boleto,pix,credit_card',
            'buyer_document' => 'required|string|cpf',
            'product_id' => 'required|string',
        ];
    }
    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'O campo amount é obrigatório.',
            'amount.numeric' => 'O campo amount deve ser numérico.',
            'amount.min' => 'O campo amount deve ser maior que zero.',
            'payment_method.required' => 'O campo payment_method é obrigatório.',
            'payment_method.in' => 'O campo payment_method deve ser um dos seguintes valores: boleto, pix, credit_card.',
            'buyer_document.required' => 'O campo buyer_document é obrigatório.',
            'buyer_document.cpf' => 'O campo buyer_document deve conter um CPF válido.',
            'product_id.required' => 'O campo product_id é obrigatório.',
        ];
    }

}
