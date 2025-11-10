<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Consent Manager - Settings</title>
    <link rel="stylesheet" href="css/scwp-admin-ui.css">
    <style>
        .admin-header {
            background: #23282d;
            color: white;
            padding: 10px 20px;
            margin: -8px -12px 20px -12px;
        }
        .admin-header h1 {
            margin: 0;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="scwp-wrap--ccm">
        <div class="admin-header">
            <h1>🍪 Cookie Consent Manager</h1>
        </div>

        <div class="scwp-logo-header--ccm">
            <h2 style="margin: 0; color: var(--scwp-primary);">Plugin Configuration</h2>
            <p style="margin: 0; color: var(--scwp-wp-text-light);">Configure your cookie consent banner and privacy settings</p>
        </div>

        <!-- Main Settings Form -->
        <form class="scwp-card--ccm" method="post" action="">
            <h2 class="scwp-card__title">Cookie Banner Settings</h2>
            
            <h3 class="scwp-card__subtitle">General Configuration</h3>
            <div class="scwp-form-container--ccm">
                <div>
                    <label class="scwp-label--ccm">Cookie Banner Message</label>
                    <textarea 
                        class="scwp-textarea--ccm" 
                        name="cookie_message" 
                        placeholder="Enter your cookie consent message..."><?php echo htmlspecialchars('Usamos cookies para garantir que oferecemos a melhor experiência no nosso site. Você pode escolher apenas os cookies necessários ou pode aceitar todos os cookies.'); ?></textarea>
                    <span class="scwp-label--ccm-description">This message will be displayed to visitors when they first visit your site</span>
                </div>

                <div>
                    <label class="scwp-label--ccm">Privacy Policy Page URL</label>
                    <input 
                        type="url" 
                        class="scwp-input--ccm" 
                        name="privacy_url"
                        placeholder="https://yoursite.com/privacy-policy"
                        value="<?php echo htmlspecialchars('/privacy-policy'); ?>">
                    <span class="scwp-label--ccm-description">Link to your privacy policy page</span>
                </div>

                <div>
                    <label class="scwp-label--ccm">API Key (IP Geolocation)</label>
                    <input 
                        type="text" 
                        class="scwp-input--ccm scwp-input--ccm-api" 
                        name="api_key"
                        placeholder="Enter your API key">
                    <span class="scwp-label--ccm-description">Optional: For location-based cookie compliance</span>
                </div>
            </div>

            <h3 class="scwp-card__subtitle">Banner Positioning</h3>
            <div class="scwp-form-container--ccm">
                <div>
                    <label class="scwp-label--ccm">Choose Banner Position</label>
                    <div class="scwp-position-selector scwp-position-selector--ccm">
                        <div class="scwp-position-selector__screen">
                            <input type="radio" name="banner_position" value="top-left" id="pos-tl" style="display: none;">
                            <input type="radio" name="banner_position" value="top-right" id="pos-tr" checked style="display: none;">
                            <input type="radio" name="banner_position" value="bottom-left" id="pos-bl" style="display: none;">
                            <input type="radio" name="banner_position" value="bottom-right" id="pos-br" style="display: none;">
                            
                            <label for="pos-tl" class="scwp-position-selector__option" data-position="top-left"></label>
                            <label for="pos-tr" class="scwp-position-selector__option selected" data-position="top-right"></label>
                            <label for="pos-bl" class="scwp-position-selector__option" data-position="bottom-left"></label>
                            <label for="pos-br" class="scwp-position-selector__option" data-position="bottom-right"></label>
                        </div>
                        <div class="scwp-position-selector__buttons">
                            <button type="button" class="scwp-btn scwp-btn--primary" onclick="previewBanner()">Preview Banner</button>
                            <button type="button" class="scwp-btn scwp-btn--ccm-copy" onclick="copyDefaultMessage()">Copy Default Message</button>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="scwp-card__subtitle">Action Buttons</h3>
            <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-top: 20px;">
                <button type="submit" class="scwp-btn scwp-btn--ccm-primary" name="save_settings">
                    💾 Save Settings
                </button>
                <button type="button" class="scwp-btn scwp-btn--ccm-copy" onclick="exportSettings()">
                    📤 Export Settings
                </button>
                <button type="button" class="scwp-btn scwp-btn--ccm-reset" onclick="confirmReset()">
                    🗑️ Reset to Defaults
                </button>
            </div>
        </form>

        <!-- Advanced Settings -->
        <form class="scwp-card--ccm" method="post" action="">
            <h2 class="scwp-card__title">Advanced Settings</h2>
            
            <h3 class="scwp-card__subtitle">Cookie Categories</h3>
            <div class="scwp-form-container--ccm">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    <div>
                        <label class="scwp-label--ccm">
                            <input type="checkbox" checked disabled style="margin-right: 8px;">
                            Essential Cookies
                        </label>
                        <span class="scwp-label--ccm-description">Required for basic site functionality (cannot be disabled)</span>
                    </div>
                    <div>
                        <label class="scwp-label--ccm">
                            <input type="checkbox" name="analytics_cookies" style="margin-right: 8px;">
                            Analytics Cookies
                        </label>
                        <span class="scwp-label--ccm-description">Help us understand how visitors use our site</span>
                    </div>
                    <div>
                        <label class="scwp-label--ccm">
                            <input type="checkbox" name="marketing_cookies" style="margin-right: 8px;">
                            Marketing Cookies
                        </label>
                        <span class="scwp-label--ccm-description">Used for targeted advertising and personalization</span>
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="scwp-btn scwp-btn--ccm-primary" name="save_advanced">
                    Save Advanced Settings
                </button>
            </div>
        </form>

        <!-- Comparison with SCWP Styles -->
        <div class="scwp-card scwp-card--primary">
            <div class="scwp-card__header">
                <h3 class="scwp-card__title">💡 SCWP vs CCM Styling</h3>
            </div>
            <div class="scwp-card__content">
                <p>Compare os estilos SCWP (este card) com CCM (cards acima). Note as diferenças:</p>
                <ul>
                    <li><strong>SCWP:</strong> Border colorido, hover effects, CSS custom properties</li>
                    <li><strong>CCM:</strong> Styling mais limpo, cores fixas, sem hover effects</li>
                </ul>
                <div style="display: flex; gap: 12px; margin-top: 16px;">
                    <button class="scwp-btn scwp-btn--primary">SCWP Button</button>
                    <button class="scwp-btn scwp-btn--ccm-primary">CCM Button</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Position selector functionality
        document.addEventListener('DOMContentLoaded', function() {
            const options = document.querySelectorAll('.scwp-position-selector__option');
            options.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove selected class from all options
                    options.forEach(opt => opt.classList.remove('selected'));
                    // Add selected to clicked option
                    this.classList.add('selected');
                    
                    // Check corresponding radio button
                    const position = this.dataset.position;
                    const radio = document.querySelector(`input[value="${position}"]`);
                    if (radio) radio.checked = true;
                });
            });
        });

        function previewBanner() {
            // Remove existing preview
            const existing = document.querySelector('.ccm-preview-banner');
            if (existing) existing.remove();

            // Get selected position
            const selectedOption = document.querySelector('.scwp-position-selector__option.selected');
            const position = selectedOption ? selectedOption.dataset.position : 'top-right';
            
            // Get message
            const message = document.querySelector('textarea[name="cookie_message"]').value;

            // Create banner
            const banner = document.createElement('div');
            banner.className = `scwp-cookie-banner scwp-cookie-banner--${position} ccm-preview-banner`;
            banner.innerHTML = `
                <div class="scwp-cookie-banner__message">${message}</div>
                <div class="scwp-cookie-banner__actions">
                    <button class="scwp-btn scwp-btn--primary" onclick="this.parentElement.parentElement.remove()">Accept All</button>
                    <button class="scwp-btn scwp-btn--secondary" onclick="this.parentElement.parentElement.remove()">Reject</button>
                </div>
            `;
            
            document.body.appendChild(banner);
            
            // Auto remove after 8 seconds
            setTimeout(() => {
                if (banner && banner.parentNode) {
                    banner.remove();
                }
            }, 8000);
        }

        function copyDefaultMessage() {
            const textarea = document.querySelector('textarea[name="cookie_message"]');
            const defaultMsg = "Usamos cookies para garantir que oferecemos a melhor experiência no nosso site. Você pode escolher apenas os cookies necessários ou pode aceitar todos os cookies.";
            textarea.value = defaultMsg;
            textarea.focus();
            
            // Visual feedback
            const btn = event.target;
            const originalText = btn.textContent;
            btn.textContent = '✓ Copied!';
            btn.style.background = '#00a32a';
            setTimeout(() => {
                btn.textContent = originalText;
                btn.style.background = '';
            }, 2000);
        }

        function exportSettings() {
            const formData = new FormData(document.querySelector('form'));
            const settings = {};
            for (let [key, value] of formData.entries()) {
                settings[key] = value;
            }
            
            const jsonString = JSON.stringify(settings, null, 2);
            const blob = new Blob([jsonString], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            
            const a = document.createElement('a');
            a.href = url;
            a.download = 'ccm-settings.json';
            a.click();
            
            URL.revokeObjectURL(url);
        }

        function confirmReset() {
            if (confirm('Are you sure you want to reset all settings to defaults? This action cannot be undone.')) {
                // Reset form
                document.querySelector('form').reset();
                // Reset position selector to top-right
                document.querySelectorAll('.scwp-position-selector__option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                document.querySelector('[data-position="top-right"]').classList.add('selected');
                document.querySelector('input[value="top-right"]').checked = true;
                
                alert('Settings have been reset to defaults.');
            }
        }

        // Form submission feedback
        document.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = e.target.querySelector('button[type="submit"]');
            const originalText = btn.textContent;
            btn.textContent = '⏳ Saving...';
            btn.disabled = true;
            
            // Simulate save
            setTimeout(() => {
                btn.textContent = '✅ Saved!';
                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.disabled = false;
                }, 1500);
            }, 1000);
        });
    </script>
</body>
</html>