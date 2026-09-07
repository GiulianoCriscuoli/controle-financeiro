<?php

namespace Database\Seeders;

use App\Models\FinancialTransaction;
use Illuminate\Database\Seeder;

class FinancialTransactionSeeder extends Seeder
{
    private array $descriptions = [
        'receber' => [
            'Recebimento de venda de produtos',
            'Prestação de serviço de consultoria',
            'Recebimento de mensalidade de cliente',
            'Venda de licença de software',
            'Comissão sobre venda realizada',
        ],
        'pagar' => [
            'Pagamento de fornecedor de material de escritorio',
            'Pagamento de energia elétrica',
            'Pagamento de fornecedor de matéria-prima',
            'Pagamento de serviço de internet',
            'Pagamento de aluguel do escritório',
        ],
    ];

    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->createRandomTransaction();
        }
    }

    private function createRandomTransaction(): void
    {
        $type = fake()->randomElement(['receber', 'pagar']);
        $typeAccountId = fake()->randomElement([1, 2]);

        $issueDate = fake()->dateTimeBetween('-90 days', '-1 days');
        $dueDate = fake()->dateTimeBetween($issueDate, '+30 days');

        $statusRoll = fake()->numberBetween(1, 100);

        $status = match (true) {
            $statusRoll <= 40 => 'pendente',
            $statusRoll <= 85 => $type === 'receber' ? 'recebido' : 'pago',
            default => 'cancelado',
        };

        $settlementDate = match ($status) {
            'recebido', 'pago' => fake()->dateTimeBetween($issueDate, 'now'),
            default => null,
        };

        FinancialTransaction::create([
            'type_account_id' => $typeAccountId,
            'type' => $type,
            'description' => fake()->randomElement($this->descriptions[$type]),
            'amount' => fake()->randomFloat(2, 50, 5000),
            'issue_date' => $issueDate,
            'due_date' => $dueDate,
            'status' => $status,
            'settlement_date' => $settlementDate,
        ]);
    }
}
