# Ondeal - Plataforma de Gestão de Leads

![Status do Projeto](https://img.shields.io/badge/status-Em%20Desenvolvimento-yellow)
![Laravel](https://img.shields.io/badge/Laravel-12.x-red)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue)
![React](https://img.shields.io/badge/React-18.x-cyan)

## Sobre o Projeto

Plataforma SaaS para gestão e comercialização de leads qualificados para corretores de planos de saúde. Desenvolvida com **Laravel** e **React**, oferece marketplace de leads, sistema de CRM e ferramentas de automação.

## Tecnologias

### Backend
- **Laravel 12** - Framework PHP
- **MySQL/PostgreSQL** - Banco de dados
- **Laravel Sanctum** - Autenticação API
- **Bootstrap 5** - Interface web

### Frontend
- **React 18 + TypeScript** - Interface do usuário
- **React Query** - Gerenciamento de estado
- **Zustand** - Estado local
- **Tailwind CSS** - Estilização

## Arquitetura

```
FULL/
├── app/
│   ├── Http/Controllers/     # Controllers Laravel
│   ├── Models/              # Modelos Eloquent
│   ├── Services/            # Lógica de negócio
│   ├── DTOs/               # Data Transfer Objects
│   ├── Enums/              # Constantes de domínio
│   └── Middleware/         # Middlewares de segurança
├── public/kanban/          # Aplicação React
├── resources/views/        # Views Blade
└── routes/                 # Rotas da aplicação
```

### Padrões Arquiteturais
- **DTOs**: Transferência padronizada de dados
- **Services**: Isolamento de regras de negócio
- **Repositories**: Camada de persistência
- **Middlewares**: Segurança e autenticação
- **Enums**: Constantes tipadas

## Configuração de CORS

O sistema possui configuração de CORS para permitir requisições de origens específicas:

### Origens Permitidas
- `http://ondealfull.test` e `https://ondealfull.test`
- `http://localhost` e `https://localhost`
- `http://127.0.0.1` e `https://127.0.0.1`
- URLs do ngrok (via padrão regex)

### Padrões Dinâmicos
```php
'allowed_origins_patterns' => [
    '#^https://.*\.ngrok-free\.app$#',
    '#^https://.*\.ngrok\.io$#',
    '#^https://.*\.ngrok\.app$#',
],
```

**Importante:** Os padrões regex devem sempre ter delimitadores (`#`) e âncoras (`^`, `$`) para funcionamento correto.

### Configuração
As configurações de CORS estão em `config/cors.php`:
- **Métodos permitidos**: Todos (`*`)
- **Headers permitidos**: Todos (`*`)
- **Suporte a credenciais**: Habilitado
- **Paths protegidos**: `api/*`, `sanctum/csrf-cookie`

## Sistema de Usuários e Planos

### Estrutura de Planos (Tabela `brokers`)

O sistema gerencia planos de assinatura diretamente na tabela `brokers` com os seguintes campos:

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `plan_type` | integer | Tipo do plano: 0=BASIC, 1=INDIVIDUAL, 2=TEAMS, 3=ENTERPRISE |
| `is_active` | boolean | Status de pagamento: `true`=ativo/pago, `false`=inativo/inadimplente |
| `subscription_id` | integer | ID do plano na tabela `subscriptions` |
| `subscription_expires_at` | timestamp | Data de expiração da assinatura |

**Enum PlanType:**
```php
enum PlanType: int {
    case BASIC = 0;
    case INDIVIDUAL = 1;
    case TEAMS = 2;
    case ENTERPRISE = 3;
}
```

**Regras de Negócio:**
- ✅ **Assinatura Ativa**: `is_active = true` E `subscription_expires_at` no futuro
- ❌ **Inadimplente**: `is_active = false` (pagamento falhou)
- ❌ **Expirado**: `subscription_expires_at` no passado
- 🆓 **BASIC**: `plan_type = 0` E sem `subscription_id`

### Tipos de Usuários

| Role           | `plan_type` | Descrição                    | Limite de Leads |
|----------------|-------------|------------------------------|----------------|
| **BASIC**      | 0 | Plano básico                 | 100 leads      |
| **INDIVIDUAL** | 1 | Plano individual (R$ 29,90)  | 100 leads      |
| **TEAMS**      | 2 | Plano equipe (R$ 79,90)      | 150 leads      |
| **ENTERPRISE** | 3 | Plano empresarial (R$ 199,90)| 200 leads      |
| **SUPPLIER**   | - | Fornecedor de leads          | Ilimitado      |
| **ADMIN**      | - | Administrador                | Ilimitado      |

### Funcionalidades por Plano

#### Usuário BASIC
- Marketplace de leads
- Base de contatos
- Dashboard básico
- Funil de vendas
- Sem automações
- Sem conexões WhatsApp
- Sem criação de equipes
- Limite de 100 leads

#### Planos Pagos
- Todas as funcionalidades BASIC
- Integrações e automações
- Agenda da secretária
- Relatórios financeiros
- Configurações avançadas
- Suporte prioritário

## Funcionalidades Principais

### Gestão de Leads
- **Tipos suportados**: PF, PJ, Adesão, Mista
- **Sistema de precificação**: Fixo, editável ou depreciação automática
- **Kanban interativo**: Gestão visual do funil de vendas
- **Filtros avançados**: Por período, tipo, automação, localização

### Marketplace
- Compra e venda de leads qualificados
- Histórico de transações
- Avaliação de qualidade

### Automação
- Integração com ferramentas externas
- Webhooks e APIs
- Depreciação automática de preços
- Notificações em tempo real

### Painel de Equipes (Team Panel)
- Gerenciamento de equipes de corretores
- Visualização de equipes criadas
- Controle de membros por equipe
- Transferência de leads entre membros
- Permissões e níveis de acesso

### Histórico de Transações
- Histórico de compras e vendas de leads
- Controle de créditos e gastos
- Estatísticas de leads adquiridos
- Filtros por data e tipo de transação

## Operadoras de Saúde Cadastradas

O sistema possui **14 operadoras de saúde** pré-cadastradas e ativas:

| # | Operadora | Código | Status |
|---|-----------|--------|--------|
| 1 | **Amil** | `amil` | Ativa |
| 2 | **Atitude Saúde** | `atitudesaude` | Ativa |
| 3 | **Aurora Saúde** | `aurorasaude` | Ativa |
| 4 | **Blue** | `blue` | Ativa |
| 5 | **Bradesco Saúde** | `bradescosaude` | Ativa |
| 6 | **CEAM** | `ceam` | Ativa |
| 7 | **CEMERU** | `cemeru` | Ativa |
| 8 | **Hapvida** | `hapvida` | Ativa |
| 9 | **HBC Saúde** | `hbcsaude` | Ativa |
| 10 | **MedSênior** | `medsenior` | Ativa |
| 11 | **Plenum Saúde** | `plenumsaude` | Ativa |
| 12 | **Porto Saúde** | `portosaude` | Ativa |
| 13 | **Sagrada Família** | `sagradafamilia` | Ativa |
| 14 | **SulAmérica** | `sulamerica` | Ativa |


## APIs

### API v1 - Usuários/Brokers

**IMPORTANTE - PADRÃO DE TELEFONES NA API:**
- A API **ACEITA APENAS** telefones com números: `11999887766`, `82998877665`
- A API **REJEITA** telefones formatados: `(11) 99988-7766`, `11 99988-7766`
- Formato obrigatório: 10 ou 11 dígitos numéricos
- Validação: `regex:/^[0-9]+$/` + `min:10` + `max:11`

**Exemplos de Validação:**
```json
ACEITO: "phone": "11999887766"  → Status 201/200
ACEITO: "phone": "1199887766"   → Status 201/200 (10 dígitos)
REJEITADO: "phone": "(11) 99988-7766"  → Status 422 (tem parênteses e hífen)
REJEITADO: "phone": "11 99988-7766"    → Status 422 (tem espaços)
REJEITADO: "phone": "11-99988-7766"    → Status 422 (tem hífen)
REJEITADO: "phone": "119"              → Status 422 (menos de 10 dígitos)
```

```http
# Autenticação via header
apiKey: {ucode_do_usuario}

# Endpoints de Leads
GET    /api/v1/leads                                     # Listar leads
POST   /api/v1/leads                                     # Criar lead
GET    /api/v1/leads/{id}                                # Mostrar lead específico
PUT    /api/v1/leads/{id}                                # Atualizar lead
DELETE /api/v1/leads/{id}                                # Deletar lead

# Buscas de Leads
GET    /api/v1/leads/search/phone?phone={phone}          # Buscar por telefone
GET    /api/v1/leads/search/name?name={name}             # Buscar por nome
GET    /api/v1/leads/search/email?email={email}          # Buscar por email
GET    /api/v1/leads/search/is_automation?is_automation={bool} # Filtrar por automação
GET    /api/v1/leads/step?step={step}                    # Listar por etapa

# Gestão de Leads
PUT    /api/v1/leads/{leadId}/transfer-ownership         # Transferir propriedade
PUT    /api/v1/leads/{leadId}/delegate-responsibility    # Delegar responsabilidade
POST   /api/v1/leads/transfer-bulk                       # Transferência em lote
GET    /api/v1/leads/by-owner                            # Leads por proprietário
GET    /api/v1/leads/by-responsible                      # Leads por responsável

### ⚠️ IMPORTANTE - Tipos de Dados na API de Leads

A API de Leads exige que campos numéricos sejam enviados como **INTEGER**, não como string:

| Campo | Tipo Correto | Tipo Incorreto | Descrição |
|-------|--------------|----------------|-----------|
| `type` | `1` (int) | ❌ `"1"` (string) | Tipo do lead: 1=PF, 2=PJ, 3=Adesão, 4=Mista |
| `step` | `1` (int) | ❌ `"1"` (string) | Etapa do funil (1-8) |
| `lifes` | `2` (int) | ❌ `"2"` (string) | Número de vidas |
| `depreciationPercent` | `10` (int) | ❌ `"10"` (string) | Percentual de depreciação (0-100) |
| `depreciationInterval` | `7` (int) | ❌ `"7"` (string) | Intervalo de depreciação em dias |
| `supplier_id` | `2` (int) | ❌ `"2"` (string) | ID do fornecedor |
| `owner_id` | `1` (int) | ❌ `"1"` (string) | ID do proprietário |
| `responsible_id` | `5` (int) | ❌ `"5"` (string) | ID do broker responsável |

**Conversão Automática:**
A API agora possui conversão automática de strings numéricas para integers. No entanto, é **recomendado** enviar valores numéricos como integers nativos no JSON.

**Exemplos:**

✅ **CORRETO:**
```json
{
  "name": "João Silva",
  "phone": "11999887766",
  "email": "joao@example.com",
  "type": 1,
  "step": 3,
  "lifes": 2,
  "temperature": "hot",
  "source": "Google Ads",
  "startPrice": 150.00
}
```

❌ **ACEITO (mas não recomendado):**
```json
{
  "name": "João Silva",
  "phone": "11999887766",
  "email": "joao@example.com",
  "type": "1",
  "step": "3",
  "lifes": "2",
  "temperature": "hot",
  "source": "Google Ads",
  "startPrice": 150.00
}
```

# Endpoints de Events
GET    /api/v1/events                                    # Listar eventos
GET    /api/v1/events?start_date={data}&end_date={data}  # Listar eventos por período
POST   /api/v1/events                                    # Criar evento
GET    /api/v1/events/{id}                               # Mostrar evento específico
PUT    /api/v1/events/{id}                               # Atualizar evento
DELETE /api/v1/events/{id}                               # Deletar evento
GET    /api/v1/events/upcoming                           # Eventos próximos
GET    /api/v1/events/today                              # Eventos de hoje
PUT    /api/v1/events/{id}/complete                      # Marcar como completo
PUT    /api/v1/events/{id}/cancel                        # Cancelar evento

# Endpoints de Calendar
GET    /api/v1/calendar/week                   # Eventos da semana
GET    /api/v1/calendar/month                  # Eventos do mês
GET    /api/v1/calendar/search                 # Buscar eventos
GET    /api/v1/calendar/available-slots        # Horários disponíveis por data
POST   /api/v1/calendar/bulk                   # Criar eventos em lote

# Endpoints de Contacts
GET    /api/v1/contacts                        # Listar contatos paginados
POST   /api/v1/contacts                        # Criar novo contato
GET    /api/v1/contacts/{id}                   # Visualizar contato específico
PUT    /api/v1/contacts/{id}                   # Atualizar contato
DELETE /api/v1/contacts/{id}                   # Excluir contato
POST   /api/v1/contacts/transfer-leads         # Transferir múltiplos leads para contatos

### ⚠️ IMPORTANTE - Tipos de Dados na API de Contacts

A API de Contacts exige que campos numéricos sejam enviados como **INTEGER**, não como string:

| Campo | Tipo Correto | Tipo Incorreto | Descrição |
|-------|--------------|----------------|-----------|
| `type` | `1` (int) | ❌ `"1"` (string) | Tipo do contato: 1=PF, 2=PJ, 3=Adesão, 4=Mista |
| `step` | `1` (int) | ❌ `"1"` (string) | Etapa do funil (1-8) |
| `lifes` | `2` (int) | ❌ `"2"` (string) | Número de vidas |
| `depreciationPercent` | `10` (int) | ❌ `"10"` (string) | Percentual de depreciação (0-100) |
| `depreciationInterval` | `7` (int) | ❌ `"7"` (string) | Intervalo de depreciação em dias |
| `responsible_id` | `5` (int) | ❌ `"5"` (string) | ID do broker responsável |
| `health_operator_id` | `3` (int) | ❌ `"3"` (string) | ID da operadora de saúde |

**Conversão Automática:**
A API agora possui conversão automática de strings numéricas para integers. No entanto, é **recomendado** enviar valores numéricos como integers nativos no JSON.

**Exemplos:**

✅ **CORRETO:**
```json
{
  "name": "João Silva",
  "email": "joao@example.com",
  "type": 1,
  "step": 3,
  "lifes": 2
}
```

❌ **ACEITO (mas não recomendado):**
```json
{
  "name": "João Silva",
  "email": "joao@example.com",
  "type": "1",
  "step": "3",
  "lifes": "2"
}
```

### Transferência de Leads para Contatos

Quando leads são transferidos para a base de contatos via API, o sistema executa as seguintes ações:

**Fluxo de Transferência:**
1. ✅ Valida permissões do usuário
2. ✅ Verifica se já existe contato com o mesmo email
3. ✅ Cria novo registro na tabela `contacts`
4. ✅ Atualiza status do lead para `sold`
5. ✅ **Deleta o lead da tabela `leads`**

**Importante:** Após a transferência bem-sucedida, o lead é **permanentemente removido** da tabela de leads. Os dados são preservados na tabela de contatos.

**Exemplo de Uso:**
```bash
POST /api/v1/contacts/transfer-leads
Headers: apiKey: {seu_ucode}
Body:
{
  "lead_ids": [1, 2, 3],
  "reason": "Cliente fechou contrato"
}
```

**Resposta:**
```json
{
  "success": true,
  "message": "Transferência de leads concluída!",
  "data": {
    "transferred_count": 3,
    "failed_count": 0,
    "contacts": [...],
    "errors": []
  }
}
```

# Endpoints de Lead Automation
GET    /api/v1/automations                               # Listar todas as automações
POST   /api/v1/automations                               # Criar nova automação
GET    /api/v1/automations/{id}                          # Visualizar automação específica
PUT    /api/v1/automations/{id}                          # Atualizar automação
DELETE /api/v1/automations/{id}                          # Deletar automação
GET    /api/v1/automations/lead/{leadId}                 # Buscar automação por lead ID
GET    /api/v1/automations/search/phone?phone={phone}    # Buscar por telefone do lead
GET    /api/v1/automations/search/name?name={name}       # Buscar por nome do lead
GET    /api/v1/automations/status?status={status}        # Filtrar por status
GET    /api/v1/automations/renewals/upcoming?days=30     # Renovações próximas
GET    /api/v1/automations/payments/upcoming?days=7      # Pagamentos próximos
GET    /api/v1/automations/birthdays/month?month=12      # Aniversários do mês
GET    /api/v1/automations/contacts/due                  # Contatos periódicos pendentes
```

### API v2 - Suppliers
```http
# Autenticação via header
apiKey: {supplier_api_key}

# Endpoints principais
POST /api/v2/supplier/leads    # Criar lead
GET  /api/v2/supplier/leads    # Listar leads
```

### API v3 - Administração

**IMPORTANTE - ACESSO ADMINISTRATIVO:**
- API de **acesso restrito** para administração do sistema
- **Apenas operações de leitura** (GET) são permitidas
- Autenticação via **Bearer Token** configurado em `ADMIN_API_TOKEN`
- Todas as operações de escrita (POST, PUT, DELETE) são **bloqueadas**

**📋 OS 4 TIPOS DE USUÁRIO DO SISTEMA:**

Todo usuário do sistema possui um dos 4 tipos de plano:

| Tipo | `plan_type` | Paga Mensalidade? | Descrição |
|------|-------------|-------------------|-----------|
| **BASIC** | `basic` | ❌ Não | Plano básico (padrão do sistema) |
| **INDIVIDUAL** | `individual` | ✅ Sim | Plano Individual - R$ 29,90/mês |
| **TEAMS** | `teams` | ✅ Sim | Plano por Equipe - R$ 79,90/mês |
| **ENTERPRISE** | `enterprise` | ✅ Sim | Plano Empresarial - R$ 199,90/mês |

**Regras:**
- ✅ Usuário **BASIC**: Não tem `subscription_id` ou assinatura expirada
- ✅ Usuário **PAGO** (Individual/Teams/Enterprise): Tem assinatura ativa (`subscription_expires_at` > hoje)
- ✅ Campo `plan_type` retorna automaticamente o tipo correto do usuário
- ✅ Se a assinatura expirar, o usuário volta a ser **BASIC** automaticamente

```http
# Autenticação via header
Authorization: Bearer {ADMIN_API_TOKEN}

# Endpoints de Usuários
GET /api/v3/admin/users              # Listar usuários
GET /api/v3/admin/users/stats        # Estatísticas de usuários
GET /api/v3/admin/users/{user}       # Detalhes de usuário específico
```

#### Configuração de Ambiente

```env
# Token de autenticação administrativa (obrigatório)
ADMIN_API_TOKEN=seu_token_secreto_aqui
```

**Características de Segurança:**
- Apenas operações **GET** são permitidas
- Operações de escrita são bloqueadas (retorna erro 405)
- Token deve ser configurado no `.env`
- Registra tentativas de acesso inválidas nos logs
- Rate limiting: 60 requisições por minuto

#### 1. Listar Usuários

```http
GET /api/v3/admin/users
Headers:
- Authorization: Bearer {ADMIN_API_TOKEN}
- Accept: application/json
```

**Parâmetros de Busca:**

| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| `search` | string | Busca global em name, email, phone e ucode |
| `name` | string | Filtro por nome (busca parcial) |
| `email` | string | Filtro por email (busca parcial) |
| `phone` | string | Filtro por telefone (busca parcial) |
| `ucode` | string | Filtro por código único do usuário |
| `status` | string | `active` (email verificado) ou `inactive` (email não verificado) |
| `plan_type` | string | Tipo de plano: `free`, `individual`, `teams`, `enterprise` |
| `has_subscription` | boolean | `true` (com assinatura ativa) ou `false` (sem assinatura) |
| `subscription_id` | integer | Filtrar por ID de plano específico |
| `subscription_status` | string | `active`, `expired` ou `never_subscribed` |
| `expires_before` | date | Assinaturas que expiram antes desta data (Y-m-d) |
| `expires_after` | date | Assinaturas que expiram depois desta data (Y-m-d) |
| `per_page` | integer | Itens por página (padrão: 15, máx: 100) |

**Resposta de Sucesso:**
```json
[
  {
    "name": "João Silva",
    "email": "joao@exemplo.com",
    "phone": "11999887766",
    "ucode": "m4N7b0V3c6X9z2A5y8K1j4H",
    "created_at": "2024-01-15T10:30:00.000000Z",
    "is_verified": true,
    "plan_type": "individual",
    "broker": {
      "id": 1,
      "user_id": 1,
      "subscription_id": 2,
      "subscription_expires_at": "2025-12-15T10:30:00.000000Z",
      "has_active_subscription": true,
      "created_at": "2024-01-15T10:30:00.000000Z",
      "updated_at": "2024-10-10T14:30:00.000000Z",
      "subscription": {
        "id": 2,
        "name": "Plano Individual",
        "description": "Plano básico para corretores individuais",
        "price": 29.90,
        "plan_type": "individual",
        "duration_days": 30,
        "is_active": true,
        "features": ["100 leads", "Dashboard básico", "Suporte email"],
        "max_team_members": 1,
        "has_team_access": false,
        "has_enterprise_access": false,
        "stripe_product_id": "prod_individual",
        "stripe_price_id": "price_individual",
        "last_synced_at": "2024-10-10T14:30:00.000000Z",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-10-10T14:30:00.000000Z"
      }
    },
    "supplier": null
  }
]
```

**Exemplos de Uso:**
```bash
# Listar todos os usuários verificados
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?status=active"

# Buscar por email
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?email=joao@exemplo.com"

# Buscar por telefone
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?phone=11999887766"

# Busca global
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?search=João"

# Filtrar apenas usuários BASIC (sem assinatura)
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?plan_type=basic"

# Filtrar apenas usuários com Plano Individual
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?plan_type=individual"

# Filtrar apenas usuários com Plano Teams
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?plan_type=teams"

# Filtrar apenas usuários com Plano Enterprise
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?plan_type=enterprise"

# Filtrar usuários COM assinatura ativa
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?has_subscription=true"

# Filtrar usuários SEM assinatura ativa
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?has_subscription=false"

# Filtrar por ID de plano específico (ex: ID 1)
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?subscription_id=1"

# Filtrar assinaturas ATIVAS
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?subscription_status=active"

# Filtrar assinaturas EXPIRADAS
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?subscription_status=expired"

# Filtrar usuários que NUNCA assinaram
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?subscription_status=never_subscribed"

# Assinaturas que expiram antes de 2025-12-31
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?expires_before=2025-12-31"

# Assinaturas que expiram depois de 2025-01-01
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?expires_after=2025-01-01"

# Combinar múltiplos filtros: Plano Teams que expira em 30 dias
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?plan_type=teams&expires_before=2025-11-10"

# Com paginação personalizada
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users?per_page=50"
```

#### 2. Estatísticas de Usuários

```http
GET /api/v3/admin/users/stats
Headers:
- Authorization: Bearer {ADMIN_API_TOKEN}
- Accept: application/json
```

**Resposta de Sucesso:**
```json
{
  "total_users": 150,
  "verified_users": 120,
  "unverified_users": 30,
  "verification_rate": 80.00,
  "recent_users_30_days": 25,
  "brokers_count": 85,
  "suppliers_count": 15,
  "generated_at": "2024-10-10T14:30:00.000Z"
}
```

**Campos Retornados:**

| Campo | Tipo | Descrição |
|-------|------|-----------|
| `total_users` | integer | Total de usuários cadastrados |
| `verified_users` | integer | Usuários com email verificado |
| `unverified_users` | integer | Usuários sem verificação de email |
| `verification_rate` | float | Taxa de verificação em % |
| `recent_users_30_days` | integer | Novos usuários nos últimos 30 dias |
| `brokers_count` | integer | Total de corretores (brokers) |
| `suppliers_count` | integer | Total de fornecedores (suppliers) |
| `generated_at` | datetime | Data/hora de geração das estatísticas |

**Exemplo de Uso:**
```bash
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users/stats"
```

#### 3. Detalhes de Usuário Específico

```http
GET /api/v3/admin/users/{user}
Headers:
- Authorization: Bearer {ADMIN_API_TOKEN}
- Accept: application/json
```

**Resposta de Sucesso:**
```json
{
  "name": "João Silva",
  "email": "joao@exemplo.com",
  "phone": "11999887766",
  "ucode": "m4N7b0V3c6X9z2A5y8K1j4H",
  "created_at": "2024-01-15T10:30:00.000000Z",
  "is_verified": true,
        "plan_type": "individual",
  "broker": {
    "id": 1,
    "user_id": 1,
    "subscription_id": 2,
    "subscription_expires_at": "2025-12-15T10:30:00.000000Z",
    "has_active_subscription": true,
    "created_at": "2024-01-15T10:30:00.000000Z",
    "updated_at": "2024-10-10T14:30:00.000000Z",
    "subscription": {
      "id": 2,
      "name": "Plano Individual",
      "description": "Plano básico para corretores individuais",
      "price": 29.90,
      "plan_type": "individual",
      "duration_days": 30,
      "is_active": true,
      "features": ["100 leads", "Dashboard básico", "Suporte email"],
      "max_team_members": 1,
      "has_team_access": false,
      "has_enterprise_access": false,
      "stripe_product_id": "prod_individual_basic",
      "stripe_price_id": "price_individual_basic",
      "last_synced_at": "2024-10-10T14:30:00.000000Z",
      "created_at": "2024-01-01T00:00:00.000000Z",
      "updated_at": "2024-10-10T14:30:00.000000Z"
    }
  },
  "supplier": null
}
```

**Campos dos Relacionamentos:**

**Broker (se usuário for corretor):**
- `id`: ID do broker
- `user_id`: ID do usuário relacionado
- `subscription_id`: ID do plano ativo
- `subscription_expires_at`: Data de expiração da assinatura
- `has_active_subscription`: Se a assinatura está ativa (não expirada)
- `created_at`: Data de criação do broker
- `updated_at`: Data de última atualização
- `subscription`: Objeto com detalhes do plano (veja abaixo)

**Subscription (dados do plano):**
- `id`: ID do plano
- `name`: Nome do plano (ex: "Plano Individual")
- `description`: Descrição do plano
- `price`: Preço mensal em R$
- `plan_type`: Tipo do plano (`individual`, `teams`, `enterprise`)
- `duration_days`: Duração em dias (geralmente 30)
- `is_active`: Se o plano está ativo para novas assinaturas
- `features`: Array JSON com funcionalidades do plano
- `max_team_members`: Número máximo de membros da equipe
- `has_team_access`: Se tem acesso ao painel de equipe
- `has_enterprise_access`: Se tem acesso ao painel enterprise
- `stripe_product_id`: ID do produto no Stripe
- `stripe_price_id`: ID do preço no Stripe
- `last_synced_at`: Data da última sincronização com Stripe
- `created_at`: Data de criação do plano
- `updated_at`: Data de última atualização

**Supplier (se usuário for fornecedor):**
- `name`: Nome do fornecedor
- `cnpj`: CNPJ da empresa
- `status`: Status do fornecedor (`active`, `inactive`, `pending`)

**Exemplo de Uso:**
```bash
curl -H "Authorization: Bearer {ADMIN_API_TOKEN}" \
     "https://ondeal.test/api/v3/admin/users/123"
```

#### Casos de Uso da API v3

| Caso de Uso | Endpoint | Descrição |
|-------------|----------|-----------|
| **Monitoramento de Usuários** | `GET /users` | Visualizar todos os usuários cadastrados |
| **Auditoria** | `GET /users?search={termo}` | Rastrear usuários por email, telefone ou código |
| **Métricas de Crescimento** | `GET /users/stats` | Acompanhar taxa de verificação e crescimento |
| **Análise de Perfis** | `GET /users/stats` | Distribuição entre brokers e suppliers |
| **Suporte ao Cliente** | `GET /users/{id}` | Buscar informações detalhadas para suporte |
| **Validação de Contas** | `GET /users?status=inactive` | Identificar usuários não verificados |

#### Respostas de Erro

**401 Unauthorized - Token não fornecido**
```json
{
  "error": "Admin token not provided",
  "message": "Authorization header with admin token is required"
}
```

**401 Unauthorized - Token inválido**
```json
{
  "error": "Invalid admin token",
  "message": "The provided admin token is invalid"
}
```

**405 Method Not Allowed - Tentativa de escrita**
```json
{
  "error": "Method not allowed",
  "message": "Admin API only supports GET operations"
}
```

**500 Internal Server Error - Token não configurado**
```json
{
  "error": "Server configuration error",
  "message": "Admin API token not configured"
}
```

### Buscas de Leads API v1

O sistema oferece múltiplas formas de localizar leads do usuário autenticado:

| Tipo de Busca | Endpoint | Descrição |
|---------------|----------|-----------|
| **Por Telefone** | `GET /api/v1/leads/search/phone?phone={phone}` | Busca por telefone (apenas números, sem formatação) |
| **Por Nome** | `GET /api/v1/leads/search/name?name={name}` | Busca por nome ou razão social |
| **Por Email** | `GET /api/v1/leads/search/email?email={email}` | Busca por email |
| **Por Etapa** | `GET /api/v1/leads/step?step={step}` | Lista todos os leads de uma etapa específica |
| **Por Is Automation** | `GET /api/v1/leads/search/is_automation?is_automation={true/false}` | Filtra leads automáticos ou não-automáticos |

**Características importantes:**
- Todas as buscas retornam APENAS os leads do usuário autenticado (broker)
- Busca por telefone aceita busca parcial (ex: `82` retorna todos do DDD 82)
- Busca por nome busca em `name` e `corporateName`
- Busca por email aceita busca parcial
- Busca por is_automation aceita: `true`, `false`, `1`, `0`
- Todas as buscas incluem relacionamentos: broker, responsible, healthOperator, automation

**Exemplos de Uso:**

```bash
# Buscar por telefone completo
GET /api/v1/leads/search/phone?phone=11999887766
Headers: apiKey: seu_ucode_aqui

# Buscar por DDD
GET /api/v1/leads/search/phone?phone=82
Headers: apiKey: seu_ucode_aqui

# Buscar por nome
GET /api/v1/leads/search/name?name=João
Headers: apiKey: seu_ucode_aqui

# Buscar por email
GET /api/v1/leads/search/email?email=joao@email.com
Headers: apiKey: seu_ucode_aqui

# Listar leads da etapa 1
GET /api/v1/leads/step?step=1
Headers: apiKey: seu_ucode_aqui

# Listar leads da etapa 5
GET /api/v1/leads/step?step=5
Headers: apiKey: seu_ucode_aqui

# Listar apenas leads automáticos
GET /api/v1/leads/search/is_automation?is_automation=true
Headers: apiKey: seu_ucode_aqui

# Listar apenas leads não-automáticos
GET /api/v1/leads/search/is_automation?is_automation=false
Headers: apiKey: seu_ucode_aqui
```

**Resposta de Sucesso (Busca por Step):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "João Silva",
      "phone": "11999887766",
      "email": "joao@email.com",
      "step": 5,
      "status": "in_progress",
      "temperature": "hot",
      "broker": { ... },
      "responsible": { ... },
      "automation": { ... }
    }
  ],
  "meta": {
    "step": 5,
    "total": 15
  }
}
```

**Resposta de Sucesso (Busca por Is Automation):**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Lead Automático",
      "isAutomation": true,
      ...
    }
  ],
  "meta": {
    "is_automation": true,
    "total": 6
  }
}
```

