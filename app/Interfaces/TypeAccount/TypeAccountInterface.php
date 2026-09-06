<?php

namespace App\Interfaces\TypeAccount;

use App\Models\TypeAccount;

interface TypeAccountInterface
{
    public function all(): object;

    public function store(array $data, int $userId): object;

    public function update(int $typeAccountId, array $data): TypeAccount;

    public function destroy(int $typeAccountId): void;

    public function show(int $typeAccountId): TypeAccount;
}
