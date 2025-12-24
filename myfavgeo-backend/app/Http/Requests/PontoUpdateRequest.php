<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PontoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['sometimes', 'required', 'string', 'max:255'],
            'descricao' => ['sometimes', 'nullable', 'string'],
            'url_imagem' => ['sometimes', 'nullable', 'url'],
            'latitude' => ['sometimes', 'required', 'numeric'],
            'longitude' => ['sometimes', 'required', 'numeric'],
            'mapa_id' => ['sometimes', 'required', 'integer', 'exists:mapas,id'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
