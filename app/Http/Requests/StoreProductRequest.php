<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|alpha',
            'price' => 'required|numeric',
            'qty' => 'required|numeric '
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.alpha' => 'El nombre solo puede incluir letras',
            'price.required' => 'Añade un precio al producto',
            'price.numeric' => 'El precio no debe incluir letras',
            'qty.required' => 'La cantidad no debe ser nula',
            'qty.numeric' => 'La cantidad no debe incluir letras',
        ];
    }
}
