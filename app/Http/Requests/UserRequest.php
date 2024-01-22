<?php

namespace App\Http\Requests;

use App\Models\Restaurant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\User;

class UserRequest extends FormRequest
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
      'name' => ['required', 'max:50'],
      'lastname' => ['required', 'string', 'max:50'],
      'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
      'password' => ['required', 'confirmed', Rules\Password::defaults()],
      'name_restaurant' => ['required', 'string', 'max:50'],
      'address' => ['required', 'string', 'max:120'],
      'vat_number' => ['required', 'string', 'min:11', 'max:11', 'unique:' . Restaurant::class],
      // 'description' => ['min:10', 'max:255'],
      'typologies' => ['required', 'array', 'min:1'],
    ];
  }

  public function messages(): array
  {
    return [
      'name.max' => 'Questo campo deve essere lungo massimo 50 caratteri',
      'lastname.max' => 'Questo campo deve essere lungo massimo 50 caratteri',
      'email.unique' => 'Questa email è già utilizzata',
      'password.confirmed' => 'Le password inserite non corrispondono',
      'name_restaurant.required' => 'Questo campo è obbligatorio',
      'name_restaurant.max' => 'Questo campo deve essere lungo massimo 50 caratteri',
      'address.required' => 'Questo campo è obbligatorio',
      'address.max' => 'Questo campo deve essere lungo massimo 120 caratteri',
      'vat_number.required' => 'Questo campo è obbligatorio',
      'vat_number.min' => 'Questo campo deve essere composto da 11 numeri',
      'vat_number.max' => 'Questo campo deve essere composto da 11 numeri',
      'vat_number.unique' => 'Questa partita iva è già presente',
      'typologies' => 'Selezionare almeno una tipologia'
      // 'description.min' => 'Questo campo deve essere composto almeno da 10 caratteri',
      // 'description.max' => 'Questo campo deve essere lungo massimo 255 caratteri',
    ];
  }
}
