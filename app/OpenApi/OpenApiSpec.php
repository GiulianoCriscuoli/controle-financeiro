<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'Sistema de Controle Financeiro API',
    description: 'Documentação dos endpoints da API (autenticação, tipos de conta e transações financeiras).'
)]
#[OA\Server(
    url: L5_SWAGGER_CONST_HOST,
    description: 'Servidor da API'
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'Sanctum'
)]
#[OA\Tag(name: 'Autenticação', description: 'Login e logout de usuário')]
#[OA\Tag(name: 'Tipos de Conta', description: 'CRUD de clientes e fornecedores')]
#[OA\Tag(name: 'Transações Financeiras', description: 'CRUD de contas a pagar e a receber')]
final class OpenApiSpec
{
}
