<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'min:6',
            'description' => 'min:6',
            'quantity' => 'integer|min:1',
            'status' => 'in:' . Product::PRODUCT_AVAILABLE . ',' . Product::PRODUCT_NOT_AVAILABLE,
            'image' => 'image',
        ];
    }
}