**Resposta de Erro (Parâmetro ausente):**
```json
{
  "error": "Missing parameter",
  "message": "O parâmetro \"phone\" é obrigatório."
}
```

### Exemplo de Uso

#### Criar Lead - Body Completo
```javascript
// Criar lead com todos os campos disponíveis
const response = await fetch('/api/v1/leads', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'apiKey': 'seu_ucode_aqui'
  },
  body: JSON.stringify({
    name: 'João Silva',
    corporateName: 'Empresa LTDA',
    phone: '21999999999',
    email: 'joao@email.com',
    cpf: '123.456.789-00',
    cnpj: '12.345.678/0001-90',
    city: 'Rio de Janeiro',
    state: 'RJ',
    type: 'PF',
    status: 'novo',
    temperature: 'hot',
    traking: 'TRK001',
    source: 'Google Ads',
    code: 'LEAD001',
    isAutomation: true,
    lives: 2,
    acceptContestation: true,
    description: 'Lead qualificado para plano individual',
    startPrice: 150.00,
    currentPrice: 150.00,
    negotiatedPrice: 120.00,
    pricingType: 'editable',
    depreciationPercent: 10,
    depreciationInterval: 7,
    lead_expires_at: '2024-12-31 23:59:59',
    acquired_at: '2024-01-15 10:30:00',
    step: 1,
    responsible_id: 5,
    owner_id: 1,
    owner_type: 'App\\Models\\Broker'
  })
});
```

