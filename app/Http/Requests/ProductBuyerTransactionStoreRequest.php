<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductBuyerTransactionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'quantity.required' => 'El campo cantidad es requerido',
            'quantity.integer' => 'El campo cantidad debe ser una cantidad entera',
            'quantity.min' => 'El campo cantidad debe ser mínimo 1',
        ];
    }
}
