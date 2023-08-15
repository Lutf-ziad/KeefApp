<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NameRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == null) {
            $fail('The :attribute field is required');
        }
        if (strlen($value) < 5) {
            $fail('The :attribute field must be at least 5 characters');
        }
        if (! preg_match("/^[a-zA-Z\s_-]+$/", $value)) {
            $fail('The :attribute field format is invalid.');
        }

    }
}
