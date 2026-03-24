<?php

// edited by Sofia Gallo

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|integer|min:0',
            'date' => 'required|date',
            'method' => 'required|in:pse,credit_card,debit_card,nequi,daviplata',
            'confirm_payment' => 'required|accepted',
        ];
    }
}
