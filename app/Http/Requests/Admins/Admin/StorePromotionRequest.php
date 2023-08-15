<?php

namespace App\Http\Requests\Admins\Admin;

use App\Enums\PromotionType;
use App\Models\Package;
use App\Rules\ExistRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StorePromotionRequest extends FormRequest
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
            'package_id' => ['nullable', new ExistRule(new Package)],
            'code' => ['required', 'string', 'max:255'],
            'title' => ['nullabe', 'string', 'max:255'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date'],
            'type' => ['required', new Enum(PromotionType::class)],
            'amount' => ['required', 'numeric'],
            'valid_number' => ['nullable', 'numeric'],
            'active' => ['required', 'integer', 'in:0,1'],
        ];
    }
}
