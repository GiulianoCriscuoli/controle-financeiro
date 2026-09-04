<?php

namespace App\Interfaces\Auth;

interface UserRepositoryInterface
{
    public function findByEmail(string $email);
}
