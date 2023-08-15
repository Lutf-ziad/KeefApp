<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == null) {
            $fail('The :attribute field is required');
        }
        if (! is_numeric($value)) {
            $fail('The :attribute field is not numeric');
        }
        if (strlen($value) != config('app.COUNTRY_DIGITS')) {
            $fail('The :attribute field is not 10 digits');
        }
        if (! preg_match('/^('.config('app.COUNTRY_KEYS').")\d{7}$/", $value)) {
            $fail('The :attribute field is incorrect (start with 05)');
        }
    }
}
