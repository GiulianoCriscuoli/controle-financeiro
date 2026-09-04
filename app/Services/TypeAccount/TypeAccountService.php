<?php

namespace App\Services\TypeAccount;

use App\Interfaces\TypeAccount\TypeAccountInterface;
use App\Interfaces\TypeAccount\TypeAccountRepositoryInterface;
use App\Models\TypeAccount;

class TypeAccountService implements TypeAccountInterface
{
    public function __construct(
        private TypeAccountRepositoryInterface $typeAccountRepository
    ) {}

    public function store(array $data, int $userId) : object
    {
        $data['user_id'] = $userId;
        return $this->typeAccountRepository->store($data);
    }

    public function update(int $typeAccountId, array $data): TypeAccount
    {

        if(!$typeAccountId) {
            throw new \InvalidArgumentException('O ID não foi encontrado para atualização.');
        }

        return $this->typeAccountRepository->update($typeAccountId, $data);
    }
}
