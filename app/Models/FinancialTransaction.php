<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
class FinancialTransaction extends Model
{
    protected $fillable = [
        'type_account_id',
        'type',
        'description',
        'amount',
        'issue_date',
        'due_date',
        'status',
        'settlement_date',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'settlement_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function typeAccount(): BelongsTo
    {
        return $this->belongsTo(TypeAccount::class);
    }

    public function scopeReceivable(Builder $query): Builder
    {
        return $query->where('type', 'receber');
    }

    public function scopePayable(Builder $query): Builder
    {
        return $query->where('type', 'pagar');
    }

    public function scopeSettled(Builder $query): Builder
    {
        return $query->whereIn('status', ['recebido', 'pago']);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pendente');
    }

    public function scopeOverdue(Builder $query): Builder
    {
        return $query->where('status', 'pendente')
            ->where('settlement_date', '<', now());
    }

    public function scopeFinancialTransaction(Builder $query): object
    {
        return $query->with('type_account_id')
            ->get();
    }
}
