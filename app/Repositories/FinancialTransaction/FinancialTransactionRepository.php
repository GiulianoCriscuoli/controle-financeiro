<?php

namespace App\Repositories\FinancialTransaction;

use App\Models\FinancialTransaction;
use App\Repositories\BaseRepository;
use App\Interfaces\FinancialTransaction\FinancialTransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class FinancialTransactionRepository extends BaseRepository implements FinancialTransactionRepositoryInterface
{
    public function __construct(FinancialTransaction $model)
    {
        parent::__construct($model);
    }

    public function relationFinancialTransactionTypeAccount(int $financialTransactionId): FinancialTransaction
    {
        return $this->model->with('typeAccount')->findOrFail($financialTransactionId);
    }

    public function allRelationFinancialTransactionTypeAccount(): Collection
    {
        return $this->model->with('typeAccount')->get();
    }
}
