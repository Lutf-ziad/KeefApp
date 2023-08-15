<?php

namespace App\Http\Requests\Admins\Admin;

use App\Rules\NameRule;
use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [new NameRule, 'max:255'],
            'phone' => [new PhoneRule, 'unique:users,phone,'.$this->client->id],
            'email' => ['nullable', 'email', 'unique:users,email,'.$this->client->id],
            'password' => ['nullable', 'min:6'],
            'birthdate' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'mimes:'.config('app.ALLOED_IMAGE_EXTENSIONS'), 'max:'.config('app.ALLOED_IMAGE_SIZE')],
            'cups' => ['nullable', 'integer'],
            'support_code' => ['nullable', 'max:10'],
            'active' => ['integer', 'in:0,1'],
            'notification' => ['integer', 'in:0,1'],
            'email_notify' => ['integer', 'in:0,1'],
            'phone_verified' => ['integer', 'in:0,1'],
        ];
    }
}
