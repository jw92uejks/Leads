# ✅ Checklist de Discussão - Modelagem do Banco de Dados

Use este checklist durante as reuniões de planejamento da modelagem do banco de dados.

---

## 🎯 Antes da Reunião

- [ ] Todos leram o documento de perguntas (`DATABASE_MODELING_QUESTIONS.md`)
- [ ] Todos revisaram a proposta de schema (`DATABASE_SCHEMA_PROPOSAL.md`)
- [ ] Participantes prepararam suas dúvidas e sugestões
- [ ] Definir facilitador da reunião
- [ ] Definir pessoa para tomar notas/atas

---

## 📝 Durante a Reunião

### Parte 1: Definição de Escopo (30 min)
- [ ] Definir objetivos do MVP (Mínimo Produto Viável)
- [ ] Listar funcionalidades essenciais vs. desejáveis
- [ ] Estabelecer prioridades (o que desenvolver primeiro?)
- [ ] Definir cronograma macro (quando cada parte será implementada?)

### Parte 2: Entidades Principais (45 min)
- [ ] **Leads**
  - [ ] Campos obrigatórios definidos
  - [ ] Campos opcionais definidos
  - [ ] Sistema de pontuação/qualificação decidido
  - [ ] Regras de duplicação estabelecidas
  
- [ ] **Usuários**
  - [ ] Tipos de usuários definidos
  - [ ] Sistema de permissões decidido (simples ou granular?)
  - [ ] Campos de perfil estabelecidos
  
- [ ] **Empresas**
  - [ ] Necessidade confirmada (sim/não)
  - [ ] Campos essenciais definidos
  - [ ] Relacionamento com leads estabelecido
  
- [ ] **Transações**
  - [ ] Fluxo de venda de leads definido
  - [ ] Lead exclusivo vs. compartilhado decidido
  - [ ] Sistema de precificação estabelecido

### Parte 3: Regras de Negócio (30 min)
- [ ] **Venda de Leads**
  - [ ] Quantas vezes um lead pode ser vendido?
  - [ ] Preço fixo ou dinâmico?
  - [ ] Validação de qualidade antes da venda?
  
- [ ] **Pagamentos**
  - [ ] Gateway de pagamento escolhido
  - [ ] Sistema de créditos necessário?
  - [ ] Comissões da plataforma definidas
  
- [ ] **Devoluções/Reembolsos**
  - [ ] Prazo para devolução estabelecido
  - [ ] Critérios de lead inválido definidos
  - [ ] Processo de reembolso estabelecido

### Parte 4: Compliance e Segurança (20 min)
- [ ] **LGPD/GDPR**
  - [ ] Sistema de consentimento definido
  - [ ] Dados sensíveis identificados
  - [ ] Estratégia de criptografia estabelecida
  - [ ] Processo de exclusão de dados definido
  
- [ ] **Auditoria**
  - [ ] Ações a serem auditadas listadas
  - [ ] Retenção de logs definida
  - [ ] Formato de logs estabelecido

### Parte 5: Integrações (15 min)
- [ ] **Integrações Obrigatórias**
  - [ ] Listadas e priorizadas
  - [ ] APIs necessárias identificadas
  
- [ ] **API do Sistema**
  - [ ] Necessidade confirmada
  - [ ] Endpoints essenciais listados

### Parte 6: Performance e Escalabilidade (20 min)
- [ ] **Estimativas**
  - [ ] Volume inicial de dados estimado
  - [ ] Taxa de crescimento estimada
  - [ ] Carga esperada (usuários simultâneos, transações/dia)
  
- [ ] **Otimizações**
  - [ ] Necessidade de cache identificada
  - [ ] Índices críticos listados
  - [ ] Estratégia de arquivamento definida

---

## 🎨 Decisões Técnicas

### Convenções
- [ ] Nomenclatura de tabelas decidida (singular/plural)
- [ ] Padrão de nomenclatura de colunas estabelecido
- [ ] Prefixos/sufixos definidos

### Tipos de Dados
- [ ] IDs: auto-increment ou UUID?
- [ ] Valores monetários: DECIMAL ou INT (centavos)?
- [ ] Timestamps em todas as tabelas?
- [ ] Soft deletes: em quais tabelas?

### Estrutura
- [ ] Relacionamentos many-to-many identificados
- [ ] Tabelas pivot necessárias listadas
- [ ] Campos JSON/flexíveis identificados

---

## 📊 Documentação

### Durante a Discussão
- [ ] Decisões registradas em documento
- [ ] Dúvidas não resolvidas documentadas
- [ ] Responsáveis por pesquisas adicionais definidos
- [ ] Pontos de atenção/riscos anotados

### Após a Discussão
- [ ] Criar/atualizar diagrama ER
- [ ] Documentar dicionário de dados
- [ ] Criar lista de migrations necessárias
- [ ] Definir ordem de implementação
- [ ] Agendar revisão técnica

---

## 🚀 Próximas Ações

### Imediato (Esta Semana)
- [ ] Criar diagrama ER final
- [ ] Implementar migrations do MVP
- [ ] Configurar banco de dados (dev/staging)
- [ ] Criar seeds para testes

### Curto Prazo (Próximas 2 Semanas)
- [ ] Implementar models Eloquent
- [ ] Adicionar relationships
- [ ] Criar factories para testes
- [ ] Implementar validações básicas

### Médio Prazo (Próximo Mês)
- [ ] Otimizar queries críticas
- [ ] Implementar cache estratégico
- [ ] Adicionar índices de performance
- [ ] Testes de carga

---

## 📋 Template de Decisão

Use este template para documentar cada decisão importante:

```markdown
### Decisão: [Título]
**Data:** YYYY-MM-DD
**Participantes:** Nome1, Nome2, Nome3

**Contexto:**
[Descrever a situação que levou à necessidade de decisão]

**Opções Consideradas:**
1. Opção A: [descrição]
   - Prós: ...
   - Contras: ...
2. Opção B: [descrição]
   - Prós: ...
   - Contras: ...

**Decisão Tomada:**
[Opção escolhida e justificativa]

**Impactos:**
- Desenvolvimento: ...
- Performance: ...
- Manutenção: ...
- Custo: ...

**Responsável:** [Nome]
**Prazo:** [Data]

---
```

---

## 🎯 Critérios de Sucesso

A modelagem estará completa quando:
- [ ] Todas as entidades principais estão definidas
- [ ] Todos os relacionamentos estão mapeados
- [ ] Regras de negócio críticas estão documentadas
- [ ] Compliance LGPD está garantido
- [ ] Performance inicial está considerada
- [ ] Equipe está alinhada e confiante

---

## 📞 Contatos Úteis

**Especialistas para Consulta:**
- Arquitetura: [Nome/Email]
- Segurança: [Nome/Email]
- LGPD/Compliance: [Nome/Email]
- DevOps: [Nome/Email]

**Documentação de Referência:**
- Laravel Database: https://laravel.com/docs/migrations
- MySQL Best Practices: [link]
- Schema Design Patterns: [link]

---

## 📝 Notas da Reunião

**Data:** ___/___/___  
**Participantes:** ______________________  
**Facilitador:** ______________________

### Principais Decisões
1. 
2. 
3. 

### Dúvidas Pendentes
1. 
2. 
3. 

### Ações com Responsáveis
| Ação | Responsável | Prazo |
|------|-------------|-------|
|      |             |       |
|      |             |       |
|      |             |       |

### Próxima Reunião
**Data:** ___/___/___  
**Pauta:** ______________________

---

**Versão:** 1.0  
**Última Atualização:** 2025-11-19
