# 🗂️ Perguntas para Modelagem do Banco de Dados - Mercado de Leads

Este documento contém perguntas essenciais para discutir a modelagem do banco de dados do sistema de Mercado de Leads com a equipe.

---

## 📊 1. Entidades Principais do Sistema

### 1.1 Leads
- [ ] **Quais informações básicas precisamos armazenar sobre cada lead?**
  - Nome, email, telefone, empresa?
  - Cargo/posição?
  - Localização (cidade, estado, país)?
  - Como lidar com leads internacionais?

- [ ] **Como vamos categorizar os leads?**
  - Por segmento de mercado (B2B, B2C, etc.)?
  - Por interesse/produto?
  - Por estágio do funil (cold, warm, hot)?
  - Por score/qualificação?

- [ ] **Precisamos manter histórico de mudanças nos dados do lead?**
  - Usar soft deletes?
  - Criar tabela de auditoria/histórico?
  - Registrar quem e quando fez alterações?

- [ ] **Como gerenciar leads duplicados?**
  - Precisamos de verificação automática?
  - Como identificar duplicatas (email, telefone, outros)?
  - Processo de merge de leads duplicados?

### 1.2 Empresas/Organizações
- [ ] **Vamos separar leads de empresas?**
  - Um lead pode pertencer a múltiplas empresas?
  - Uma empresa pode ter múltiplos leads?
  - Como relacionar leads com empresas?

- [ ] **Quais dados da empresa são essenciais?**
  - Razão social, nome fantasia?
  - CNPJ/documento fiscal?
  - Porte da empresa (MEI, pequena, média, grande)?
  - Faturamento estimado?
  - Número de funcionários?
  - Segmento de atuação?

### 1.3 Usuários do Sistema
- [ ] **Quais tipos de usuários teremos?**
  - Administradores?
  - Vendedores/Compradores de leads?
  - Gerentes de equipe?
  - Suporte?

- [ ] **Precisamos de sistema de permissões granular?**
  - Roles e permissions separados?
  - Usar pacote (Spatie Permission, etc.)?
  - ACL personalizado?

- [ ] **Como gerenciar perfis de vendedores?**
  - Comissões e pagamentos?
  - Histórico de vendas?
  - Avaliações e reputação?

### 1.4 Campanhas/Fontes de Leads
- [ ] **Como rastrear a origem dos leads?**
  - Por campanha de marketing?
  - Por canal (Facebook, Google, email, etc.)?
  - Por landing page específica?
  - UTM parameters?

- [ ] **Precisamos de tabela de campanhas?**
  - Nome, descrição, data início/fim?
  - Budget/investimento?
  - ROI e métricas?
  - Status ativo/inativo?

---

## 🔗 2. Relacionamentos e Regras de Negócio

### 2.1 Transações/Vendas de Leads
- [ ] **Como funciona a venda de leads?**
  - Um lead pode ser vendido múltiplas vezes?
  - Lead exclusivo vs. lead compartilhado?
  - Preço fixo ou leilão?

- [ ] **Precisamos rastrear tentativas de contato?**
  - Histórico de ligações, emails, mensagens?
  - Status de cada tentativa (sucesso, sem resposta, etc.)?
  - Integração com telefonia/email?

- [ ] **Como gerenciar devoluções/reembolsos?**
  - Lead inválido/duplicado?
  - Prazo para devolução?
  - Processo de validação?

### 2.2 Qualificação e Enriquecimento
- [ ] **Vamos implementar sistema de pontuação (lead scoring)?**
  - Quais critérios usar?
  - Pontuação automática ou manual?
  - Tabela separada para histórico de pontuação?

- [ ] **Enriquecimento de dados:**
  - Integração com APIs externas (CNPJ, LinkedIn, etc.)?
  - Cache de dados enriquecidos?
  - Frequência de atualização?

### 2.3 Notificações e Comunicação
- [ ] **Sistema de notificações:**
  - Notificações em tempo real?
  - Email, SMS, push notifications?
  - Preferências de notificação por usuário?
  - Tabela de notificações ou fila?

---

## 💰 3. Aspectos Financeiros

### 3.1 Precificação
- [ ] **Como definir preço dos leads?**
  - Preço por qualidade/score?
  - Preço por segmento/categoria?
  - Preço dinâmico baseado em demanda?
  - Tabela de preços históricos?

### 3.2 Pagamentos e Comissões
- [ ] **Sistema de pagamentos:**
  - Gateway de pagamento (Stripe, PayPal, etc.)?
  - Múltiplas formas de pagamento?
  - Parcelamento?
  - Tabela de transações financeiras?

- [ ] **Sistema de comissões:**
  - Comissão para vendedores?
  - Comissão para afiliados?
  - Regras de cálculo de comissão?
  - Período de pagamento (semanal, mensal)?

### 3.3 Créditos/Wallet
- [ ] **Sistema de créditos/carteira:**
  - Usuários compram créditos antecipadamente?
  - Histórico de transações de créditos?
  - Validade dos créditos?
  - Sistema de bônus/cashback?

---

## 🔒 4. Segurança e Compliance

