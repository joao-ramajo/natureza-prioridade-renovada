<?php

namespace App\Http\Requests\CollectionPoint;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'category_id' => 'required|integer|exists:categories,id',
            'open_to' => 'required|date_format:H:i',
            'open_from' => 'required|date_format:H:i',
            'days_open' => 'required|string|max:50',
            'description' => 'nullable|string|max:200'
        ];
    }
}
