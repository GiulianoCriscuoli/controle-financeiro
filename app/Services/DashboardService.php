<?php

namespace App\Services;

use App\Models\FinancialTransaction;
use Illuminate\Support\Collection;

class DashboardService
{
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

    public function report(array $filters): Collection
    {
        return FinancialTransaction::query()
            ->selectRaw('YEAR(due_date) as year, type_account_id, type, status, SUM(amount) as total')
            ->when($filters['start_date'] ?? null, fn ($query, $date) => $query->where('due_date', '>=', $date))
            ->when($filters['end_date'] ?? null, fn ($query, $date) => $query->where('due_date', '<=', $date))
            ->when($filters['type_account_id'] ?? null, fn ($query, $id) => $query->where('type_account_id', $id))
            ->when($filters['type'] ?? null, fn ($query, $type) => $query->where('type', $type))
            ->when($filters['status'] ?? null, fn ($query, $status) => $query->where('status', $status))
            ->groupBy('year', 'type_account_id', 'type', 'status')
            ->with('typeAccount:id,name')
            ->orderBy('year')
            ->get()
            ->map(fn (FinancialTransaction $row) => [
                'year' => (int) $row->year,
                'type_account_id' => $row->type_account_id,
                'name' => $row->typeAccount->name,
                'type' => $row->type,
                'status' => $row->status,
                'total' => $this->money($row->total),
            ])
            ->values();
    }

    private function money(float $value): float
    {
        return (float) number_format($value, 2, '.', '');
    }
}
