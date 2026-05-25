<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class AlunoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'matricula' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'matricula.required' => 'Matrícula obrigatória',
            'matricula.numeric' => 'Matrícula deve ser numérico',
        ];
    }
}
