# SCWP Admin UI - Design System

Um design system moderno e reutilizável para plugins de WordPress admin, baseado nos plugins que se têm vindo a desenvolver.

## 🎨 Características

- **Consistência Visual**: Paleta de cores e tipografia unificada
- **Componentes Modernos**: Cards, botões, formulários e navegação
- **Responsivo**: Funciona em todos os tamanhos de ecrã
- **WordPress Native**: Integra-se perfeitamente com o admin do WordPress
- **CSS Variables**: Fácil customização e tematização
- **Utility Classes**: Classes utilitárias para estilização rápida

## 📦 Instalação

### Opção 1: CSS Completo
```html
<link rel="stylesheet" href="scwp-admin-ui-complete.css">
```

### Opção 2: Modular
```html
<link rel="stylesheet" href="scwp-admin-ui-variables.css">
<link rel="stylesheet" href="scwp-admin-ui-components.css">
<link rel="stylesheet" href="scwp-admin-ui-utilities.css">
```

### WordPress Plugin
```php
// No seu plugin
function enqueue_scwp_admin_ui() {
    wp_enqueue_style(
        'scwp-admin-ui',
        plugin_dir_url(__FILE__) . 'assets/css/scwp-admin-ui.css',
        array(),
        '1.0.0'
    );
}
add_action('admin_enqueue_scripts', 'enqueue_scwp_admin_ui');
```

## 🧩 Componentes Principais

### Dashboard Cards
```html
<div class="scwp-dashboard">
    <div class="scwp-dashboard__cards">
        <div class="scwp-card scwp-card--primary">
            <div class="scwp-card__header">
                <h3 class="scwp-card__title">Título do Card</h3>
                <span class="scwp-card__icon">📊</span>
            </div>
            <div class="scwp-card__content">
                <span class="scwp-card__count">42</span>
                <p class="scwp-card__description">Descrição do card</p>
            </div>
            <div class="scwp-card__actions">
                <button class="scwp-btn scwp-btn--primary">Ação</button>
            </div>
        </div>
    </div>
</div>
```

### Navegação
```html
<nav class="scwp-nav-tabs">
    <a href="#" class="scwp-nav-tab scwp-nav-tab--active">Ativo</a>
    <a href="#" class="scwp-nav-tab">Normal</a>
    <a href="#" class="scwp-nav-tab">Outro</a>
</nav>
```

### Botões
```html
<button class="scwp-btn scwp-btn--primary">Primary</button>
<button class="scwp-btn scwp-btn--secondary">Secondary</button>
<button class="scwp-btn scwp-btn--success">Success</button>
<button class="scwp-btn scwp-btn--danger">Danger</button>
```

### Formulários
```html
<div class="scwp-form-group">
    <label class="scwp-label" for="input">Label</label>
    <input type="text" id="input" class="scwp-input" placeholder="Placeholder">
</div>

<!-- Toggle Switch -->
<div class="scwp-flex scwp-items-center scwp-gap-3">
    <label class="scwp-toggle">
        <input type="checkbox" class="scwp-toggle__input">
        <span class="scwp-toggle__slider"></span>
    </label>
    <span class="scwp-label">Setting Name</span>
</div>
```

### Notificações
```html
<div class="scwp-notification scwp-notification--success">
    <strong>Sucesso!</strong> Operação concluída.
</div>
```

## 🎨 Variantes de Cores

- **Primary**: `scwp-card--primary` (Azul principal)
- **Success**: `scwp-card--success` (Verde sucesso)
- **Warning**: `scwp-card--warning` (Amarelo aviso)
- **Danger**: `scwp-card--danger` (Vermelho perigo)

## 🔧 Customização

### CSS Variables
```css
:root {
    --scwp-primary: #4383f0;          /* Cor principal */
    --scwp-success: #00a32a;          /* Cor de sucesso */
    --scwp-warning: #dba617;          /* Cor de aviso */
    --scwp-danger: #dc3232;           /* Cor de erro */
    --scwp-border-radius: 6px;        /* Raio da borda */
    --scwp-font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}
```

