<?php

namespace App\Http\Requests;

use App\Rules\CpfCnpjFormat;
use Illuminate\Foundation\Http\FormRequest;

class TypeAccountRequest extends FormRequest
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
        $required = $this->isMethod('put') || $this->isMethod('patch') ? 'sometimes' : 'required';

        return [
            'name' => [$required, 'string', 'min:3', 'max:255'],
            'cpf_cnpj' => [$required, 'string', 'min:11', 'max:14', new CpfCnpjFormat()],
            'email' => [$required, 'email'],
            'phone' => [$required, 'string', 'min:10', 'max:11'],
            'type' => [$required, 'string', 'in:C,F'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo de nome é obrigatório.',
            'name.string' => 'O campo de nome deve ser uma string.',
            'name.min' => 'O campo de nome deve ter no mínimo 3 caracteres.',
            'name.max' => 'O campo de nome deve ter no máximo 255 caracteres.',
            'cpf_cnpj.required' => 'O campo de CPF/CNPJ é obrigatório.',
            'cpf_cnpj.string' => 'O campo de CPF/CNPJ deve ser uma string.',
            'cpf_cnpj.min' => 'O campo de CPF/CNPJ deve ter no mínimo 11 caracteres.',
            'cpf_cnpj.max' => 'O campo de CPF/CNPJ deve ter no máximo 14 caracteres.',
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'O campo de e-mail deve ser um endereço de e-mail válido.',
            'phone.required' => 'O campo de telefone é obrigatório.',
            'phone.string' => 'O campo de telefone deve ser uma string.',
            'phone.min' => 'O campo de telefone deve ter no mínimo 10 caracteres.',
            'phone.max' => 'O campo de telefone deve ter no máximo 11 caracteres.',
            'type.required' => 'O campo de tipo é obrigatório.',
            'type.string' => 'O campo de tipo deve ser uma string.',
            'type.in' => "O campo de tipo deve ser um dos seguintes valores: C (cliente) ou F (fornecedor).",
        ];
    }
}
