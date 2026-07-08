# MailFlow API

API backend para disparo de e-mails em lote via segmentos de clientes, construída com Laravel 12, Redis e MySQL.

## O problema que este projeto resolve

Em sistemas de CRM, é comum a necessidade de disparar campanhas de e-mail para grandes bases de clientes. Utilizando a SendGrid como provedor de envio, existe um limite técnico importante: **cada requisição suporta no máximo 1.000 destinatários**, incluindo cópias.

Isso significa que um segmento com 10.000 clientes não pode ser disparado de uma única vez — o que causaria falha na requisição e perda de envios.

A solução implementada aqui divide o segmento em lotes de 1.000 clientes, enfileira cada lote de forma assíncrona via Redis e processa em background com o Worker do Laravel. O usuário recebe a resposta imediatamente, enquanto os disparos acontecem em segundo plano.

## Como funciona

```
POST /api/campaigns/{id}/dispatch
        ↓
CampaignService busca os clientes do segmento
        ↓
Divide em lotes de 1.000 via chunk()
        ↓
Cada lote vira um Job enfileirado no Redis
        ↓
Worker consome os Jobs e processa os envios
        ↓
Status da campanha atualizado para "processing"
```

## Stack

- **PHP 8.3** + **Laravel 12**
- **MySQL 8** — armazenamento de customers, segmentos e campanhas
- **Redis** — driver de fila para processamento assíncrono
- **PestPHP** — testes automatizados
- **Docker** — ambiente containerizado com Nginx, PHP-FPM, MySQL e Redis

## Arquitetura

O projeto utiliza uma arquitetura **monolito modular**, onde cada domínio é isolado em seu próprio módulo com Service Layer e Repository Pattern.

```
app/Modules/
├── Customer/
│   ├── Models/
│   ├── Repositories/
│   ├── Services/
│   └── Http/
├── Segment/
│   ├── Models/
│   ├── Repositories/
│   ├── Services/
│   └── Http/
└── Campaign/
    ├── Models/
    ├── Repositories/
    ├── Services/
    └── Http/
```

Essa separação permite escalar ou extrair módulos de forma independente, sem impacto nos demais.

## Pré-requisitos

- Docker e Docker Compose instalados

## Como rodar

```bash
# Clone o repositório
git clone https://github.com/gleidistonaraujo18/mailflow-api.git
cd mailflow-api

# Suba os containers
docker compose up -d --build

# Configure o ambiente
cp .env.example .env

# Edite o .env com as variáveis abaixo:
# DB_HOST=mysql
# DB_DATABASE=mailflow_db
# DB_USERNAME=dev
# DB_PASSWORD=dev
# QUEUE_CONNECTION=redis
# REDIS_HOST=redis

# Rode as migrations e seeds
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed --class=CustomerSeeder
docker compose exec app php artisan db:seed --class=SegmentSeeder

# Suba o worker de filas
docker compose exec app php artisan queue:work redis
```

## Endpoints

### Customers
| Método | Rota | Descrição |
|--------|------|-----------|
| GET | `/api/customers` | Lista todos os clientes |
| GET | `/api/customers/{id}` | Busca cliente por ID |
| POST | `/api/customers` | Cria um cliente |
| PUT | `/api/customers/{id}` | Atualiza um cliente |
| DELETE | `/api/customers/{id}` | Remove um cliente |

### Segments
| Método | Rota | Descrição |
|--------|------|-----------|
| GET | `/api/segments` | Lista todos os segmentos |
| POST | `/api/segments` | Cria um segmento |
| PUT | `/api/segments/{id}` | Atualiza um segmento |
| DELETE | `/api/segments/{id}` | Remove um segmento |
| POST | `/api/segments/{id}/customers/{customerId}` | Adiciona cliente ao segmento |
| DELETE | `/api/segments/{id}/customers/{customerId}` | Remove cliente do segmento |

### Campaigns
| Método | Rota | Descrição |
|--------|------|-----------|
| POST | `/api/campaigns` | Cria uma campanha |
| POST | `/api/campaigns/{id}/dispatch` | Dispara a campanha em lotes |

## Testes

```bash
docker compose exec app php artisan test
```

## Decisões técnicas

**Por que monolito modular e não microsserviços?**
Microsserviços adicionam complexidade de infraestrutura que não se justifica no estágio atual do projeto. O monolito modular entrega o isolamento necessário entre domínios e facilita uma futura extração para microsserviços caso o sistema escale.

**Por que Redis e não database como driver de fila?**
O driver `database` salva Jobs em uma tabela MySQL e depende de polling constante. O Redis notifica o worker imediatamente quando uma mensagem chega, sendo muito mais eficiente para alto volume — exatamente o cenário de disparos em lote.

**Por que chunk(1000)?**
Respeitando o limite da SendGrid de 1.000 destinatários por requisição, o `chunk()` garante que nenhum lote exceda esse limite independente do tamanho do segmento.
