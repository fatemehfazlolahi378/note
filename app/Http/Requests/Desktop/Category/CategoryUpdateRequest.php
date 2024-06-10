<?php

namespace App\Http\Requests\Desktop\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
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
            'name' => ['required', Rule::unique('categories', 'name')->ignore($this->category->id)],
            'parent_id' => 'required',
            'slug' => ['required', Rule::unique('categories', 'slug')->ignore($this->category->id)],
        ];
    }
}
