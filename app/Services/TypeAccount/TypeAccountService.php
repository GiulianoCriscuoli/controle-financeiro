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

    public function all() : object {

        $allTypeAccounts = $this->typeAccountRepository->allRelationTypeAccountUser();

        return $allTypeAccounts;
    }

    public function store(array $data, int $userId) : object
    {
        $data['user_id'] = $userId;
        return $this->typeAccountRepository->store($data);
    }

    public function update(int $typeAccountId, array $data): TypeAccount
    {

        if(!$typeAccountId) {
            throw new \InvalidArgumentException('Este tipo de conta não foi encontrado para atualização.');
        }

        return $this->typeAccountRepository->update($typeAccountId, $data);
    }

    public function destroy(int $typeAccountId): void
    {
        if (!$typeAccountId) {
            throw new \InvalidArgumentException('Este tipo de conta não foi encontrado para exclusão.');
        }

        $this->typeAccountRepository->destroy($typeAccountId);
    }

    public function show(int $typeAccountId): TypeAccount
    {
        return $this->typeAccountRepository->relationTypeAccountUser($typeAccountId);
    }
}
