<?php

namespace App\OpenApi\Paths;

use OpenApi\Attributes as OA;

/**
 * Documentação dos endpoints /dashboard.
 */
final class DashboardPaths
{
    #[OA\Get(
        path: '/dashboard',
        summary: 'Resumo financeiro consolidado por tipo de conta',
        security: [['bearerAuth' => []]],
        tags: ['Dashboard']
    )]
    #[OA\Response(
        response: 200,
        description: 'Lista de resumos financeiros agrupados por tipo de conta',
        content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/DashboardAccountSummary'))
    )]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    public function index(): void
    {
    }

    #[OA\Get(
        path: '/dashboard/report',
        summary: 'Relatório financeiro consolidado por ano, tipo de conta, tipo e status',
        security: [['bearerAuth' => []]],
        tags: ['Dashboard'],
        parameters: [
            new OA\Parameter(name: 'start_date', in: 'query', required: false, description: 'Filtra vencimento a partir desta data', schema: new OA\Schema(type: 'string', format: 'date'), example: '2026-01-01'),
            new OA\Parameter(name: 'end_date', in: 'query', required: false, description: 'Filtra vencimento até esta data (igual ou posterior a start_date)', schema: new OA\Schema(type: 'string', format: 'date'), example: '2026-12-31'),
            new OA\Parameter(name: 'type_account_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer'), example: 1),
            new OA\Parameter(name: 'type', in: 'query', required: false, schema: new OA\Schema(type: 'string', enum: ['receber', 'pagar']), example: 'receber'),
            new OA\Parameter(name: 'status', in: 'query', required: false, schema: new OA\Schema(type: 'string', enum: ['pendente', 'recebido', 'pago', 'cancelado']), example: 'pendente'),
        ]
    )]
    #[OA\Response(
        response: 200,
        description: 'Linhas do relatório consolidado',
        content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/DashboardReportRow'))
    )]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    #[OA\Response(response: 422, description: 'Dados de validação incorretos')]
    public function report(): void
    {
    }
}
