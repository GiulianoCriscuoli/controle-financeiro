<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'User',
    title: 'User',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'João da Silva'),
        new OA\Property(property: 'email', type: 'string', format: 'email', example: 'teste@exemplo.com'),
        new OA\Property(property: 'email_verified_at', type: 'string', format: 'date-time', nullable: true),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time'),
    ]
)]
#[OA\Schema(
    schema: 'TypeAccount',
    title: 'TypeAccount',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'Grupo Studio'),
        new OA\Property(property: 'cpf_cnpj', type: 'string', example: '12345678000199'),
        new OA\Property(property: 'email', type: 'string', format: 'email', example: 'contato@grupostudio.com'),
        new OA\Property(property: 'phone', type: 'string', example: '11987654321'),
        new OA\Property(property: 'type', type: 'string', enum: ['C', 'F'], description: 'C = cliente, F = fornecedor', example: 'C'),
        new OA\Property(property: 'user_id', type: 'integer', example: 1),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'user', ref: '#/components/schemas/User', nullable: true),
    ]
)]
#[OA\Schema(
    schema: 'TypeAccountInput',
    title: 'TypeAccountInput',
    required: ['name', 'cpf_cnpj', 'email', 'phone', 'type'],
    properties: [
        new OA\Property(property: 'name', type: 'string', minLength: 3, maxLength: 255, example: 'Grupo Studio'),
        new OA\Property(property: 'cpf_cnpj', type: 'string', minLength: 11, maxLength: 14, description: 'Somente dígitos (CPF) ou letras maiúsculas e dígitos (CNPJ), sem pontuação', example: '12345678000199'),
        new OA\Property(property: 'email', type: 'string', format: 'email', example: 'contato@grupostudio.com'),
        new OA\Property(property: 'phone', type: 'string', minLength: 10, maxLength: 11, example: '11987654321'),
        new OA\Property(property: 'type', type: 'string', enum: ['C', 'F'], example: 'C'),
    ]
)]
#[OA\Schema(
    schema: 'FinancialTransaction',
    title: 'FinancialTransaction',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'type_account_id', type: 'integer', example: 1),
        new OA\Property(property: 'type', type: 'string', enum: ['receber', 'pagar'], example: 'receber'),
        new OA\Property(property: 'description', type: 'string', example: 'Venda de serviço de consultoria mensal'),
        new OA\Property(property: 'amount', type: 'string', example: '1500.00'),
        new OA\Property(property: 'issue_date', type: 'string', format: 'date', example: '2026-09-06'),
        new OA\Property(property: 'due_date', type: 'string', format: 'date', example: '2026-10-06'),
        new OA\Property(property: 'status', type: 'string', example: 'pendente'),
        new OA\Property(property: 'settlement_date', type: 'string', format: 'date', nullable: true),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'type_account', ref: '#/components/schemas/TypeAccount', nullable: true),
    ]
)]
#[OA\Schema(
    schema: 'FinancialTransactionInput',
    title: 'FinancialTransactionInput',
    required: ['type_account_id', 'type', 'description', 'amount', 'issue_date', 'due_date', 'status'],
    properties: [
        new OA\Property(property: 'type_account_id', type: 'integer', example: 1),
        new OA\Property(property: 'type', type: 'string', enum: ['receber', 'pagar'], example: 'receber'),
        new OA\Property(property: 'description', type: 'string', minLength: 10, maxLength: 255, example: 'Venda de serviço de consultoria mensal'),
        new OA\Property(property: 'amount', type: 'number', format: 'float', example: 1500.00),
        new OA\Property(property: 'issue_date', type: 'string', format: 'date', example: '2026-09-06'),
        new OA\Property(property: 'due_date', type: 'string', format: 'date', description: 'Igual ou posterior a issue_date', example: '2026-10-06'),
        new OA\Property(
            property: 'status',
            type: 'string',
            description: "receber: pendente|recebido|vencido|cancelado — pagar: pendente|pago|vencido|cancelado",
            example: 'pendente'
        ),
        new OA\Property(property: 'settlement_date', type: 'string', format: 'date', nullable: true),
    ]
)]
#[OA\Schema(
    schema: 'DashboardAccountSummary',
    title: 'DashboardAccountSummary',
    properties: [
        new OA\Property(property: 'type_account_id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'Grupo Studio'),
        new OA\Property(property: 'total_receivable', type: 'number', format: 'float', description: 'Total a receber pendente', example: 1500.00),
        new OA\Property(property: 'total_received', type: 'number', format: 'float', description: 'Total já recebido', example: 800.00),
        new OA\Property(property: 'total_overdue_receivable', type: 'number', format: 'float', description: 'Total a receber vencido', example: 300.00),
        new OA\Property(property: 'total_payable', type: 'number', format: 'float', description: 'Total a pagar pendente', example: 1200.00),
        new OA\Property(property: 'total_paid', type: 'number', format: 'float', description: 'Total já pago', example: 500.00),
        new OA\Property(property: 'total_overdue_payable', type: 'number', format: 'float', description: 'Total a pagar vencido', example: 250.00),
        new OA\Property(property: 'projected_balance', type: 'number', format: 'float', description: '(a receber + recebido) - (a pagar + pago)', example: 600.00),
        new OA\Property(property: 'realized_balance', type: 'number', format: 'float', description: 'recebido - pago', example: 300.00),
    ]
)]
#[OA\Schema(
    schema: 'DashboardReportRow',
    title: 'DashboardReportRow',
    properties: [
        new OA\Property(property: 'year', type: 'integer', example: 2026),
        new OA\Property(property: 'type_account_id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'Grupo Studio'),
        new OA\Property(property: 'type', type: 'string', enum: ['receber', 'pagar'], example: 'receber'),
        new OA\Property(property: 'status', type: 'string', example: 'pendente'),
        new OA\Property(property: 'total', type: 'number', format: 'float', example: 1500.00),
    ]
)]
final class Schemas
{
}
