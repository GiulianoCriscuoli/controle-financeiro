<?php

namespace App\Services;

use App\Models\FinancialTransaction;
use Illuminate\Support\Collection;

class DashboardService
{
    /**
     * Busca todas as transações (com o type_account já carregado) e
     * agrupa por type_account_id em memória, calculando os totais de
     * cada grupo com filtros simples de Collection.
     */
    public function index(): Collection
    {
        $now = now();

        return FinancialTransaction::with('typeAccount:id,name,type')
            ->get()
            ->groupBy('type_account_id')
            ->map(function (Collection $transactions, int $typeAccountId) use ($now) {
                $totalReceivable        = $transactions->where('type', 'receber')->where('status', 'pendente')->sum('amount');
                $totalReceived          = $transactions->where('type', 'receber')->where('status', 'recebido')->sum('amount');
                $totalOverdueReceivable = $transactions->where('type', 'receber')->where('status', 'pendente')->where('due_date', '<', $now)->sum('amount');

                $totalPayable = $transactions->where('type', 'pagar')->where('status', 'pendente')->sum('amount');
                $totalPaid    = $transactions->where('type', 'pagar')->where('status', 'pago')->sum('amount');
                $totalOverduePayable = $transactions->where('type', 'pagar')->where('status', 'pendente')->where('due_date', '<', $now)->sum('amount');

                $projectedBalance = ($totalReceivable + $totalReceived) - ($totalPayable + $totalPaid);
                $realizedBalance  = $totalReceived - $totalPaid;

                return [
                    'type_account_id' => $typeAccountId,
                    'name' => $transactions->first()->typeAccount->name,
                    'total_receivable' => $this->money($totalReceivable),
                    'total_received' => $this->money($totalReceived),
                    'total_overdue_receivable' => $this->money($totalOverdueReceivable),
                    'total_payable' => $this->money($totalPayable),
                    'total_paid' => $this->money($totalPaid),
                    'total_overdue_payable' => $this->money($totalOverduePayable),
                    'projected_balance' => $this->money($projectedBalance),
                    'realized_balance' => $this->money($realizedBalance),
                ];
            })
            ->values();
    }

    private function money(float $value): float
    {
        return (float) number_format($value, 2, '.', '');
    }
}
