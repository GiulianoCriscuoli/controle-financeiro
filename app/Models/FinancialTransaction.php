<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
