<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypeAccount extends Model
{
    protected $fillable = [
        'name',
        'cpf_cnpj',
        'email',
        'type',
        'phone',
        'user_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function financialTransaction()
    {
        return $this->hasMany(FinancialTransaction::class, 'type_account_id');
    }
}
