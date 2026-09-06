<?php

namespace App\OpenApi\Paths;

use OpenApi\Attributes as OA;

/**
 * Documentação do resource /type-accounts.
 */
final class TypeAccountPaths
{
    #[OA\Get(
        path: '/type-accounts',
        summary: 'Lista todos os tipos de conta com o usuário vinculado',
        security: [['bearerAuth' => []]],
        tags: ['Tipos de Conta']
    )]
    #[OA\Response(
        response: 200,
        description: 'Lista de tipos de conta',
        content: new OA\JsonContent(type: 'array', items: new OA\Items(ref: '#/components/schemas/TypeAccount'))
    )]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    public function index(): void
    {
    }

    #[OA\Post(
        path: '/type-accounts',
        summary: 'Cadastra um tipo de conta (cliente ou fornecedor)',
        security: [['bearerAuth' => []]],
        tags: ['Tipos de Conta'],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/TypeAccountInput'))
    )]
    #[OA\Response(
        response: 201,
        description: 'Cadastro criado com sucesso',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'O Cadastro de cliente criado com sucesso'),
                new OA\Property(property: 'type_account', ref: '#/components/schemas/TypeAccount'),
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
        path: '/type-accounts/{type_account}',
        summary: 'Exibe um tipo de conta específico com o usuário vinculado',
        security: [['bearerAuth' => []]],
        tags: ['Tipos de Conta'],
        parameters: [
            new OA\Parameter(name: 'type_account', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ]
    )]
    #[OA\Response(response: 200, description: 'Tipo de conta encontrado', content: new OA\JsonContent(ref: '#/components/schemas/TypeAccount'))]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    #[OA\Response(response: 404, description: 'Registro não encontrado')]
    public function show(): void
    {
    }

    #[OA\Put(
        path: '/type-accounts/{type_account}',
        summary: 'Atualiza um tipo de conta (parcial ou total)',
        security: [['bearerAuth' => []]],
        tags: ['Tipos de Conta'],
        parameters: [
            new OA\Parameter(name: 'type_account', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(required: true, content: new OA\JsonContent(ref: '#/components/schemas/TypeAccountInput'))
    )]
    #[OA\Response(
        response: 200,
        description: 'Tipo de conta atualizado com sucesso',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'O Tipo de conta foi atualizado com sucesso'),
                new OA\Property(property: 'type_account', ref: '#/components/schemas/TypeAccount'),
            ]
        )
    )]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    #[OA\Response(response: 404, description: 'Registro não encontrado')]
    #[OA\Response(response: 422, description: 'Dados de validação incorretos')]
    #[OA\Response(response: 500, description: 'Erro ao processar a atualização')]
    public function update(): void
    {
    }

    #[OA\Delete(
        path: '/type-accounts/{type_account}',
        summary: 'Exclui um tipo de conta',
        security: [['bearerAuth' => []]],
        tags: ['Tipos de Conta'],
        parameters: [
            new OA\Parameter(name: 'type_account', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ]
    )]
    #[OA\Response(
        response: 200,
        description: 'Tipo de conta excluído com sucesso',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'O Tipo de conta foi excluído com sucesso'),
            ]
        )
    )]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    #[OA\Response(response: 404, description: 'Registro não encontrado')]
    #[OA\Response(response: 500, description: 'Erro ao processar a exclusão')]
    public function destroy(): void
    {
    }
}