#### Exemplo Mínimo
```javascript
// Criar lead com campos mínimos
const response = await fetch('/api/v1/leads', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'apiKey': 'seu_ucode_aqui'
  },
  body: JSON.stringify({
    name: 'João Silva',
    phone: '21999999999',
    email: 'joao@email.com',
    type: 'PF',
    city: 'Rio de Janeiro',
    state: 'RJ',
    source: 'Google Ads',
    temperature: 'hot',
    traking: 'TRK002',
    startPrice: 150.00
  })
});
```

#### Campos Disponíveis

| Campo | Tipo | Obrigatório | Descrição |
|-------|------|-------------|-----------|
| `name` | string | Não | Nome do lead |
| `corporateName` | string | Não | Razão social (para PJ) |
| `phone` | string | Não | Telefone de contato (apenas números: 10-11 dígitos) |
| `email` | email | Não | Email de contato |
| `cpf` | string | Não | CPF do lead |
| `cnpj` | string | Não | CNPJ do lead |
| `city` | string | Não | Cidade |
| `state` | string | Não | Estado (UF) |
| `type` | string | Não | Tipo: PF, PJ, ADESAO |
| `status` | string | Não | Status do lead |
| `temperature` | string | Não | Temperatura: hot, warm, cold |
| `traking` | string | Não | Código de rastreamento |
| `source` | string | Não | Origem do lead |
| `code` | string | Não | Código personalizado |
| `isAutomation` | boolean | Não | Se é automação |
| `lifes` | integer | Não | Número de vidas |
| `acceptContestation` | boolean | Não | Aceita contestação |
| `description` | string | Não | Descrição do lead |
| `startPrice` | decimal | Não | Preço inicial |
| `currentPrice` | decimal | Não | Preço atual |
| `negotiatedPrice` | decimal | Não | Preço negociado |
| `pricingType` | string | Não | Tipo: fixed, editable, automatic |
| `depreciationPercent` | integer | Não | % de depreciação (0-100) |
| `depreciationInterval` | integer | Não | Intervalo de depreciação (dias) |
| `lead_expires_at` | datetime | Não | Data de expiração |
| `acquired_at` | datetime | Não | Data de aquisição |
| `step` | integer | Não | Etapa do funil (1-8) |
| `responsible_id` | integer | Não | ID do broker responsável |
| `owner_id` | integer | Não | ID do proprietário |
| `owner_type` | string | Não | Tipo do proprietário |

