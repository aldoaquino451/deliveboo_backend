<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required','max:50'],
            'price' => ['required', 'min:0.01', 'max:999.99'],
            'ingredients' => ['required'],
            'category_id' => ['required', 'not_in:0'],
            'is_visible' => [],
            'is_vegan' => [],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Questo campo è obbligatorio',
            'name.max' => 'Questo campo deve essere lungo massimo 50 caratteri',
            'price.required' => 'Questo campo è obbligatorio',
            'price.min' => 'Il prezzo deve essere maggiore di 0',
            'price.max' => 'Il prezzo supera il limite',
            'ingredients.required' => 'Questo campo è obbligatorio',
            'category_id' => 'La categoria è un campo obbligatorio',
        ];
    }
}
