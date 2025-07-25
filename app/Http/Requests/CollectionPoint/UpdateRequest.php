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
            'user_id' => 'required|integer|exists:users,id',

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
            'categories-id' => 'required|array',
            'categories-id.*' => 'integer|exists:categories,id',

            // Dias abertos
            'days_open' => 'required|array|',
            'days_open.*' => 'string',

            // Horários
            'open_from' => 'required|date_format:H:i',
            'open_to' => 'required|date_format:H:i',


            // Descrição
            'description' => 'nullable|string|max:200',

            // Latitude e longitude (valores decimais válidos)
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do ponto é obrigatório.',
            'name.string' => 'O nome do ponto deve ser um texto.',
            'name.max' => 'O nome do ponto não pode ter mais que 60 caracteres.',
            'name.min' => 'O nome do ponto deve ter pelo menos 1 caractere.',

            'user_id.required' => 'O ID do usuário é obrigatório.',
            'user_id.integer' => 'O ID do usuário deve ser um número inteiro.',
            'user_id.exists' => 'Usuário não encontrado.',

            'cep.required' => 'O CEP é obrigatório.',
            'cep.string' => 'O CEP deve ser um texto.',
            'cep.max' => 'O CEP não pode ter mais que 10 caracteres.',
            'cep.regex' => 'O formato do CEP é inválido. Use 12345-678 ou 12345678.',

            'street.required' => 'A rua é obrigatória.',
            'street.string' => 'A rua deve ser um texto.',
            'street.max' => 'A rua não pode ter mais que 100 caracteres.',

            'number.string' => 'O número deve ser um texto.',
            'number.max' => 'O número não pode ter mais que 10 caracteres.',

            'complement.string' => 'O complemento deve ser um texto.',
            'complement.max' => 'O complemento não pode ter mais que 50 caracteres.',

            'neighborhood.required' => 'O bairro é obrigatório.',
            'neighborhood.string' => 'O bairro deve ser um texto.',
            'neighborhood.max' => 'O bairro não pode ter mais que 100 caracteres.',

            'city.required' => 'A cidade é obrigatória.',
            'city.string' => 'A cidade deve ser um texto.',
            'city.max' => 'A cidade não pode ter mais que 100 caracteres.',

            'state.required' => 'O estado é obrigatório.',
            'state.string' => 'O estado deve ser um texto.',
            'state.size' => 'O estado deve conter exatamente 2 letras (ex: SP).',

            'categories-id.required' => 'Selecione pelo menos uma categoria.',
            'categories-id.array' => 'O campo de categorias deve ser uma lista.',
            'categories-id.*.integer' => 'Cada categoria deve ser um número inteiro.',
            'categories-id.*.exists' => 'Uma ou mais categorias selecionadas são inválidas.',

            'days_open.required' => 'Selecione pelo menos um dia de funcionamento.',
            'days_open.array' => 'O campo de dias abertos deve ser uma lista.',
            'days_open.*.string' => 'Cada dia deve ser um texto válido.',

            'open_from.required' => 'O horário de abertura é obrigatório.',
            'open_from.date_format' => 'O horário de abertura deve estar no formato HH:mm.',

            'open_to.required' => 'O horário de fechamento é obrigatório.',
            'open_to.date_format' => 'O horário de fechamento deve estar no formato HH:mm.',

            'description.string' => 'A descrição deve ser um texto.',
            'description.max' => 'A descrição não pode ter mais que 200 caracteres.',

            'latitude.numeric' => 'A latitude deve ser um número.',
            'latitude.between' => 'A latitude deve estar entre -90 e 90.',

            'longitude.numeric' => 'A longitude deve ser um número.',
            'longitude.between' => 'A longitude deve estar entre -180 e 180.',
        ];
    }
}
