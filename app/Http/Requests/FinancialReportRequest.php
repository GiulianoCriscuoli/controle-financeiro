<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialReportRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'type_account_id' => ['nullable', 'integer', 'exists:type_accounts,id'],
            'type' => ['nullable', 'in:receber,pagar'],
            'status' => ['nullable', 'in:pendente,recebido,pago,cancelado,vencido'],
        ];
    }
}
