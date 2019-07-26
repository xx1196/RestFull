<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
            'name' => 'required|min:6|max:200',
            'description' => 'required|min:6|max:200',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la categoría es requerido',
            'name.min' => 'El nombre de la categoria debe ser mínimo 6 caracteres',
            'name.max' => 'El nombre de la categoria debe ser máximo 200 caracteres',
            'description.required' => 'La descripción de la categoría es requerido',
            'description.min' => 'La descripción de la categoria debe ser mínimo 6 caracteres',
            'description.max' => 'La descripción de la categoria debe ser máximo 200 caracteres',
        ];
    }
}