#### Exemplo de Resposta da API

```json
{
  "success": true,
  "message": "Lead created successfully!",
  "data": {
    "id": 1,
    "code": "LEAD-001",
    "name": "João Silva",
    "corporateName": null,
    "phone": "21999999999",
    "email": "joao@email.com",
    "cpf": "123.456.789-00",
    "cnpj": null,
    "city": "Rio de Janeiro",
    "state": "RJ",
    "type": "PF",
    "type_label": "Pessoa Física",
    "status": "available",
    "status_label": "disponível",
    "temperature": "hot",
    "temperature_label": "Quente",
    "traking": "TRK001",
    "source": "Google Ads",
    "isAutomation": true,
    "lifes": 2,
    "acceptContestation": true,
    "description": "Lead qualificado para plano individual",
    "startPrice": 150.00,
    "currentPrice": 150.00,
    "negotiatedPrice": 120.00,
    "pricingType": "editable",
    "pricingType_label": "Editável",
    "depreciationPercent": 10,
    "depreciationInterval": 7,
    "step": 1,
    "lead_expires_at": "2024-12-31 23:59:59",
    "acquired_at": "2024-01-15 10:30:00",
    "created_at": "2024-01-15 10:30:00",
    "updated_at": "2024-01-15 10:30:00",
    "supplier": {
      "id": 1,
      "name": "Fornecedor Exemplo"
    },
    "broker": {
      "id": 1,
      "user": {
        "name": "Corretor Exemplo",
        "email": "corretor@exemplo.com",
        "ucode": "78as6d798sa6d32f2g",
        "phone": "11999990001"
      }
    }
  }
}
```

## Documentação Detalhada - Lead Automation

A funcionalidade de **Lead Automation** permite gerenciar dados de automação associados a leads, como datas importantes, status de assistência, contatos periódicos e muito mais.

### Funcionalidades de Busca

O sistema oferece múltiplas formas de localizar automações:

| Tipo de Busca | Endpoint | Descrição |
|---------------|----------|-----------|
| **Por Lead ID** | `GET /api/v1/automations/lead/{leadId}` | Busca automação de um lead específico |
| **Por Telefone** | `GET /api/v1/automations/search/phone?phone={phone}` | Busca por telefone do lead (apenas números, sem formatação) |
| **Por Nome** | `GET /api/v1/automations/search/name?name={name}` | Busca por nome ou razão social do lead |
| **Por Status** | `GET /api/v1/automations/status?status={status}` | Filtra por status de assistência |

**Benefícios:**
- Todas as buscas retornam os dados completos do lead relacionado
- Buscas inteligentes com suporte a texto parcial
- Limpeza automática de formatação em telefones
- Performance otimizada com índices de banco de dados

**Quick Reference:**
```bash
# Buscar por telefone (APENAS números)
GET /api/v1/automations/search/phone?phone=11999887766
GET /api/v1/automations/search/phone?phone=82

# Buscar por nome (busca em name e corporateName)
GET /api/v1/automations/search/name?name=João
GET /api/v1/automations/search/name?name=Empresa

# Buscar por lead ID específico
GET /api/v1/automations/lead/123
```

### Criar Automação para Lead

```javascript
const response = await fetch('/api/v1/automations', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'apiKey': 'seu_ucode_aqui'
  },
  body: JSON.stringify({
    lead_id: 1,
    assist_status: 'active',
    assist_substatus: 'awaiting_documents',
    estimated_payment: '2025-11-15',
    billetdue_date: '2025-11-10',
    renewal_date: '2026-01-15',
    selected_menu: 2,
    current_state: 'negotiation',
    birthday: '1985-05-20',
    wedding: '2010-12-15',
    company_niver: '2005-03-10',
    holidays: 'Christmas, New Year',
    important_updates: 'Contract sent to client',
    periodic_contact: '2025-11-01'
  })
});
```

### Campos Disponíveis - Lead Automation

| Campo | Tipo | Obrigatório | Descrição |
|-------|------|-------------|-----------|
| `lead_id` | integer | ✅ Sim | ID do lead associado |
| `assist_status` | string | Não | Status da assistência (ex: active, pending, completed) |
| `assist_substatus` | string | Não | Subestatus da assistência |
| `estimated_payment` | date | Não | Data estimada de pagamento |
| `billetdue_date` | date | Não | Data de vencimento do boleto |
| `renewal_date` | date | ✅ **Sim** | **Data de renovação do contrato (OBRIGATÓRIO)** |
| `selected_menu` | integer | Não | Menu selecionado (1-5) |
| `current_state` | string | Não | Estado atual do processo |
| `birthday` | date | Não | Data de aniversário |
| `wedding` | date | Não | Data de casamento |
| `company_niver` | date | Não | Data de aniversário da empresa |
| `holidays` | string | Não | Feriados importantes |
| `important_updates` | string | Não | Atualizações importantes |
| `periodic_contact` | date | Não | Data do próximo contato periódico |

### ⚠️ Regras Importantes - Campo `renewal_date`

O campo `renewal_date` é **OBRIGATÓRIO** e possui validações específicas:

| Regra | Descrição |
|-------|-----------|
| **Obrigatório** | Campo não pode ser NULL na criação e atualização |
| **Tipo** | TIMESTAMP no banco, DATE na API |
| **Validação** | Deve ser uma data **futura** (após hoje) |
| **Formato** | `Y-m-d` ou `Y-m-d H:i:s` |
| **Uso** | Utilizado pelo endpoint `/api/v1/automations/renewals/upcoming` |

**Exemplos de validação:**
```json
✅ ACEITO: "renewal_date": "2026-01-15"
✅ ACEITO: "renewal_date": "2026-01-15 00:00:00"
❌ REJEITADO: "renewal_date": null (Campo obrigatório)
❌ REJEITADO: "renewal_date": "2024-01-15" (Data no passado)
❌ REJEITADO: "renewal_date": "" (Campo vazio)
```

**Mensagens de erro:**
```json
{
  "errors": {
    "renewal_date": [
      "A data de renovação é obrigatória.",
      "A data de renovação deve ser posterior a hoje."
    ]
  }
}
```

### Exemplos de Uso

#### Buscar Automação por Lead
```javascript
const response = await fetch('/api/v1/automations/lead/1', {
  headers: {
    'apiKey': 'seu_ucode_aqui',
    'Accept': 'application/json'
  }
});
```

#### Buscar Renovações Próximas

**Endpoint:** `GET /api/v1/automations/renewals/upcoming?days={dias}`

**Descrição:** Retorna todas as automações de leads cujo `renewal_date` está entre HOJE e HOJE + X dias.

**Parâmetros:**
- `days` (opcional): Número de dias para buscar renovações futuras (padrão: 30)

**Campo de referência:** `renewal_date` (TIMESTAMP, obrigatório)

**Exemplo de uso:**
```javascript
// Buscar renovações nos próximos 30 dias
const response = await fetch('/api/v1/automations/renewals/upcoming?days=30', {
  headers: {
    'apiKey': 'seu_ucode_aqui',
    'Accept': 'application/json'
  }
});

// Buscar renovações nos próximos 100 dias
const response = await fetch('/api/v1/automations/renewals/upcoming?days=100', {
  headers: {
    'apiKey': 'seu_ucode_aqui',
    'Accept': 'application/json'
  }
});

// Buscar renovações do próximo ano
const response = await fetch('/api/v1/automations/renewals/upcoming?days=365', {
  headers: {
    'apiKey': 'seu_ucode_aqui',
    'Accept': 'application/json'
  }
});
```

**Como funciona:**
1. Busca automações onde `renewal_date` NÃO é NULL
2. Filtra registros onde `renewal_date` está entre **hoje** e **hoje + X dias**
3. Retorna apenas leads do broker autenticado
4. Ordena por `renewal_date` crescente (mais próximos primeiro)

**Resposta de sucesso:**
```json
{
  "success": true,
  "data": [
    {
      "id": 3,
      "lead_id": 153,
      "renewal_date": "2026-06-11 19:49:31",
      "assist_status": "paused",
      "assist_substatus": "approved",
      "lead": {
        "id": 153,
        "name": "Balestero-Escobar",
        "email": "eleal@example.com",
        "phone": "80590222619"
      }
    }
  ]
}
```

**Teste via cURL:**
```bash
curl -k -X GET "https://seu-dominio.com/api/v1/automations/renewals/upcoming?days=100" \
  -H "apiKey: aB3cD4eF5gH6iJ7kL8mN9oP" \
  -H "Accept: application/json"
```

#### Buscar Pagamentos Próximos (próximos 7 dias)
```javascript
const response = await fetch('/api/v1/automations/payments/upcoming?days=7', {
  headers: {
    'apiKey': 'seu_ucode_aqui',
    'Accept': 'application/json'
  }
});
```

#### Buscar Aniversários do Mês
```javascript
const response = await fetch('/api/v1/automations/birthdays/month?month=12&year=2025', {
  headers: {
    'apiKey': 'seu_ucode_aqui',
    'Accept': 'application/json'
  }
});
```

#### Buscar Contatos Periódicos Pendentes
```javascript
const response = await fetch('/api/v1/automations/contacts/due', {
  headers: {
    'apiKey': 'seu_ucode_aqui',
    'Accept': 'application/json'
  }
});
```

