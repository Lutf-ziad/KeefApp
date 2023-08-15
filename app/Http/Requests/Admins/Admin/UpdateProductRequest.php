<?php

namespace App\Http\Requests\Admins\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'shop_id' => ['required', 'integer', 'exists:shops,id'],
            'active' => ['required', 'integer', 'in:0,1'],
        ];
    }
}
