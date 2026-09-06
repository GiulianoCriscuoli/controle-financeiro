<?php

namespace App\Services\FinancialTransaction;

use App\Interfaces\FinancialTransaction\FinancialTransactionInterface;
use App\Interfaces\FinancialTransaction\FinancialTransactionRepositoryInterface;
use App\Models\FinancialTransaction;

class FinancialTransactionService implements FinancialTransactionInterface
{
    public function __construct(
        private FinancialTransactionRepositoryInterface $financialTransactionRepository
    ) {}

    public function all(): object
    {
        //
    }

    public function store(array $data): object
    {
        return $this->financialTransactionRepository->store($data);
    }

    public function update(int $financialTransactionId, array $data): FinancialTransaction
    {

        if(!$financialTransactionId) {
            throw new \InvalidArgumentException('Conta a pagar ou a recer não foi encontrada para atualização.');
        }

        return $this->financialTransactionRepository->update($financialTransactionId, $data);
    }

    public function destroy(int $financialTransactionId): void
    {
        //
    }

    public function show(int $financialTransactionId): FinancialTransaction
    {
        //
    }
}