#### Buscar por Telefone do Lead
```javascript
// Recomendado: enviar telefone SEM formatação
const response = await fetch('/api/v1/automations/search/phone?phone=11999887766', {
  headers: {
    'apiKey': 'seu_ucode_aqui',
    'Accept': 'application/json'
  }
});

// OU buscar apenas por DDD
const response2 = await fetch('/api/v1/automations/search/phone?phone=11', {
  headers: {
    'apiKey': 'seu_ucode_aqui',
    'Accept': 'application/json'
  }
});
```

**Características da busca por telefone:**
- **OBRIGATÓRIO:** Envie o telefone **APENAS COM NÚMEROS**: `11999887766`
- Aceita busca parcial: `11`, `82`, `999` encontram todos os telefones que contenham esses números
- A API **REJEITA** telefones com formatação: `(11) 99988-7766` retorna erro 422
- Formato aceito: 10 ou 11 dígitos numéricos (ex: `1199887766` ou `11999887766`)

**Exemplos práticos:**
```bash
# CORRETO - Telefone apenas com números
curl -H "apiKey: seu_ucode" "https://ondealfull.test/api/v1/automations/search/phone?phone=11999887766"

# CORRETO - Busca parcial por DDD
curl -H "apiKey: seu_ucode" "https://ondealfull.test/api/v1/automations/search/phone?phone=82"

# INCORRETO - API rejeita formatação
curl -H "apiKey: seu_ucode" "https://ondealfull.test/api/v1/automations/search/phone?phone=(11)99988-7766"
```

#### Buscar por Nome do Lead
```javascript
const response = await fetch('/api/v1/automations/search/name?name=João', {
  headers: {
    'apiKey': 'seu_ucode_aqui',
    'Accept': 'application/json'
  }
});
```

**Características da busca por nome:**
- Busca no campo `name` (nome pessoal do lead)
- Busca no campo `corporateName` (razão social/nome empresarial)
- Busca parcial com `LIKE` para encontrar correspondências aproximadas


### Exemplo de Resposta - Sucesso

```json
{
  "data": {
    "id": 1,
    "lead_id": 1,
    "lead": {
      "id": 1,
      "name": "João Silva",
      "email": "joao@email.com",
      "phone": "(21) 99999-9999"
    },
    "assist_status": "active",
    "assist_substatus": "awaiting_documents",
    "estimated_payment": "2025-11-15 00:00:00",
    "billetdue_date": "2025-11-10 00:00:00",
    "renewal_date": "2026-01-15 00:00:00",
    "selected_menu": 2,
    "current_state": "negotiation",
    "birthday": "1985-05-20",
    "wedding": "2010-12-15",
    "company_niver": "2005-03-10",
    "holidays": "Christmas, New Year",
    "important_updates": "Contract sent to client",
    "periodic_contact": "2025-11-01 00:00:00",
    "created_at": "2025-10-10 12:00:00",
    "updated_at": "2025-10-10 12:00:00"
  }
}
```

### Respostas de Erro

#### Parâmetro Obrigatório Ausente (400 Bad Request)
```json
{
  "message": "O parâmetro \"phone\" é obrigatório."
}
```

#### Nenhum Resultado Encontrado (200 OK)
```json
{
  "data": []
}
```

#### Automação Não Encontrada (404 Not Found)
```json
{
  "message": "Nenhuma automação encontrada para este lead."
}
```

## Documentação Detalhada - Calendário

### Códigos de Status HTTP e Formato de Erros

A API v1 utiliza códigos de status HTTP padronizados e retorna erros em formato JSON estruturado:

#### Códigos de Status

| Status | Código | Descrição |
|--------|--------|-----------|
| ✅ Sucesso | `200` | Requisição processada com sucesso |
| ✅ Criado | `201` | Recurso criado com sucesso |
| ❌ Validação | `422` | Dados inválidos ou faltando parâmetros obrigatórios |
| ❌ Não Autorizado | `401` | API Key inválida ou ausente |
| ❌ Proibido | `403` | Usuário sem permissão para acessar o recurso |
| ❌ Não Encontrado | `404` | Recurso não encontrado |
| ❌ Erro Servidor | `500` | Erro interno do servidor |

#### Formato Padrão de Respostas de Erro

**Erro de Validação (422):**
```json
{
  "success": false,
  "error": "Validation Error",
  "message": "The given data was invalid.",
  "errors": {
    "campo": ["Descrição do erro específico do campo"]
  }
}
```

**Erro de Permissão (403):**
```json
{
  "success": false,
  "error": "Forbidden",
  "message": "This user does not have permission to access events"
}
```

**Erro do Servidor (500):**
```json
{
  "success": false,
  "error": "Server Error",
  "message": "Descrição detalhada do erro"
}
```

### Endpoints de Eventos

#### Listar Eventos por Período
```http
GET /api/v1/events?start_date=2024-01-15&end_date=2024-01-15
Headers:
- apiKey: {ucode_do_usuario}
- Accept: application/json
```

**Parâmetros:**
- `start_date` (opcional): Data de início no formato `Y-m-d`
- `end_date` (opcional): Data de fim no formato `Y-m-d`
- `status` (opcional): Filtrar por status (`scheduled`, `completed`, `cancelled`)
- `type` (opcional): Filtrar por tipo (`appointment`, `meeting`, `reminder`, `task`, `personal`)
- `per_page` (opcional): Itens por página (padrão: 15)
- `page` (opcional): Página atual (padrão: 1)

**Resposta:**
```json
{
  "success": true,
  "data": {
    "events": [
      {
        "id": 1,
        "title": "Reunião com Cliente",
        "description": "Discussão sobre plano de saúde",
        "start_date": "2024-01-15T14:00:00.000000Z",
        "end_date": "2024-01-15T15:00:00.000000Z",
        "all_day": false,
        "color": "#3788d8",
        "status": "scheduled",
        "type": "meeting",
        "location": "Escritório",
        "attendees": null,
        "metadata": null,
        "created_at": "2024-01-15T10:30:00.000000Z",
        "updated_at": "2024-01-15T10:30:00.000000Z"
      }
    ],
    "pagination": {
      "current_page": 1,
      "last_page": 1,
      "per_page": 15,
      "total": 1,
      "from": 1,
      "to": 1
    }
  }
}
```

**Exemplos de uso:**
```bash
# Eventos de uma data específica
GET /api/v1/events?start_date=2024-01-15&end_date=2024-01-15

# Eventos de uma semana
GET /api/v1/events?start_date=2024-01-15&end_date=2024-01-21

# Eventos pendentes de uma data
GET /api/v1/events?start_date=2024-01-15&end_date=2024-01-15&status=scheduled

# Eventos de reunião de um período
GET /api/v1/events?start_date=2024-01-01&end_date=2024-01-31&type=meeting
```

#### Listar Eventos de Hoje
```http
GET /api/v1/events/today
Headers:
- apiKey: {ucode_do_usuario}
- Accept: application/json
```

**Resposta:**
```json
{
  "success": true,
  "data": {
    "events": [...],
    "total": 5,
    "date": "2024-01-15"
  }
}
```

#### Buscar Horários Disponíveis
```http
GET /api/v1/calendar/available-slots?date=2024-01-15&slot_duration=30
Headers:
- apiKey: {ucode_do_usuario}
- Accept: application/json
```

**Parâmetros:**
- `date` (obrigatório): Data no formato `Y-m-d`
- `slot_duration` (opcional): Duração em minutos (15-240, padrão: 60)

**Resposta:**
```json
{
  "success": true,
  "data": {
    "available_slots": [
      {
        "start": "2024-01-15T08:00:00.000000Z",
        "end": "2024-01-15T08:30:00.000000Z",
        "duration_minutes": 30
      }
    ],
    "total_slots": 20,
    "date": "2024-01-15",
    "slot_duration_minutes": 30
  }
}
```

#### Eventos da Semana
```http
GET /api/v1/calendar/week?year=2024&week=3
Headers:
- apiKey: {ucode_do_usuario}
- Accept: application/json
```

**Parâmetros Obrigatórios:**

| Parâmetro | Tipo | Obrigatório | Validação | Descrição |
|-----------|------|-------------|-----------|-----------|
| `year` | integer | ✅ Sim | min: 2020, max: 2030 | Ano para filtrar eventos |
| `week` | integer | ✅ Sim | min: 1, max: 53 | Número da semana do ano (ISO 8601) |

**Resposta de Sucesso:**
```json
{
  "success": true,
  "data": {
    "events": [
      {
        "id": 1,
        "title": "Reunião com Cliente",
        "description": "Discussão sobre plano de saúde",
        "start_date": "2024-01-15T14:00:00.000000Z",
        "end_date": "2024-01-15T15:00:00.000000Z",
        "all_day": false,
        "color": "#3788d8",
        "status": "scheduled",
        "type": "meeting",
        "location": "Escritório",
        "attendees": null,
        "metadata": null,
        "created_at": "2024-01-15T10:30:00.000000Z",
        "updated_at": "2024-01-15T10:30:00.000000Z"
      }
    ],
    "total": 5,
    "year": 2024,
    "week": 3
  }
}
```

**Resposta de Erro (422 - Validação):**
```json
{
  "success": false,
  "error": "Validation Error",
  "message": "The given data was invalid.",
  "errors": {
    "year": ["O campo ano é obrigatório."],
    "week": ["O campo week é obrigatório."]
  }
}
```

**Exemplos de Uso:**
```bash
# Eventos da semana 3 de 2024
curl -H "apiKey: seu_ucode_aqui" \
     "https://ondeal.test/api/v1/calendar/week?year=2024&week=3"

# Eventos da semana atual
curl -H "apiKey: seu_ucode_aqui" \
     "https://ondeal.test/api/v1/calendar/week?year=2025&week=42"
```

**Observações:**
- Retorna apenas eventos do broker autenticado
- A semana segue o padrão ISO 8601 (1-53)
- Eventos são ordenados por data de início
- Inclui eventos de dia inteiro (`all_day: true`)

#### Eventos do Mês
```http
GET /api/v1/calendar/month?year=2024&month=1
Headers:
- apiKey: {ucode_do_usuario}
- Accept: application/json
```

**Parâmetros Obrigatórios:**

| Parâmetro | Tipo | Obrigatório | Validação | Descrição |
|-----------|------|-------------|-----------|-----------|
| `year` | integer | ✅ Sim | min: 2020, max: 2030 | Ano para filtrar eventos |
| `month` | integer | ✅ Sim | min: 1, max: 12 | Mês do ano (1=Janeiro, 12=Dezembro) |

**Resposta de Sucesso:**
```json
{
  "success": true,
  "data": {
    "events": [
      {
        "id": 1,
        "title": "Reunião com Cliente",
        "description": "Discussão sobre plano de saúde",
        "start_date": "2024-01-15T14:00:00.000000Z",
        "end_date": "2024-01-15T15:00:00.000000Z",
        "all_day": false,
        "color": "#3788d8",
        "status": "scheduled",
        "type": "meeting",
        "location": "Escritório",
        "attendees": null,
        "metadata": null,
        "created_at": "2024-01-15T10:30:00.000000Z",
        "updated_at": "2024-01-15T10:30:00.000000Z"
      }
    ],
    "total": 15,
    "year": 2024,
    "month": 1
  }
}
```

