<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\InvokableRule;

class SecurePassword implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if(!preg_match('/[A-Z]/', $value) || !preg_match('/[a-z]/', $value) || !preg_match('~\d+~', $value) || !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)) {
            $fail('La contraseña debe contener al menos una letra minúscula, una letra mayúscula, un dígito y un carácter especial.');
        }
    }
}
