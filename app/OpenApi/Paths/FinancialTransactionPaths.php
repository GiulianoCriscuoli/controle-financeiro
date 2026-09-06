<?php

namespace App\OpenApi\Paths;

use OpenApi\Attributes as OA;

/**
 * Documentação do resource /financial-transactions.
 */
final class FinancialTransactionPaths
{
    #[OA\Get(
        path: '/financial-transactions',
        summary: 'Lista todas as transações financeiras',
        security: [['bearerAuth' => []]],
        tags: ['Transações Financeiras']
    )]
    #[OA\Response(
        response: 200,
        description: 'Lista de transações financeiras',
        content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/FinancialTransaction'))
    )]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    public function index(): void
    {
    }

    #[OA\Post(
        path: '/financial-transactions',
        summary: 'Cria um lançamento (conta a pagar ou a receber)',
        security: [['bearerAuth' => []]],
        tags: ['Transações Financeiras'],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/FinancialTransactionInput'))
    )]
    #[OA\Response(
        response: 201,
        description: 'Lançamento criado com sucesso',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'O lançamento foi criado com sucesso'),
            ]
        )
    )]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    #[OA\Response(response: 422, description: 'Dados de validação incorretos')]
    #[OA\Response(response: 500, description: 'Erro ao processar o cadastro')]
    public function store(): void
    {
    }

    #[OA\Get(
        path: '/financial-transactions/{financial_transaction}',
        summary: 'Exibe uma transação financeira específica',
        security: [['bearerAuth' => []]],
        tags: ['Transações Financeiras'],
        parameters: [
            new OA\Parameter(name: 'financial_transaction', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ]
    )]
    #[OA\Response(response: 200, description: 'Transação encontrada', content: new OA\JsonContent(ref: '#/components/schemas/FinancialTransaction'))]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    #[OA\Response(response: 404, description: 'Registro não encontrado')]
    public function show(): void
    {
    }

    #[OA\Put(
        path: '/financial-transactions/{financial_transaction}',
        summary: 'Atualiza uma transação financeira (parcial ou total)',
        security: [['bearerAuth' => []]],
        tags: ['Transações Financeiras'],
        parameters: [
            new OA\Parameter(name: 'financial_transaction', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/FinancialTransactionInput'))
    )]
    #[OA\Response(response: 200, description: 'Transação atualizada com sucesso')]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    #[OA\Response(response: 404, description: 'Registro não encontrado')]
    #[OA\Response(response: 422, description: 'Dados de validação incorretos')]
    #[OA\Response(response: 500, description: 'Erro ao processar a atualização')]
    public function update(): void
    {
    }

    #[OA\Delete(
        path: '/financial-transactions/{financial_transaction}',
        summary: 'Exclui uma transação financeira',
        security: [['bearerAuth' => []]],
        tags: ['Transações Financeiras'],
        parameters: [
            new OA\Parameter(name: 'financial_transaction', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ]
    )]
    #[OA\Response(response: 200, description: 'Transação excluída com sucesso')]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    #[OA\Response(response: 404, description: 'Registro não encontrado')]
    #[OA\Response(response: 500, description: 'Erro ao processar a exclusão')]
    public function destroy(): void
    {
    }
}
