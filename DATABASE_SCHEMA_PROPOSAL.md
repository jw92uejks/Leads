# 📐 Proposta de Schema Inicial - Banco de Dados Mercado de Leads

Este documento apresenta uma proposta de schema inicial baseado em boas práticas para sistemas de marketplace de leads.

---

## 🎯 Estrutura Proposta (MVP)

### Entidades Principais

```
┌─────────────┐       ┌─────────────┐       ┌─────────────┐
│   USERS     │───────│   LEADS     │───────│ COMPANIES   │
└─────────────┘       └─────────────┘       └─────────────┘
      │                      │                      │
      │                      │                      │
      ▼                      ▼                      ▼
┌─────────────┐       ┌─────────────┐       ┌─────────────┐
│   ROLES     │       │ TRANSACTIONS│       │  CONTACTS   │
└─────────────┘       └─────────────┘       └─────────────┘
```

---

## 📋 Tabelas Detalhadas

### 1. Users (Usuários do Sistema)
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NULL,
    document VARCHAR(20) NULL COMMENT 'CPF/CNPJ',
    user_type ENUM('buyer', 'seller', 'admin') DEFAULT 'buyer',
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    balance DECIMAL(10, 2) DEFAULT 0.00 COMMENT 'Saldo em créditos',
    avatar VARCHAR(255) NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    
    INDEX idx_email (email),
    INDEX idx_user_type (user_type),
    INDEX idx_status (status)
);
```

**Campos Importantes:**
- `user_type`: Diferencia compradores, vendedores e administradores
- `balance`: Saldo de créditos na plataforma
- `document`: CPF para pessoa física, CNPJ para pessoa jurídica
- `status`: Controle de status da conta

---

### 2. Companies (Empresas)
```sql
CREATE TABLE companies (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL COMMENT 'Dono da empresa',
    name VARCHAR(255) NOT NULL,
    trading_name VARCHAR(255) NULL COMMENT 'Nome fantasia',
    document VARCHAR(20) UNIQUE NULL COMMENT 'CNPJ',
    industry VARCHAR(100) NULL COMMENT 'Segmento/Indústria',
    size ENUM('MEI', 'small', 'medium', 'large', 'enterprise') NULL,
    estimated_revenue DECIMAL(15, 2) NULL,
    employees_count INT NULL,
    website VARCHAR(255) NULL,
    phone VARCHAR(20) NULL,
    email VARCHAR(255) NULL,
    address_line1 VARCHAR(255) NULL,
    address_line2 VARCHAR(255) NULL,
    city VARCHAR(100) NULL,
    state VARCHAR(50) NULL,
    country VARCHAR(50) DEFAULT 'BR',
    postal_code VARCHAR(20) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_document (document),
    INDEX idx_industry (industry),
    INDEX idx_size (size)
);
```

**Campos Importantes:**
- `user_id`: Relaciona empresa com usuário proprietário
- `industry`: Segmento de mercado (tecnologia, saúde, etc.)
- `size`: Porte da empresa para segmentação
- `estimated_revenue`: Faturamento estimado para qualificação

---

### 3. Leads (Leads/Contatos)
```sql
CREATE TABLE leads (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_id BIGINT UNSIGNED NULL,
    source_id BIGINT UNSIGNED NULL COMMENT 'Origem/Campanha',
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NULL,
    job_title VARCHAR(100) NULL COMMENT 'Cargo',
    category VARCHAR(50) NULL COMMENT 'Categoria do lead',
    status ENUM('new', 'contacted', 'qualified', 'converted', 'lost') DEFAULT 'new',
    quality_score INT DEFAULT 0 COMMENT 'Pontuação de qualidade (0-100)',
    temperature ENUM('cold', 'warm', 'hot') DEFAULT 'cold',
    price DECIMAL(10, 2) NULL COMMENT 'Preço de venda do lead',
    is_exclusive BOOLEAN DEFAULT FALSE COMMENT 'Lead exclusivo?',
    times_sold INT DEFAULT 0 COMMENT 'Quantas vezes foi vendido',
    interests TEXT NULL COMMENT 'Interesses/necessidades',
    notes TEXT NULL COMMENT 'Observações gerais',
    metadata JSON NULL COMMENT 'Dados flexíveis adicionais',
    consent_given BOOLEAN DEFAULT FALSE COMMENT 'Consentimento LGPD',
    consent_date TIMESTAMP NULL,
    created_by BIGINT UNSIGNED NULL COMMENT 'Quem criou o lead',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL,
    
    FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE SET NULL,
    FOREIGN KEY (source_id) REFERENCES lead_sources(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_quality_score (quality_score),
    INDEX idx_temperature (temperature),
    INDEX idx_created_at (created_at)
);
```

**Campos Importantes:**
- `quality_score`: Score de 0-100 para qualificação
- `temperature`: Nível de interesse (frio, morno, quente)
- `is_exclusive`: Se o lead é vendido exclusivamente ou compartilhado
- `times_sold`: Contador de quantas vezes foi vendido
- `consent_given`: Compliance LGPD/GDPR
- `metadata`: Campo JSON para dados flexíveis

---

### 4. Lead Sources (Fontes/Campanhas)
```sql
CREATE TABLE lead_sources (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL COMMENT 'Dono da fonte/campanha',
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    type ENUM('organic', 'paid_ads', 'email', 'social', 'referral', 'event', 'other') DEFAULT 'other',
    channel VARCHAR(100) NULL COMMENT 'Canal específico (Facebook, Google, etc.)',
    campaign_url VARCHAR(500) NULL,
    utm_source VARCHAR(100) NULL,
    utm_medium VARCHAR(100) NULL,
    utm_campaign VARCHAR(100) NULL,
    budget DECIMAL(10, 2) NULL COMMENT 'Investimento na campanha',
    start_date DATE NULL,
    end_date DATE NULL,
    status ENUM('active', 'paused', 'completed') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_type (type),
    INDEX idx_status (status)
);
```

**Campos Importantes:**
- `type`: Tipo de origem (orgânico, pago, email, etc.)
- `utm_*`: Parâmetros UTM para rastreamento
- `budget`: Investimento para cálculo de ROI

---

### 5. Transactions (Transações de Leads)
```sql
CREATE TABLE transactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lead_id BIGINT UNSIGNED NOT NULL,
    buyer_id BIGINT UNSIGNED NOT NULL COMMENT 'Comprador',
    seller_id BIGINT UNSIGNED NOT NULL COMMENT 'Vendedor',
    amount DECIMAL(10, 2) NOT NULL COMMENT 'Valor da transação',
    commission DECIMAL(10, 2) DEFAULT 0.00 COMMENT 'Comissão da plataforma',
    status ENUM('pending', 'completed', 'refunded', 'cancelled') DEFAULT 'pending',
    payment_method VARCHAR(50) NULL,
    payment_reference VARCHAR(255) NULL COMMENT 'Referência do pagamento',
    refund_reason TEXT NULL,
    refunded_at TIMESTAMP NULL,
    notes TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (lead_id) REFERENCES leads(id) ON DELETE CASCADE,
    FOREIGN KEY (buyer_id) REFERENCES users(id) ON DELETE RESTRICT,
    FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_buyer (buyer_id),
    INDEX idx_seller (seller_id),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
);
```

**Campos Importantes:**
- `buyer_id` e `seller_id`: Relaciona comprador e vendedor
- `commission`: Comissão da plataforma
- `status`: Estado da transação
- `refund_reason`: Motivo do reembolso se aplicável

---

### 6. Lead Interactions (Interações com Leads)
```sql
CREATE TABLE lead_interactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lead_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    type ENUM('call', 'email', 'meeting', 'note', 'status_change') NOT NULL,
    subject VARCHAR(255) NULL,
    description TEXT NULL,
    outcome ENUM('success', 'no_answer', 'scheduled', 'not_interested') NULL,
    next_action VARCHAR(255) NULL COMMENT 'Próxima ação planejada',
    next_action_date DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (lead_id) REFERENCES leads(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_lead (lead_id),
    INDEX idx_user (user_id),
    INDEX idx_type (type),
    INDEX idx_created_at (created_at)
);
```

**Campos Importantes:**
- `type`: Tipo de interação (ligação, email, reunião, etc.)
- `outcome`: Resultado da interação
- `next_action_date`: Agendar próxima ação

---

### 7. Wallet Transactions (Transações de Carteira)
```sql
CREATE TABLE wallet_transactions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    type ENUM('credit', 'debit', 'refund', 'bonus') NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    balance_after DECIMAL(10, 2) NOT NULL COMMENT 'Saldo após transação',
    description VARCHAR(255) NULL,
    reference_type VARCHAR(50) NULL COMMENT 'Ex: transaction, purchase, etc.',
    reference_id BIGINT UNSIGNED NULL COMMENT 'ID da referência',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE RESTRICT,
    INDEX idx_user (user_id),
    INDEX idx_type (type),
    INDEX idx_reference (reference_type, reference_id),
    INDEX idx_created_at (created_at)
);
```

**Campos Importantes:**
- `type`: Tipo de movimentação (crédito, débito, reembolso, bônus)
- `balance_after`: Saldo após a transação (para auditoria)
- `reference_type` e `reference_id`: Polimórfico para referência

---

### 8. Notifications (Notificações)
```sql
CREATE TABLE notifications (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    type VARCHAR(50) NOT NULL COMMENT 'Tipo de notificação',
    title VARCHAR(255) NOT NULL,
    message TEXT NULL,
    action_url VARCHAR(500) NULL,
    is_read BOOLEAN DEFAULT FALSE,
    read_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_read (user_id, is_read),
    INDEX idx_created_at (created_at)
);
```

---

### 9. Audit Logs (Logs de Auditoria)
```sql
CREATE TABLE audit_logs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    auditable_type VARCHAR(50) NOT NULL COMMENT 'Ex: Lead, User, Transaction',
    auditable_id BIGINT UNSIGNED NOT NULL,
    action VARCHAR(50) NOT NULL COMMENT 'created, updated, deleted, etc.',
    old_values JSON NULL,
    new_values JSON NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_auditable (auditable_type, auditable_id),
    INDEX idx_user (user_id),
    INDEX idx_action (action),
    INDEX idx_created_at (created_at)
);
```

---

## 🔐 Tabelas de Controle de Acesso

### 10. Roles (Perfis/Papéis)
```sql
CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL,
    display_name VARCHAR(100) NULL,
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 11. Permissions (Permissões)
```sql
CREATE TABLE permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) UNIQUE NOT NULL,
    display_name VARCHAR(100) NULL,
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 12. Role_User (Pivot)
```sql
CREATE TABLE role_user (
    user_id BIGINT UNSIGNED NOT NULL,
    role_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (user_id, role_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);
```

### 13. Permission_Role (Pivot)
```sql
CREATE TABLE permission_role (
    permission_id BIGINT UNSIGNED NOT NULL,
    role_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (permission_id, role_id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);
```

---

## 📊 Tabelas Auxiliares

### 14. Settings (Configurações do Sistema)
```sql
CREATE TABLE settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    key VARCHAR(100) UNIQUE NOT NULL,
    value TEXT NULL,
    type VARCHAR(20) DEFAULT 'string' COMMENT 'string, int, boolean, json',
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_key (key)
);
```

### 15. Tags (Etiquetas/Categorias)
```sql
CREATE TABLE tags (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    type VARCHAR(50) NULL COMMENT 'lead_tag, company_tag, etc.',
    color VARCHAR(7) NULL COMMENT 'Cor HEX',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_type (type)
);
```

### 16. Taggables (Pivot Polimórfico)
```sql
CREATE TABLE taggables (
    tag_id BIGINT UNSIGNED NOT NULL,
    taggable_type VARCHAR(50) NOT NULL,
    taggable_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (tag_id, taggable_type, taggable_id),
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE,
    INDEX idx_taggable (taggable_type, taggable_id)
);
```

---

## 🎨 Convenções Adotadas

### Nomenclatura
- ✅ Tabelas em plural: `users`, `leads`, `companies`
- ✅ Colunas em snake_case: `first_name`, `created_at`
- ✅ Foreign keys: `user_id`, `company_id`
- ✅ Timestamps: `created_at`, `updated_at`, `deleted_at`

### Tipos de Dados
- ✅ IDs: `BIGINT UNSIGNED AUTO_INCREMENT`
- ✅ Valores monetários: `DECIMAL(10, 2)` (centavos em INT também é opção)
- ✅ Enums: Para campos com valores fixos e limitados
- ✅ JSON: Para dados flexíveis/dinâmicos
- ✅ TEXT: Para conteúdos longos

### Índices
- ✅ Primary keys em todos as tabelas
- ✅ Foreign keys com índices
- ✅ Índices em campos frequentemente consultados
- ✅ Índices compostos quando necessário

### Soft Deletes
- ✅ `deleted_at` em tabelas principais (users, leads, companies)
- ❌ Não usar em tabelas de log/auditoria

---

## 🚀 Próximos Passos

1. **Revisar e Validar**
   - [ ] Revisar proposta com equipe
   - [ ] Validar com stakeholders
   - [ ] Ajustar conforme necessidades específicas

2. **Criar Migrations Laravel**
   - [ ] Implementar migrations na ordem correta
   - [ ] Adicionar seeds para dados iniciais
   - [ ] Testar rollback das migrations

3. **Criar Models Eloquent**
   - [ ] Models com relationships definidos
   - [ ] Mutators e Accessors quando necessário
   - [ ] Scopes para queries comuns

4. **Testes**
   - [ ] Testes de integridade referencial
   - [ ] Testes de constraints
   - [ ] Performance testing com dados simulados

---

**Nota:** Esta é uma proposta inicial (MVP). Ajustes e novas tabelas podem ser necessários conforme o projeto evolui.

**Data:** 2025-11-19  
**Versão:** 1.0
