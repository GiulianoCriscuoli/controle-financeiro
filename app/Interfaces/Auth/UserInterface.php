<?php

namespace App\Interfaces\Auth;

use Illuminate\Contracts\Auth\Authenticatable;

interface UserInterface
{
    public function login(array $account): Authenticatable;
    // public function logout(Authenticatable $user): void;
    public function generateToken(Authenticatable $user): string;
}
