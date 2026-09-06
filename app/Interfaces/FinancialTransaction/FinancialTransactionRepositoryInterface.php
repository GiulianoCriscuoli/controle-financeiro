<?php

namespace App\Interfaces\FinancialTransaction;

use App\Interfaces\BaseInterface;

interface FinancialTransactionRepositoryInterface extends BaseInterface
{
    public function relationFinancialTransactionTypeAccount(int $financialTransactionId): object;

    public function allRelationFinancialTransactionTypeAccount(): object;
}