### 4.1 Privacidade de Dados (LGPD/GDPR)
- [ ] **Consentimento e privacidade:**
  - Como armazenar consentimento de uso de dados?
  - Data de coleta do consentimento?
  - Direito ao esquecimento (remover dados)?
  - Criptografia de dados sensíveis?

- [ ] **Anonimização:**
  - Dados sensíveis que devem ser anonimizados?
  - Processo de anonimização após determinado período?

### 4.2 Auditoria
- [ ] **Logs de auditoria:**
  - Quais ações devem ser auditadas?
  - Quanto tempo manter logs?
  - Informações a registrar (user_id, IP, timestamp, ação)?
  - Usar pacote de auditoria (Laravel Auditing, etc.)?

---

## 📈 5. Escalabilidade e Performance

### 5.1 Volume de Dados
- [ ] **Estimativa de crescimento:**
  - Quantos leads esperamos armazenar?
  - Taxa de crescimento mensal/anual?
  - Necessidade de particionamento de tabelas?
  - Estratégia de arquivamento de dados antigos?

### 5.2 Índices e Otimização
- [ ] **Quais consultas serão mais frequentes?**
  - Busca de leads por filtros específicos?
  - Relatórios e dashboards?
  - Índices compostos necessários?

- [ ] **Cache:**
  - Quais dados devem ser cacheados?
  - Usar Redis/Memcached?
  - Estratégia de invalidação de cache?

### 5.3 Filas e Jobs Assíncronos
- [ ] **Processamento assíncrono:**
  - Envio de emails/notificações em fila?
  - Enriquecimento de dados em background?
  - Geração de relatórios pesados?
  - Usar Redis ou banco de dados para filas?

---

## 📱 6. Integrações e APIs

### 6.1 Integrações Externas
- [ ] **Quais integrações serão necessárias?**
  - CRM (Salesforce, HubSpot, RD Station)?
  - Email marketing (Mailchimp, SendGrid)?
  - Telefonia (Twilio, etc.)?
  - Redes sociais?
  - Análise de dados (Google Analytics)?

- [ ] **Como armazenar tokens e credenciais de APIs?**
  - Por usuário ou por sistema?
  - Criptografia de tokens?
  - Refresh tokens?

### 6.2 API do Sistema
- [ ] **Vamos oferecer API para terceiros?**
  - RESTful ou GraphQL?
  - Rate limiting?
  - Versionamento da API?
  - Documentação (Swagger/OpenAPI)?

- [ ] **Webhooks:**
  - Eventos que disparam webhooks?
  - Tabela para registrar webhooks dos clientes?
  - Sistema de retry em caso de falha?

---

## 📊 7. Relatórios e Analytics

### 7.1 Métricas e KPIs
- [ ] **Quais métricas são essenciais?**
  - Taxa de conversão de leads?
  - Custo por lead (CPL)?
  - ROI por campanha?
  - Qualidade média dos leads?
  - Tempo médio de resposta?

### 7.2 Dashboards
- [ ] **Dados agregados:**
  - Tabelas de resumo/agregação?
  - Atualização em tempo real ou batch?
  - Cube/OLAP para análises complexas?

---

## 🗃️ 8. Estrutura Técnica

### 8.1 Convenções
- [ ] **Padrões de nomenclatura:**
  - Snake_case para nomes de tabelas/colunas?
  - Singular ou plural para nomes de tabelas?
  - Prefixos para tabelas relacionadas?

### 8.2 Timestamps e Soft Deletes
- [ ] **created_at, updated_at em todas as tabelas?**
- [ ] **Quais entidades precisam de soft delete?**
- [ ] **deleted_at e deleted_by?**

### 8.3 UUIDs vs IDs Incrementais
- [ ] **Usar UUIDs como chave primária?**
  - Vantagens: segurança, distribuição
  - Desvantagens: performance, tamanho
- [ ] **IDs incrementais são suficientes?**

### 8.4 Tipos de Dados
- [ ] **Campos monetários:**
  - DECIMAL ou INTEGER (em centavos)?
  - Precisão necessária?

- [ ] **Campos de texto:**
  - VARCHAR vs TEXT?
  - Limite de caracteres?

- [ ] **Campos JSON:**
  - Usar JSONB (PostgreSQL) ou JSON?
  - Dados flexíveis/dinâmicos?

---

## 🎯 9. Próximos Passos

### Priorização
- [ ] **Quais entidades implementar primeiro (MVP)?**
  1. Usuários e autenticação
  2. Leads básicos
  3. Transações/vendas
  4. ...

### Documentação
- [ ] **Criar diagrama ER (Entidade-Relacionamento)?**
- [ ] **Documentar regras de negócio de cada tabela?**
- [ ] **Definir dicionário de dados?**

### Validação
- [ ] **Revisão com stakeholders?**
- [ ] **Protótipo para validar modelo?**
- [ ] **Considerar migrations reversíveis?**

---

## 📝 Notas Adicionais

Use este espaço para anotar decisões tomadas, dúvidas pendentes ou considerações especiais:

```
[Espaço para notas da equipe]
```

---

**Data de Criação:** 2025-11-19  
**Versão:** 1.0  
**Responsável:** Equipe de Desenvolvimento
