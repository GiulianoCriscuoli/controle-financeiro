# Sistema de Controle Financeiro API

API REST (Laravel + MySQL) para controle de contas a pagar e a receber, tipos de conta (clientes/fornecedores) e dashboard financeiro. Ambiente containerizado com Docker.

## Requisitos

- Docker
- Docker Compose

## Stack

- PHP 8.4 + Apache (imagem `php:8.4-apache`)
- MySQL 8.0
- Laravel + `darkaonline/l5-swagger` (OpenAPI)

## Passo a passo

### 1. Clonar e entrar no projeto

```bash
git clone <url-do-repositorio>
cd sistema-controle-financeiro
```

### 2. Criar o `.env`

Copie o exemplo abaixo para um arquivo `.env` na raiz:

```env
APP_NAME="Grupo Studio"
APP_ENV=local
APP_KEY=base64:r7Yqf7Q61/Rbbs69p2WSmDPHcD+kLV31DOtkhvpkWeY=
APP_DEBUG=true
APP_URL=http://localhost:8093

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=grupo_studio
DB_USERNAME=grupo_studio
DB_PASSWORD=troque_esta_senha
DB_ROOT_PASSWORD=troque_esta_senha_root

SESSION_DRIVER=database
SESSION_LIFETIME=120

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database
CACHE_STORE=database

L5_SWAGGER_CONST_HOST="${APP_URL}/api"
L5_SWAGGER_GENERATE_ALWAYS=true

MAIL_MAILER=log
```

Notas:
- `DB_HOST=mysql` é o nome do serviço no `docker-compose.yml` (não use `localhost`).
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` e `DB_ROOT_PASSWORD` são lidos também pelo container MySQL para criar o banco/usuário no primeiro start.
- Gere uma `APP_KEY` própria com `docker compose exec apache php artisan key:generate` se preferir.

### 3. Subir os containers

```bash
docker compose up -d --build
```

Sobe dois serviços:

| Serviço | Container | Porta host |
|---|---|---|
| apache (app) | `apache-grupo-studio` | `8093` -> `80` |
| mysql | `mysql-grupo-studio` | `3311` -> `3306` |

O entrypoint roda `composer install` e ajusta permissões de `storage` e `bootstrap/cache` automaticamente.

### 4. Rodar as migrations

```bash
docker compose exec apache php artisan migrate
```

### 5. Rodar os seeders

```bash
docker compose exec apache php artisan db:seed
```

Cria o usuário de teste (`teste@exemplo.com`) e transações financeiras de exemplo. A **senha é gerada aleatoriamente** e impressa no output do comando:

```
Email: teste@exemplo.com
Senha: Xxxxxxxxx0!
```

Guarde a senha exibida — use-a no endpoint `POST /api/login` para obter o token Bearer.

> Recriar do zero: `docker compose exec apache php artisan migrate:fresh --seed`

### 6. Acessar

- API: `http://localhost:8093/api`
- **Swagger UI: http://localhost:8093/api/documentation**

Como `L5_SWAGGER_GENERATE_ALWAYS=true`, a documentação é regenerada a cada acesso. Para gerar manualmente:

```bash
docker compose exec apache php artisan l5-swagger:generate
```

## Autenticação

1. `POST /api/login` com `email` e `password` -> retorna `token`.
2. Enviar `Authorization: Bearer <token>` nas demais rotas (protegidas por `auth:sanctum`).

## Comandos úteis

```bash
docker compose logs -f apache        # logs da aplicação
docker compose exec apache bash      # shell no container
docker compose down                  # parar
docker compose down -v               # parar e apagar o volume do MySQL
```
