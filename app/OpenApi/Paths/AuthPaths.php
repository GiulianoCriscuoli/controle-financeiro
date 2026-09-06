<?php

namespace App\OpenApi\Paths;

use OpenApi\Attributes as OA;

/**
 * Documentação dos endpoints de autenticação.
 * Métodos vazios servem só de âncora para os atributos OpenAPI.
 */
final class AuthPaths
{
    #[OA\Post(
        path: '/login',
        summary: 'Autentica o usuário e retorna um token',
        tags: ['Autenticação'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'teste@exemplo.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'Teste@123'),
                ]
            )
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Login bem-sucedido',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'Login bem-sucedido'),
                new OA\Property(property: 'user', ref: '#/components/schemas/User'),
                new OA\Property(property: 'token', type: 'string', example: '11|xxxxxxxxxxxxxxxxxxxx'),
            ]
        )
    )]
    #[OA\Response(response: 422, description: 'Credenciais inválidas ou dados de validação incorretos')]
    public function login(): void
    {
    }

    #[OA\Post(
        path: '/logout',
        summary: 'Revoga o token atual do usuário autenticado',
        security: [['bearerAuth' => []]],
        tags: ['Autenticação']
    )]
    #[OA\Response(
        response: 200,
        description: 'Logout realizado com sucesso',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'Logout realizado com sucesso.'),
            ]
        )
    )]
    #[OA\Response(response: 401, description: 'Não autenticado')]
    public function logout(): void
    {
    }
}
