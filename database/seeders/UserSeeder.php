<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $senha = Str::upper(Str::random(1)) . Str::random(9) . rand(0, 9) . '!';

        $user = User::factory()->create([
            'email' => 'teste@exemplo.com',
            'password' => Hash::make($senha),
        ]);

        $this->command->info("Email: {$user->email}");
        $this->command->info("Senha: {$senha}");
    }
}
