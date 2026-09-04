<?php

namespace App\Interfaces\TypeAccount;

use App\Interfaces\BaseInterface;

interface TypeAccountRepositoryInterface extends BaseInterface
{
    public function relationTypeAccountUser(int $typeAccountId) : object;
    public function allRelationTypeAccountUser(): object;

}
