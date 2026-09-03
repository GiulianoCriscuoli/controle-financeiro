<?php

namespace App\Interfaces\Auth;

interface UserInterface
{
    public function login(array $account): array;
    public function logout($user): void;
}
