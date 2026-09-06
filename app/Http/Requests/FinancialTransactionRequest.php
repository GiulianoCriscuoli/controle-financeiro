<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FinancialTransactionRequest extends FormRequest
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

        $type = $this->input('type');

        $validStatus = $type === 'pagar'
            ? ['pendente', 'pago', 'vencido', 'cancelado']
            : ['pendente', 'recebido', 'vencido', 'cancelado'];

        return [
            'type_account_id' => [$required, 'integer', 'exists:type_accounts,id'],
            'type' => [$required, 'string', 'in:receber,pagar'],
            'description' => [$required, 'string', 'min:10', 'max:255'],
            'amount' => [$required, 'numeric'],
            'issue_date' => [$required, 'date'],
            'due_date' => [$required, 'date', 'after_or_equal:issue_date'],
            'status' => [$required, 'string', Rule::in($validStatus)],
            'settlement_date' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'type_account_id.required' => 'O campo de conta é obrigatório.',
            'type_account_id.integer' => 'O campo de conta deve ser um número inteiro.',
            'type_account_id.exists' => 'A conta informada não foi encontrada.',

            'type.required' => 'O campo de tipo é obrigatório.',
            'type.string' => 'O campo de tipo deve ser uma string.',
            'type.in' => 'O campo de tipo deve ser um dos seguintes valores: receber ou pagar.',

            'description.required' => 'O campo de descrição é obrigatório.',
            'description.string' => 'O campo de descrição deve ser uma string.',
            'description.min' => 'O campo de descrição deve ter no mínimo 10 caracteres.',
            'description.max' => 'O campo de descrição deve ter no máximo 255 caracteres.',

            'amount.required' => 'O campo de valor é obrigatório.',
            'amount.numeric' => 'O campo de valor deve ser numérico.',

            'issue_date.required' => 'O campo de data de emissão é obrigatório.',
            'issue_date.date' => 'O campo de data de emissão deve ser uma data válida.',

            'due_date.required' => 'O campo de data de vencimento é obrigatório.',
            'due_date.date' => 'O campo de data de vencimento deve ser uma data válida.',
            'due_date.after_or_equal' => 'A data de vencimento deve ser igual ou posterior à data de emissão.',

            'status.required' => 'O campo de status é obrigatório.',
            'status.string' => 'O campo de status deve ser uma string.',
            'status.in' => 'O status informado não é válido para o tipo de conta selecionado.',

            'settlement_date.date' => 'O campo de data de liquidação deve ser uma data válida.',
        ];
    }
}
