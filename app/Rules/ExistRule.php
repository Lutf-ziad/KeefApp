<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Database\Eloquent\Model;

class ExistRule implements ValidationRule
{
    public function __construct(public Model $model)
    {

    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $result = $this->model::find($value);
        if ($value != 'null' && ! $result) {
            $fail('The :attribute field is not exist');
        }
    }
}
