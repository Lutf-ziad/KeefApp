<?php

namespace App\Http\Requests\Admins\Admin;

use App\Models\Shop;
use App\Rules\ExistRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
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
            'category_id' => ['required', 'exists:categories,id'],
            'parent_id' => ['nullable', new ExistRule(new Shop)],
            'name' => ['required', 'min:3', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:'.config('app.ALLOED_IMAGE_EXTENSIONS'), 'max:'.config('app.ALLOED_IMAGE_SIZE')],
            'level_id' => ['required', 'exists:levels,id'],
            'lat' => ['required', 'numeric'],
            'lon' => ['required', 'numeric'],
            'active' => ['required', 'integer', 'in:0,1'],
        ];
    }
}
