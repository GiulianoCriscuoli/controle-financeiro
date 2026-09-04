<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Interfaces\Auth\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
         parent::__construct($model);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model::where('email', $email)->first();
    }
}
