<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class StoreMapaRequest extends FormRequest
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
}
