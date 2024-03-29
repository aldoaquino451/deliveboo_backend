<?php

namespace App\Rules;

use Closure;
use App\Models\Product;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidProduct implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        Product::find($value) ? true : false;
    }

    public function message(){
        return 'Il prodotto non esiste';
    }
}