**Resposta de Erro (422 - Validação):**
```json
{
  "success": false,
  "error": "Validation Error",
  "message": "The given data was invalid.",
  "errors": {
    "year": ["O campo ano é obrigatório."],
    "month": ["O campo mês é obrigatório."]
  }
}
```

**Exemplos de Uso:**
```bash
# Eventos de Janeiro de 2024
curl -H "apiKey: seu_ucode_aqui" \
     "https://ondeal.test/api/v1/calendar/month?year=2024&month=1"

# Eventos de Dezembro de 2025
curl -H "apiKey: seu_ucode_aqui" \
     "https://ondeal.test/api/v1/calendar/month?year=2025&month=12"
```

**Observações:**
- Retorna apenas eventos do broker autenticado
- Mês deve ser informado como número (1-12)
- Retorna todos os eventos do mês especificado
- Inclui eventos de dia inteiro (`all_day: true`)

#### Buscar Eventos
```http
GET /api/v1/calendar/search?query=reunião
Headers:
- apiKey: {ucode_do_usuario}
- Accept: application/json
```

**Parâmetros Obrigatórios:**

| Parâmetro | Tipo | Obrigatório | Validação | Descrição |
|-----------|------|-------------|-----------|-----------|
| `query` | string | ✅ Sim | min: 2, max: 255 | Texto de busca (título, descrição ou localização) |

**Resposta de Sucesso:**
```json
{
  "success": true,
  "data": {
    "events": [
      {
        "id": 1,
        "title": "Reunião com Cliente",
        "description": "Discussão sobre plano de saúde",
        "start_date": "2024-01-15T14:00:00.000000Z",
        "end_date": "2024-01-15T15:00:00.000000Z",
        "all_day": false,
        "color": "#3788d8",
        "status": "scheduled",
        "type": "meeting",
        "location": "Escritório",
        "attendees": null,
        "metadata": null,
        "created_at": "2024-01-15T10:30:00.000000Z",
        "updated_at": "2024-01-15T10:30:00.000000Z"
      }
    ],
    "total": 3,
    "query": "reunião"
  }
}
```

**Resposta de Erro (422 - Validação):**
```json
{
  "success": false,
  "error": "Validation Error",
  "message": "The given data was invalid.",
  "errors": {
    "query": ["O campo query é obrigatório."]
  }
}
```

**Exemplos de Uso:**
```bash
# Buscar por "reunião"
curl -H "apiKey: seu_ucode_aqui" \
     "https://ondeal.test/api/v1/calendar/search?query=reunião"

# Buscar por localização
curl -H "apiKey: seu_ucode_aqui" \
     "https://ondeal.test/api/v1/calendar/search?query=escritório"

# Buscar por nome de cliente
curl -H "apiKey: seu_ucode_aqui" \
     "https://ondeal.test/api/v1/calendar/search?query=João"
```

**Observações:**
- Busca em: `title`, `description` e `location`
- Retorna apenas eventos do broker autenticado
- Busca case-insensitive (não diferencia maiúsculas/minúsculas)
- Mínimo de 2 caracteres para a busca

#### Criar Evento
```http
POST /api/v1/events
Headers:
- apiKey: {ucode_do_usuario}
- Content-Type: application/json

Body:
{
  "title": "Reunião com Cliente",
  "description": "Discussão sobre plano de saúde",
  "start_date": "2024-01-15 14:00:00",
  "end_date": "2024-01-15 15:00:00",
  "type": "meeting",
  "location": "Escritório",
  "all_day": false,
  "color": "#3788d8"
}
```

### Funcionalidades do Calendário

- **Horário de funcionamento**: 8h às 18h
- **Duração configurável**: 15 a 240 minutos por slot
- **Filtro por usuário**: Apenas eventos do broker autenticado
- **Detecção de conflitos**: Verifica sobreposição de horários
- **Exclusão de cancelados**: Eventos cancelados não bloqueiam slots
- **Suporte a eventos de dia inteiro**
- **Cores personalizáveis por evento**

## Segurança

### Autenticação
- **Web**: Laravel Sanctum
- **API Externa**: API Key via header
- **Rate Limiting**: 100 req/min

### Middlewares
- `ucode.auth`: Autenticação de usuários
- `supplier.auth`: Autenticação de fornecedores
- `basic.restriction`: Restrições para usuários BASIC
- `premium.access`: Controle de acesso premium

### Validações
- Filtro automático por `broker_id`
- Validação de propriedade de leads
- Sanitização de dados de entrada
- Verificação de limites por plano


## Performance

- **Paginação**: Implementada em todas as listagens
- **Índices**: Otimizados no banco de dados
- **Cache**: Queries frequentes em cache
- **Build**: Frontend otimizado para produção



## Gestão de Planos de Assinatura

### Visão Geral

Os planos de assinatura são gerenciados localmente e sincronizados com o Stripe usando Laravel Cashier. O sistema OnDeal cria e gerencia os planos localmente, sincronizando produtos e preços com o Stripe Dashboard.

### Comandos de Sincronização

```bash
# Sincronizar planos locais com o Stripe
php artisan stripe:sync-plans

# Criar produtos e preços no Stripe para planos existentes
php artisan stripe:create-plans
```

Estes comandos sincronizam os planos locais com o Stripe:
- **Planos locais** são enviados para o Stripe como produtos e preços
- **IDs do Stripe** são armazenados nos campos `stripe_product_id` e `stripe_price_id`
- **Sincronização bidirecional** mantém dados atualizados

### Estrutura dos Planos

Os planos são armazenados na tabela `subscriptions` com os seguintes campos:
- `name`: Nome do plano
- `description`: Descrição do plano
- `price`: Preço mensal em BRL
- `durationDays`: Duração em dias (30 dias para planos mensais)
- `plan_type`: Tipo do plano (individual, teams, enterprise)
- `features`: Array JSON com funcionalidades do plano
- `stripe_product_id`: ID único do produto no Stripe
- `stripe_price_id`: ID único do preço no Stripe
- `isActive`: Status do plano (ativo/inativo)
- `last_synced_at`: Timestamp da última sincronização

### Fluxo de Trabalho

1. **Criar plano local** via seeder ou admin
2. **Executar sincronização**: `php artisan stripe:create-plans`
3. **Planos criados** automaticamente no Stripe Dashboard
4. **IDs do Stripe** armazenados no banco local
5. **Checkout** utiliza IDs para criar sessões de pagamento

### Tipos de Plano

O sistema suporta três tipos de planos:
- **Individual** → `plan_type: 'individual'` - Plano individual (100 leads)
- **Teams** → `plan_type: 'teams'` - Plano para equipes (150 leads)
- **Enterprise** → `plan_type: 'enterprise'` - Plano empresarial (200 leads)

### Webhooks Stripe

O sistema recebe notificações do Stripe através de webhooks usando Laravel Cashier:

#### URL do Webhook
- **`/stripe/webhook`** - Webhook principal do Stripe

#### Eventos Suportados

**Assinaturas:**
- `customer.subscription.created` - Assinatura criada → Seta `is_active = true`
- `customer.subscription.updated` - Assinatura atualizada → Atualiza `is_active` baseado no status
- `customer.subscription.deleted` - Assinatura cancelada → Seta `is_active = false` e `plan_type = 0` (BASIC)

**Pagamentos:**
- `invoice.payment_succeeded` - Pagamento aprovado → Seta `is_active = true` e renova `subscription_expires_at`
- `invoice.payment_failed` - Pagamento falhou → Seta `is_active = false` (inadimplente)
- `payment_intent.succeeded` - Pagamento bem-sucedido
- `payment_intent.payment_failed` - Pagamento falhou

**Clientes:**
- `customer.created` - Cliente criado no Stripe
- `customer.updated` - Cliente atualizado
- `customer.deleted` - Cliente removido

#### Atualização Automática de Status

O webhook atualiza automaticamente os campos do broker:

| Evento Stripe | `is_active` | `plan_type` | `subscription_expires_at` |
|---------------|-------------|-------------|---------------------------|
| Assinatura criada | `true` | Mantém | +30 dias |
| Pagamento aprovado | `true` | Mantém | +30 dias |
| Pagamento falhou | `false` | Mantém | Mantém |
| Assinatura cancelada | `false` | `0` (BASIC) | `null` |
| Status "active"/"trialing" | `true` | Mantém | Mantém |
| Outros status | `false` | Mantém | Mantém |

#### Validação de Segurança

- **Validação de Assinatura** - Verifica assinatura do webhook do Stripe
- **Middleware Cashier** - Usa `VerifyWebhookSignature` nativo
- **Logs automáticos** - Registra todos os webhooks processados

#### Configuração dos Webhooks

**No Stripe Dashboard:**
1. Acesse **Desenvolvedores > Webhooks** no Stripe Dashboard
2. Clique em **"Adicionar endpoint"**
3. URL: `https://seu-dominio.com/stripe/webhook`
4. Selecione os eventos desejados
5. Copie o **Signing Secret** e configure `STRIPE_WEBHOOK_SECRET`

**Configuração de Ambiente:**
```env
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
STRIPE_CURRENCY=brl
```

#### Processamento de Webhooks

- **Validação automática** de assinatura do Stripe
- **Processamento inteligente** baseado no tipo de evento
- **Logs detalhados** para debugging e auditoria
- **Sincronização automática** de status de assinaturas
- **Tratamento de erros** robusto

### Laravel Cashier

O sistema utiliza Laravel Cashier para integração completa com Stripe:

#### Funcionalidades Implementadas
- **Checkout Sessions** - Criação de sessões de pagamento
- **Subscription Management** - Gerenciamento de assinaturas
- **Customer Portal** - Portal do cliente Stripe
- **Webhook Processing** - Processamento automático de eventos
- **Payment Methods** - Gerenciamento de métodos de pagamento

#### Trait Billable

O modelo `User` utiliza o trait `Billable` do Cashier:
```php
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Billable;
}
```

#### Métodos Disponíveis
- `$user->newSubscription()` - Criar nova assinatura
- `$user->subscription()` - Acessar assinatura ativa
- `$user->checkout()` - Criar sessão de checkout
- `$user->createAsStripeCustomer()` - Criar cliente no Stripe
```

## Sistema de Pagamentos Stripe

### Visão Geral

O sistema de pagamentos utiliza **Laravel Cashier** para integração completa com Stripe, oferecendo checkout seguro, gerenciamento de assinaturas e processamento automático de webhooks.

### Arquitetura

```
app/Services/
├── StripeSubscriptionService.php    # Gerenciamento de assinaturas
├── StripePlanService.php           # Sincronização de planos
└── StripePaymentService.php        # Processamento de pagamentos

app/Http/Controllers/
└── StripeWebhookController.php     # Processamento de webhooks

app/Console/Commands/
├── SyncPlansWithStripe.php         # Sincronizar planos
└── CreateStripePlans.php           # Criar planos no Stripe
```

### Fluxo de Assinatura

1. **Usuário seleciona plano** → Sistema busca dados locais
2. **Sistema cria checkout** → Stripe Checkout Session
3. **Usuário completa pagamento** → Stripe processa pagamento
4. **Webhook confirma** → Assinatura ativada automaticamente
5. **Sistema atualiza status** → Usuário pode usar recursos do plano

### Comandos Disponíveis

```bash
# Sincronizar planos locais com o Stripe
php artisan stripe:sync-plans

