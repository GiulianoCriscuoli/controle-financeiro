<?php

namespace App\Repositories\TypeAccount;

use App\Models\TypeAccount;
use App\Repositories\BaseRepository;
use App\Interfaces\TypeAccount\TypeAccountRepositoryInterface;

class TypeAccountRepository extends BaseRepository implements TypeAccountRepositoryInterface
{
    public function __construct(TypeAccount $model)
    {
         parent::__construct($model);
    }

    // public function relationTypeAccountUser() : object
    // {
    //     return $this->model->with('user')->get();
    // }
}
