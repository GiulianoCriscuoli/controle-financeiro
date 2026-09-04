<?php

namespace App\Services\Auth;

use App\Interfaces\Auth\UserInterface;
use App\Interfaces\Auth\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;

class UserService implements UserInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}
    public function login(array $data): Authenticatable
    {
        $user = $this->userRepository->findByEmail($data['email']);

         if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email ou senha ou login incorretos. Faça o login novamente.'],
            ]);
        }

        return $user;
    }

    // public function logout()
    // {

    // }

      public function generateToken(Authenticatable $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}