# Criar produtos e preços no Stripe para planos existentes
php artisan stripe:create-plans
```

### Configuração de Ambiente

#### Variáveis Necessárias
```env
# Stripe Configuration
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
STRIPE_CURRENCY=brl

# Gateway padrão (usar sempre stripe_cashier)
PAYMENT_DEFAULT_GATEWAY=stripe_cashier
```

#### Configuração de Produção
```env
# Stripe Live Keys
STRIPE_KEY=pk_live_...
STRIPE_SECRET=sk_live_...
STRIPE_WEBHOOK_SECRET=whsec_...
STRIPE_CURRENCY=brl
```

### URLs de Pagamento

| **Tipo** | **URL** | **Descrição** |
|----------|---------|---------------|
| **Checkout** | Stripe Checkout | Sessão de pagamento segura |
| **Success** | `/subscriptions/success` | Página de sucesso após pagamento |
| **Cancel** | `/payment/cancel` | Página de cancelamento |
| **Webhook** | `/stripe/webhook` | Notificações automáticas do Stripe |

### Rotas Disponíveis

- `POST /stripe/webhook` - Webhook para eventos do Stripe
- `GET /subscriptions` - Listar planos de assinatura
- `POST /subscriptions/create-payment-link` - Criar link de pagamento
- `GET /pricing` - Página de preços
- `GET /pricing/select/{id}` - Selecionar plano

### Vantagens do Sistema Stripe

1. **Segurança**: Checkout seguro do Stripe com PCI compliance
2. **Confiabilidade**: Infraestrutura robusta e global do Stripe
3. **Laravel Cashier**: Integração nativa com Laravel
4. **Webhooks**: Processamento automático de eventos
5. **Portal do Cliente**: Interface nativa para gerenciamento de assinaturas
6. **Métodos de Pagamento**: Suporte a cartões, PIX, boleto e mais
7. **Internacionalização**: Suporte a múltiplas moedas
8. **Relatórios**: Dashboard completo de analytics

## Configuração de Ambiente

### Variáveis Essenciais

#### Configurações Básicas do Laravel
```env
APP_NAME=OnDeal
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost
```

#### Banco de Dados
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ondealfull
DB_USERNAME=root
DB_PASSWORD=
```

#### Stripe (Obrigatório)
```env
# Chaves do Stripe
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
STRIPE_CURRENCY=brl

# Gateway padrão
PAYMENT_DEFAULT_GATEWAY=stripe_cashier
```

#### Outros Gateways (Opcionais)
```env
# PagSeguro
PAGSEGURO_EMAIL=your_email@example.com
PAGSEGURO_TOKEN=your_token
PAGSEGURO_ENVIRONMENT=sandbox

# Mercado Pago
MERCADOPAGO_ACCESS_TOKEN=your_access_token
MERCADOPAGO_PUBLIC_KEY=your_public_key
MERCADOPAGO_WEBHOOK_SECRET=your_webhook_secret
MERCADOPAGO_ENVIRONMENT=sandbox

# PayPal
PAYPAL_CLIENT_ID=your_client_id
PAYPAL_CLIENT_SECRET=your_client_secret
PAYPAL_MODE=sandbox

# Asaas
ASAAS_API_KEY=your_api_key
ASAAS_ENVIRONMENT=sandbox
ASAAS_WEBHOOK_TOKEN=your_webhook_token
```

### Como Configurar

#### 1. Configurar Stripe
```bash
# 1. Copiar arquivo de ambiente
cp .env.example .env

# 2. Gerar chave da aplicação
php artisan key:generate

# 3. Configurar variáveis do Stripe no .env
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
STRIPE_CURRENCY=brl
PAYMENT_DEFAULT_GATEWAY=stripe_cashier
```

#### 2. Instalar Laravel Cashier
```bash
# Instalar pacote
composer require laravel/cashier

# Publicar migrations (se necessário)
php artisan vendor:publish --tag="cashier-migrations"
```

#### 3. Configurar Banco de Dados
```bash
# Executar migrations
php artisan migrate

# Executar seeder de planos
php artisan db:seed --class=SubscriptionSeeder
```

#### 4. Sincronizar com Stripe
```bash
# Criar planos no Stripe Dashboard
php artisan stripe:create-plans

# Sincronizar planos locais com Stripe
php artisan stripe:sync-plans
```

### Comandos Disponíveis

```bash
# Sincronizar planos locais com o Stripe
php artisan stripe:sync-plans

# Criar produtos e preços no Stripe para planos existentes
php artisan stripe:create-plans

# Executar seeder de planos
php artisan db:seed --class=SubscriptionSeeder
```

### Configuração do Stripe Dashboard

