<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
