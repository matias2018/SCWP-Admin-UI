# Conflitos de Elementos - CCM vs SCWP Design System

## Conflitos Identificados e Resolvidos

### 1. Botões ✅ RESOLVIDO
**Conflito**: Ambos os sistemas têm botões, mas com estilos diferentes
- **SCWP**: Usa CSS custom properties (--scwp-primary), border-radius variável, hover effects com transform
- **CCM**: Usa cores fixas (#2271b1), padding específico (12px 24px), sem transform no hover
- **Solução Implementada**: 
  - Classes CCM específicas: `.scwp-btn--ccm-primary`, `.scwp-btn--ccm-copy`, `.scwp-btn--ccm-reset`
  - Mantido SCWP como padrão, CCM como variantes opcionais
  - CCM variants preservam cores e comportamento original

### 2. Form Fields ✅ RESOLVIDO
**Conflito**: Input/textarea styling
- **SCWP**: Estilos básicos com focus padrão
- **CCM**: Focus states avançados com border azul e box-shadow específico
- **Solução Implementada**:
  - Classes CCM específicas: `.scwp-input--ccm`, `.scwp-textarea--ccm`, `.scwp-select--ccm`
  - Labels CCM: `.scwp-label--ccm`, `.scwp-label--ccm-description`
  - Focus state CCM: border-color #2271b1 + box-shadow 0 0 0 1px #2271b1
  - Max-width 600px e padding 12px 16px preservados

### 3. Cards/Containers ✅ RESOLVIDO
**Conflito**: Estruturas de card
- **SCWP**: .scwp-card com CSS custom properties, borders coloridos, hover effects
- **CCM**: form.scml_plugin com estilos específicos, sem borders coloridos
- **Solução Implementada**:
  - Classe principal: `.scwp-card--ccm`
  - Container de formulário: `.scwp-form-container--ccm`
  - Page wrapper: `.scwp-wrap--ccm`, `.scwp-logo-header--ccm`
  - Preserva styling CCM: padding 30px, border-radius 8px, box-shadow específico

### 4. Position Selector ✅ MELHORADO
**Diferença de Estilo**: Cores e contraste
- **SCWP**: Fundo claro, cores suaves
- **CCM**: Fundo escuro (#1d2327), alto contraste
- **Solução Implementada**:
  - Variant classe: `.scwp-position-selector--ccm`
  - Preserva visual CCM com fundo escuro e opções #646970
  - Selecionado fica #2271b1 mantendo identidade CCM

## Elementos Únicos do CCM (Não há conflito)

### 1. Cookie Banner
- Componente totalmente único com posicionamento dinâmico
- Sistema de posições: top-left, top-right, bottom-left, bottom-right
- Responsivo com transform para mobile

### 2. Position Selector Visual
- .simulated-screen com grid 2x2
- .simulated-banner para preview visual
- Componente interativo único

### 3. Copy Default Message Button
- Botão específico com estilo neutro
- Não existe equivalente no SCWP

### 4. Reset/Danger Button
- Botão de reset com cor vermelha (#d63638)
- Estilo específico para ações destrutivas

## Status da Implementação

✅ **CONCLUÍDO**: Todos os conflitos foram resolvidos com sucesso
✅ **VARIANTES CCM**: Implementadas com classes específicas
✅ **COMPATIBILIDADE**: SCWP mantido como padrão, CCM como opção
✅ **DOCUMENTAÇÃO**: Exemplos comparativos na página de demonstração

## Guia de Uso

### Para usar estilos SCWP (padrão):
```html
<button class="scwp-btn scwp-btn--primary">SCWP Button</button>
<input class="scwp-input" type="text">
<div class="scwp-card scwp-card--primary">SCWP Card</div>
```

### Para usar estilos CCM (variantes):
```html
<button class="scwp-btn scwp-btn--ccm-primary">CCM Button</button>
<input class="scwp-input--ccm" type="text">
<div class="scwp-card--ccm">CCM Container</div>
```

### Recomendações de Uso:
1. **Use SCWP** para novos projetos e consistência geral
2. **Use CCM variants** quando precisar manter compatibilidade com CCM plugin
3. **Misture conforme necessário** - ambos são totalmente compatíveis
4. **Consulte a seção "CCM Variants"** na página demo para exemplos visuais

---
*Documento criado automaticamente durante análise CCM → SCWP*
*Data: 2025-11-10 | Atualizado: Conflitos Resolvidos*