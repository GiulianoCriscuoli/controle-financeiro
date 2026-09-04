<?php

namespace App\Repositories\TypeAccount;

use App\Models\TypeAccount;
use App\Repositories\BaseRepository;
use App\Interfaces\TypeAccount\TypeAccountRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TypeAccountRepository extends BaseRepository implements TypeAccountRepositoryInterface
{
    public function __construct(TypeAccount $model)
    {
         parent::__construct($model);
    }

    public function relationTypeAccountUser(int $typeAccountId): TypeAccount
    {
        return $this->model->with('user')->findOrFail($typeAccountId);
    }

    public function allRelationTypeAccountUser(): Collection
    {
       return $this->model->with('user')->get();
    }
}
