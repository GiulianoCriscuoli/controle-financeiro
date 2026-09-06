<?php

namespace App\Interfaces\FinancialTransaction;

use App\Models\FinancialTransaction;

interface FinancialTransactionInterface
{
    public function all(): object;

    public function store(array $data): object;

    public function update(int $financialTransactionId, array $data): FinancialTransaction;

    public function destroy(int $financialTransactionId): void;

    public function show(int $financialTransactionId): FinancialTransaction;
}
