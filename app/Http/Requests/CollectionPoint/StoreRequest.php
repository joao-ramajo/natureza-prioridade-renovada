<?php

namespace App\Http\Requests\CollectionPoint;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:60|min:1',
            'cep' => 'required|size:9|string|regex:/^\d{5}-\d{3}$/',
            'categories_id' => 'required|array',
            'categories_id.*' => 'integer|exists:categories,id'
        ];
    }
}