#### 1. Criar Conta Stripe
- Acesse [stripe.com](https://stripe.com)
- Crie uma conta de desenvolvedor
- Obtenha as chaves de API (test/live)

#### 2. Configurar Webhook
- Acesse **Desenvolvedores > Webhooks**
- Adicione endpoint: `https://seu-dominio.com/stripe/webhook`
- Selecione eventos: `customer.subscription.*`, `invoice.payment_*`
- Copie o **Signing Secret**

#### 3. Configurar Produtos
- Execute `php artisan stripe:create-plans`
- Verifique produtos criados no Dashboard
- Ajuste preços se necessário

### Troubleshooting

#### Erro de SSL/TLS
```bash
# Instalar dependências com flag de segurança
composer require laravel/cashier --ignore-platform-reqs
```

#### Webhook não funciona
- Verifique se `STRIPE_WEBHOOK_SECRET` está correto
- Confirme se a URL está acessível publicamente
- Verifique logs: `tail -f storage/logs/laravel.log`

#### Planos não sincronizam
- Execute `php artisan stripe:create-plans`
- Verifique chaves do Stripe no `.env`
- Confirme permissões da conta Stripe
- Verifique logs: `tail -f storage/logs/laravel.log`

#### Erro: preg_match(): Delimiter must not be alphanumeric
**Problema:** Erro de CORS ao fazer requisições da API externa (ngrok, etc)

**Causa:** Padrões regex em `allowed_origins_patterns` sem delimitadores obrigatórios

**Solução:**
```php
// ❌ ERRADO - Sem delimitadores
'allowed_origins_patterns' => [
    'https://.*\.ngrok-free\.app',
],

// ✅ CORRETO - Com delimitadores e âncoras
'allowed_origins_patterns' => [
    '#^https://.*\.ngrok-free\.app$#',
],
```

#### Leads não são deletados após transferência para contatos
**Problema:** Leads permanecem na tabela `leads` após transferência para `contacts`

**Causa:** Código antigo apenas alterava o status do lead para `sold` sem deletar o registro

**Solução:** Atualizado em `ContactService.php` - agora executa `$lead->delete()` após transferência bem-sucedida

**Métodos corrigidos:**
- `transferLeadsToContacts()` (linha 333)
- `transferLeadsToContactsForUser()` (linha 609)

#### Usuários não conseguem atualizar leads ao atingir o limite
**Problema:** Middleware bloqueava TODAS as requisições (incluindo atualização) quando usuário atingia limite de leads

**Causa:** `UCodeApiAuthMiddleware` verificava limite para todas as operações, não apenas criação

**Solução:** Middleware agora verifica apenas operações de **criação** (POST) antes de bloquear

**Arquivo corrigido:**
- `app/Http/Middleware/UCodeApiAuthMiddleware.php` (linha 38)

**Método adicionado:**
```php
private function isCreatingLead(Request $request): bool
{
    return $request->isMethod('POST') &&
           str_contains($request->path(), 'leads') &&
           !str_contains($request->path(), 'transfer') &&
           !str_contains($request->path(), 'search') &&
           !str_contains($request->path(), 'by-');
}
```

**Agora usuários podem:**
- ✅ Atualizar leads existentes mesmo no limite
- ✅ Visualizar e buscar seus leads
- ✅ Mover leads no kanban
- ❌ Não podem criar novos leads até fazer upgrade

#### Logs de Sistema
```bash
# Ver logs em tempo real
tail -f storage/logs/laravel.log

# Limpar cache
php artisan cache:clear
php artisan config:clear

# Resetar banco e popular dados de teste
php artisan migrate:fresh --seed
```

## Comandos Úteis

```bash
# Executar testes
php artisan test

# Compilar assets em desenvolvimento
npm run dev

# Sincronizar planos com Stripe
php artisan stripe:sync-plans

# Criar planos no Stripe
php artisan stripe:create-plans
```

## Integração WhatsApp Mobile

### Visão Geral

Sistema de acesso **ultra-seguro** para gestão de leads via WhatsApp. Permite que usuários autenticados via n8n acessem uma interface simplificada para visualizar e criar leads diretamente de qualquer dispositivo (mobile ou desktop), **sem necessidade de login no sistema**.

### Arquitetura

O sistema reutiliza 100% da infraestrutura existente com segurança adicional:
- **API v1**: Endpoints de leads já existentes (`/api/v1/leads`)
- **Autenticação**: Laravel Sanctum com tokens temporários (24h)
- **Validação Obrigatória**: Token validado em cada acesso às páginas
- **Segurança**: ADMIN_API_TOKEN para validação de requisições do n8n
- **Interface Responsiva**: Funciona em mobile e desktop
- **Página de Erro**: Bloqueia acessos não autorizados com link para SecretárIA

### Fluxo de Autenticação Completo

```
1. Usuário inicia conversa no WhatsApp
   ↓
2. n8n captura ucode do usuário
   ↓
3. n8n → POST /api/whatsapp/generate-token
   Headers: Authorization: Bearer {ADMIN_API_TOKEN}
   Body: {ucode: "abc123"}
   ↓
4. Laravel valida e gera token Sanctum (24h)
   Retorna: {token, redirect_url, user}
   ↓
5. n8n envia link mobile para usuário
   Exemplo: https://seu-dominio.com/whatsapp/leads?token=21|ABC123...
   ↓
6. Usuário acessa via smartphone
   ↓
7. ✅ WhatsAppTokenAuthMiddleware valida:
   - Token existe na URL?
   - Token é válido no banco?
   - Token não expirou (24h)?
   ↓
8. ✅ APROVADO: Interface mobile carrega
   ❌ NEGADO: Exibe página de erro com link para SecretárIA
   ↓
9. Usuário gerencia seus leads:
   - Visualizar lista de leads
   - Criar novos leads
   - Navegar entre páginas
   ↓
10. Botão "Voltar ao WhatsApp" → Envia requisição para webhook N8N
    Webhook: {WHATSAPP_WEBHOOK_URL}
```

### Endpoints

#### Gerar Token de Acesso

```http
POST /api/whatsapp/generate-token
Headers:
  Authorization: Bearer {ADMIN_API_TOKEN}
  Content-Type: application/json
Body:
{
  "ucode": "aB3cD4eF5gH6iJ7kL8mN9oP"
}
```

**Resposta de Sucesso (200):**
```json
{
  "success": true,
  "token": "1|sKtC5OSS7tGw5KBz1CLV8EVjSnzo904RZIHf5NQm55a2dbc5",
  "redirect_url": "https://seu-dominio.com/whatsapp/leads?token=xxx",
  "user": {
    "id": 1,
    "name": "Rafael Barros",
    "phone": "5534992900099"
  }
}
```

**Respostas de Erro:**

```json
// 404 - Usuário não encontrado
{
  "success": false,
  "error": "Usuário não encontrado"
}

// 403 - Usuário sem permissão (não é broker/supplier)
{
  "success": false,
  "error": "Sem permissão"
}

// 401 - ADMIN_API_TOKEN inválido
{
  "error": "Invalid admin token",
  "message": "The provided admin token is invalid"
}
```

#### Interface Mobile - Lista de Leads

```http
GET /whatsapp/leads?token={token}
Middleware: whatsapp.token
```

**Funcionalidades:**
- ✅ Lista de leads do usuário autenticado
- ✅ Botão "+ Novo Lead" (redireciona para página de criação)
- ✅ Botão "Voltar ao WhatsApp" (fixo no rodapé)
- ✅ Token preservado na navegação
- ✅ Validação obrigatória de token

#### Interface Mobile - Criar Lead

```http
GET /whatsapp/leads/create?token={token}
Middleware: whatsapp.token
```

**Funcionalidades:**
- ✅ Formulário de criação de lead
- ✅ Botão "← Voltar" (retorna à lista)
- ✅ Redirecionamento automático após sucesso
- ✅ Botão "Voltar ao WhatsApp" (fixo no rodapé)
- ✅ Validação obrigatória de token

#### Página de Erro - Acesso Não Autorizado

Exibida automaticamente quando:
- ❌ Token ausente na URL
- ❌ Token inválido ou não encontrado
- ❌ Token expirado (>24h)

**Funcionalidade:**
- ✅ Mensagem de erro clara
- ✅ Botão "Falar com a SecretárIA"
- ✅ Redireciona para WhatsApp da secretária

### APIs Utilizadas

A interface mobile consome os endpoints existentes da API v1:

```http
# Listar leads do usuário autenticado
GET /api/v1/leads
Headers: Authorization: Bearer {token}

# Criar novo lead
POST /api/v1/leads
Headers: Authorization: Bearer {token}
Body: {name, phone, email, city, state, type, source...}
```

### Segurança

Sistema de segurança em **3 camadas independentes**:

| Camada | Middleware/Validação | Descrição |
|--------|---------------------|-----------|
| **1. Geração de Token** | `admin.api.auth` | Apenas n8n pode gerar tokens (ADMIN_API_TOKEN) |
| **2. Validação de Token** | `whatsapp.token` | Valida token Sanctum em cada acesso às páginas |
| **3. Autenticação API** | `auth:sanctum` | Tokens Sanctum com validade de 24 horas |
| **Auto-Owner** | N/A | Leads vinculados automaticamente ao usuário autenticado |
| **Rate Limiting** | `throttle` | 10 req/min para geração, 100 req/min para API |
| **Audit Logs** | N/A | Registra apenas tentativas de acesso com erro |

#### Fluxo de Segurança Detalhado

```
Acesso a /whatsapp/leads?token=XXX
         ↓
[1] WhatsAppTokenAuthMiddleware
    → Token presente na URL?
    → Token válido no banco?
    → Token não expirou?
    ✅ SIM → Carrega interface
    ❌ NÃO → Página de erro + link SecretárIA
         ↓
[2] Sanctum Authentication (API calls)
    → Bearer Token válido?
    ✅ SIM → Retorna dados
    ❌ NÃO → 401 Unauthorized
```

### Configuração

#### 1. Variáveis de Ambiente

Configure no arquivo `.env`:

```env
# Token de administração da API (para n8n gerar tokens)
ADMIN_API_TOKEN=seu_token_super_secreto_aqui

# Webhook do N8N para retorno ao WhatsApp
WHATSAPP_WEBHOOK_URL="https://whnn.niceapi.xyz/webhook/40c130f7-7d2c-4e9c-a8c6-f91bae747191"
```

**WHATSAPP_WEBHOOK_URL:**
- URL do webhook usado no botão "Voltar ao WhatsApp" (todas as páginas mobile)
- Usado na página de erro não autorizado
- Formato: URL completa do webhook do N8N
- O webhook recebe um POST com JSON contendo a ação e dados do usuário

#### 2. Configuração no n8n

Configure o workflow do n8n para:

1. Capturar o `ucode` do usuário
2. Fazer requisição POST para `/api/whatsapp/generate-token`
3. Incluir header `Authorization: Bearer {ADMIN_API_TOKEN}`
4. Enviar `redirect_url` retornado para o usuário via WhatsApp

#### 3. Exemplo de Implementação n8n

```javascript
// Node HTTP Request no n8n
const options = {
  method: 'POST',
  url: 'https://seu-dominio.com/api/whatsapp/generate-token',
  headers: {
    'Authorization': 'Bearer ' + $env.ADMIN_API_TOKEN,
    'Content-Type': 'application/json'
  },
  body: {
    ucode: $json.user_ucode // obtido do fluxo anterior
  }
};

return options;
```

### Estrutura de Arquivos

```
app/Http/
├── Controllers/
│   ├── WhatsAppAuthController.php          # Geração de token Sanctum
│   └── WhatsAppLeadController.php          # Renderiza views mobile
└── Middleware/
    ├── AdminApiAuthMiddleware.php          # Valida ADMIN_API_TOKEN
    ├── WhatsAppTokenAuthMiddleware.php     # ✨ NOVO: Valida token nas páginas
    └── MobileOnlyMiddleware.php            # Bloqueia acesso desktop

app/Services/
└── WhatsAppLeadService.php                 # Retorna nome das views
└── WhatsAppAuthService.php                 # Lógica de geração de token

app/Repositories/
└── WhatsAppAuthRepository.php              # Busca usuário por ucode

app/DTOs/
├── WhatsAppAuthDTO.php                     # Input: ucode + ip
└── WhatsAppAuthResponseDTO.php             # Output: token + redirect_url + user

app/Interfaces/
└── WhatsAppAuthRepositoryInterface.php     # Contrato do repository

resources/views/mobile/leads/
├── list.blade.php                          # ✨ NOVO: Lista de leads
└── create.blade.php                        # ✨ NOVO: Formulário de criação

resources/views/errors/
└── whatsapp-unauthorized.blade.php         # ✨ NOVO: Erro de acesso negado

bootstrap/
└── app.php                                 # Registra middleware 'whatsapp.token'

routes/
├── api.php                                 # POST /api/whatsapp/generate-token
└── web.php                                 # GET /whatsapp/leads e /whatsapp/leads/create
```

**Arquivos novos/modificados:**
- ✨ `WhatsAppTokenAuthMiddleware.php` - Validação obrigatória de token
- ✨ `whatsapp-unauthorized.blade.php` - Página de erro personalizada
- ✨ `mobile/leads/list.blade.php` - Lista de leads (separada)
- ✨ `mobile/leads/create.blade.php` - Criação de leads (separada)
- 📝 `web.php` - Adicionado middleware `whatsapp.token`
- 📝 `bootstrap/app.php` - Registrado alias do middleware
- 📝 `env.copy` - Adicionado `WHATSAPP_WEBHOOK_URL`

### Logs

Apenas erros são registrados em `storage/logs/laravel.log`:

```
[2025-10-17] local.WARNING: WhatsApp Auth: Usuário não encontrado
[2025-10-17] local.WARNING: WhatsApp Auth: Usuário sem permissão
```

### Troubleshooting

#### 🔴 Acesso Não Autorizado (Página de Erro)

**Problema:** Usuário vê página de erro ao acessar o link

**Possíveis Causas:**
1. ❌ Token ausente na URL
2. ❌ Token inválido ou não encontrado no banco
3. ❌ Token expirado (>24h desde criação)
4. ❌ Link copiado incorretamente (token truncado)

**Solução:**
- Usuário deve clicar no botão "Falar com a SecretárIA"
- Solicitar novo link via WhatsApp
- n8n gerará novo token válido

**Como debugar:**
```bash
# Verificar tokens ativos
SELECT * FROM personal_access_tokens
WHERE name = 'whatsapp-mobile'
ORDER BY created_at DESC;

# Verificar expiração
SELECT id, name, created_at, expires_at
FROM personal_access_tokens
WHERE expires_at < NOW();
```

#### 🔴 Token Expirado (401 na API)

**Problema:** Usuário consegue acessar a página mas API retorna 401

**Causa:** Token válido para acesso à página mas expirado para API

**Solução:** Mesmo procedimento - solicitar novo link via WhatsApp


#### 🔴 ADMIN_API_TOKEN Inválido

**Problema:** n8n recebe erro 401 ao gerar token

**Causa:** Token administrativo incorreto ou não configurado

**Solução:**
```bash
# Verificar .env
grep ADMIN_API_TOKEN .env

# Verificar no n8n
# Deve corresponder exatamente ao valor do .env
```

#### 🔴 WHATSAPP_WEBHOOK_URL não Configurado

**Problema:** Botão "Voltar ao WhatsApp" não funciona

**Causa:** Variável `WHATSAPP_WEBHOOK_URL` ausente no `.env`

**Solução:**
```env
# Adicionar ao .env
WHATSAPP_WEBHOOK_URL="https://whnn.niceapi.xyz/webhook/40c130f7-7d2c-4e9c-a8c6-f91bae747191"
```

### Vantagens da Implementação

#### 🔐 Segurança

✅ **Validação em 3 camadas** (token admin → token sanctum → autenticação API)
✅ **Acesso 100% fechado** (impossível acessar sem token válido)
✅ **Expiração automática** (tokens expiram em 24h)
✅ **Página de erro personalizada** (usuário sabe como resolver)
✅ **Logs de auditoria** (registra apenas tentativas com erro)

#### 🚀 Performance

✅ **Zero overhead** (reutiliza API v1 existente)
✅ **Cache no navegador** (token armazenado no localStorage)
✅ **SPA leve** (apenas Tailwind CSS via CDN)
✅ **Sem duplicação** (mesmos controllers e services)

#### 🎯 UX/UI

✅ **Sem necessidade de login** (acesso direto via WhatsApp)
✅ **Interface responsiva** (funciona em mobile e desktop)
✅ **Navegação fluida** (token preservado automaticamente)
✅ **Feedback visual** (mensagens de sucesso/erro)
✅ **Botão "Voltar ao WhatsApp"** (sempre disponível)
✅ **Redirecionamento inteligente** (após criar lead)

#### 🛠️ Manutenibilidade

✅ **Arquitetura SOLID** (separação de responsabilidades)
✅ **Código isolado** (módulo independente)
✅ **Fácil debug** (logs claros e específicos)
✅ **Configurável via ENV** (tokens e telefones)
✅ **Documentação completa** (README atualizado)

#### 📊 Estatísticas

- **7 arquivos novos** (mínimo necessário)
- **4 arquivos modificados** (rotas e config)
- **0 duplicação** (100% reuso de código)
- **3 camadas de segurança** (proteção robusta)
- **24h de validade** (token temporário)
- **Acesso universal** (funciona em mobile e desktop)

## Licença

Este projeto é proprietário e confidencial.

---