### Tema Personalizado
```css
/* Tema escuro personalizado */
.scwp-ui.dark-theme {
    --scwp-white: #2d2d2d;
    --scwp-wp-background: #1e1e1e;
    --scwp-wp-text: #ffffff;
    --scwp-wp-border: #444444;
}
```

## 📱 Classes Utilitárias

### Spacing
- `scwp-m-{0-8}` - Margin
- `scwp-p-{0-8}` - Padding
- `scwp-mt-{0-8}` - Margin top
- `scwp-mb-{0-8}` - Margin bottom

### Typography
- `scwp-text-{xs|sm|base|lg|xl|2xl|3xl}` - Tamanhos de texto
- `scwp-font-{normal|medium|semibold|bold}` - Pesos de fonte
- `scwp-text-{left|center|right}` - Alinhamento

### Layout
- `scwp-flex` - Display flex
- `scwp-grid` - Display grid
- `scwp-items-center` - Align items center
- `scwp-justify-between` - Justify content space-between
- `scwp-gap-{1-6}` - Gap entre elementos

### Cores
- `scwp-text-primary` - Texto cor primária
- `scwp-bg-primary` - Fundo cor primária
- `scwp-border-primary` - Borda cor primária

## 💡 Exemplos de Uso

### Plugin Dashboard Simples
```php
function render_plugin_dashboard() {
    ?>
    <div class="scwp-ui">
        <div class="scwp-dashboard">
            <div class="scwp-dashboard__cards">
                <div class="scwp-card scwp-card--primary">
                    <div class="scwp-card__header">
                        <h3 class="scwp-card__title">Total Users</h3>
                        <span class="scwp-card__icon">👥</span>
                    </div>
                    <div class="scwp-card__content">
                        <span class="scwp-card__count"><?php echo wp_count_posts()->publish; ?></span>
                        <p class="scwp-card__description">Active users in system</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
```

### Settings Page
```php
function render_settings_page() {
    ?>
    <div class="scwp-ui">
        <nav class="scwp-nav-tabs">
            <a href="#general" class="scwp-nav-tab scwp-nav-tab--active">General</a>
            <a href="#advanced" class="scwp-nav-tab">Advanced</a>
        </nav>
        
        <form method="post">
            <div class="scwp-form-group">
                <label class="scwp-label">Plugin Name</label>
                <input type="text" class="scwp-input" name="plugin_name">
            </div>
            
            <div class="scwp-form-group">
                <div class="scwp-flex scwp-items-center scwp-gap-3">
                    <label class="scwp-toggle">
                        <input type="checkbox" class="scwp-toggle__input" name="enable_feature">
                        <span class="scwp-toggle__slider"></span>
                    </label>
                    <span class="scwp-label">Enable Feature</span>
                </div>
            </div>
            
            <button type="submit" class="scwp-btn scwp-btn--primary">Save Settings</button>
        </form>
    </div>
    <?php
}
```

## 🔄 Versionamento

- **v1.0.0** - Release inicial baseado no WordPress HTML Debugger
- Usa Semantic Versioning (SemVer)

## 🤝 Contribuição

1. Fork do repositório
2. Crie uma branch para a feature
3. Commit das alterações
4. Push para a branch
5. Abra um Pull Request

## 📄 Licença

GPL v2 or later - compatível com WordPress

## 🎯 Roadmap

- [ ] Componente de tabelas
- [ ] Modal/Dialog system
- [ ] Drag & drop components
- [ ] Charts integration
- [ ] Dark mode automático
- [ ] Right-to-left (RTL) support
- [ ] Accessibility enhancements
- [ ] JavaScript components library

---

**Criado por Pedro Matias** | Baseado no WordPress HTML Debugger Plugin