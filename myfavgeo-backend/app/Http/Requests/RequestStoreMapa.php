<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestStoreMapa extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array {
        return [
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'url_imagem' => 'nullable|url',
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
