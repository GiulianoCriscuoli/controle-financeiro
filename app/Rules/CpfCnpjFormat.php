<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfCnpjFormat implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = (string) $value;
        $length = strlen($value);

        if ($length === 11) {
            if (! ctype_digit($value)) {
                $fail('O :attribute (CPF) deve conter apenas números.');
            }

            return;
        }

        if ($length === 14) {
            if (! preg_match('/^[A-Z0-9]+$/', $value)) {
                $fail('O :attribute (CNPJ) deve conter apenas letras maiúsculas e números, sem pontuação.');
            }

            return;
        }

        $fail('O :attribute deve ter 11 dígitos (CPF) ou 14 caracteres (CNPJ).');
    }
}
