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

            // Se usar 'zip_code' em vez de 'cep'
            'cep' => [
                'required',
                'string',
                'max:10',
                'regex:/^\d{5}-?\d{3}$/' // aceita "12345-678" ou "12345678"
            ],

            // Endereço detalhado
            'street' => 'required|string|max:100',
            'number' => 'nullable|string|max:10',
            'complement' => 'nullable|string|max:50',
            'neighborhood' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'state' => 'required|string|size:2',

            // Categoria (assumindo relacionamento Many to Many)
            'categories_id' => 'required|array',
            'categories_id.*' => 'integer|exists:categories,id',

            // Horários
            'open_from' => 'required|date_format:H:i',
            'open_to' => 'required|date_format:H:i',

            // Dias abertos
            'days_open' => 'required|string|max:50',

            // Descrição
            'description' => 'nullable|string|max:200',

            // Latitude e longitude (valores decimais válidos)
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }
}
