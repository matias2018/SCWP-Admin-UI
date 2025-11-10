<?php
/**
 * Example WordPress Plugin using SCWP Design System with CCM Variants
 * 
 * This demonstrates how to integrate both SCWP and CCM components
 * in a real WordPress plugin context.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue SCWP Design System styles
 */
function enqueue_scwp_styles() {
    wp_enqueue_style(
        'scwp-admin-ui',
        plugin_dir_url(__FILE__) . 'css/scwp-admin-ui.css',
        array(),
        '1.0.0'
    );
}
add_action('admin_enqueue_scripts', 'enqueue_scwp_styles');

/**
 * Main plugin settings page using CCM variants
 */
function render_main_settings_page() {
    // Handle form submission
    if (isset($_POST['save_settings'])) {
        // Save settings logic here
        update_option('example_cookie_message', sanitize_textarea_field($_POST['cookie_message']));
        update_option('example_banner_position', sanitize_text_field($_POST['banner_position']));
        update_option('example_api_key', sanitize_text_field($_POST['api_key']));
        
        echo '<div class="notice notice-success"><p><strong>Settings saved!</strong></p></div>';
    }
    
    // Get current settings
    $cookie_message = get_option('example_cookie_message', 'We use cookies to enhance your browsing experience.');
    $banner_position = get_option('example_banner_position', 'bottom-right');
    $api_key = get_option('example_api_key', '');
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plugin Settings - WordPress Admin</title>
        <link rel="stylesheet" href="css/scwp-admin-ui.css">
        <style>
            .wp-admin-style {
                background: #f1f1f1;
                margin: 20px 0 0 -20px;
                padding: 0;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            }
        </style>
    </head>
    <body class="wp-admin-style">
        <div class="scwp-wrap--ccm">
            <!-- Page Header -->
            <div class="scwp-logo-header--ccm">
                <h1 style="margin: 0; color: #23282d;">🍪 Cookie Manager Pro</h1>
                <p style="margin: 0; color: #646970;">WordPress Plugin Settings • Version 2.1.0</p>
            </div>

            <!-- Main Settings Form (CCM Style) -->
            <form method="post" class="scwp-card--ccm">
                <h2 class="scwp-card__title">Cookie Consent Settings</h2>
                
                <h3 class="scwp-card__subtitle">Basic Configuration</h3>
                <div class="scwp-form-container--ccm">
                    <div>
                        <label class="scwp-label--ccm" for="cookie_message">Cookie Banner Message</label>
                        <textarea 
                            id="cookie_message"
                            name="cookie_message" 
                            class="scwp-textarea--ccm"
                            rows="4"
                            placeholder="Enter your cookie consent message..."
                        ><?php echo esc_textarea($cookie_message); ?></textarea>
                        <span class="scwp-label--ccm-description">
                            This message will be displayed to visitors when they first visit your site. 
                            Keep it clear and informative about your cookie usage.
                        </span>
                    </div>

                    <div>
                        <label class="scwp-label--ccm" for="api_key">Geolocation API Key</label>
                        <input 
                            type="text" 
                            id="api_key"
                            name="api_key"
                            class="scwp-input--ccm scwp-input--ccm-api"
                            value="<?php echo esc_attr($api_key); ?>"
                            placeholder="Enter your API key for location-based compliance">
                        <span class="scwp-label--ccm-description">
                            Optional: For GDPR compliance based on visitor location
                        </span>
                    </div>
                </div>

                <h3 class="scwp-card__subtitle">Banner Positioning</h3>
                <div class="scwp-form-container--ccm">
                    <div>
                        <label class="scwp-label--ccm">Choose Banner Position</label>
                        <div class="scwp-position-selector scwp-position-selector--ccm">
                            <div class="scwp-position-selector__screen">
                                <?php
                                $positions = ['top-left', 'top-right', 'bottom-left', 'bottom-right'];
                                foreach ($positions as $position) :
                                    $selected = ($banner_position === $position) ? 'selected' : '';
                                ?>
                                <label class="scwp-position-selector__option <?php echo $selected; ?>" data-position="<?php echo $position; ?>">
                                    <input type="radio" name="banner_position" value="<?php echo $position; ?>" 
                                           <?php checked($banner_position, $position); ?> style="display: none;">
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <span class="scwp-label--ccm-description">
                            Selected position: <strong id="position-display"><?php echo ucwords(str_replace('-', ' ', $banner_position)); ?></strong>
                        </span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0;">
                    <?php wp_nonce_field('save_settings_action', 'settings_nonce'); ?>
                    <button type="submit" name="save_settings" class="scwp-btn scwp-btn--ccm-primary">
                        💾 Save Settings
                    </button>
                    <button type="button" class="scwp-btn scwp-btn--ccm-copy" onclick="previewBanner()">
                        👁️ Preview Banner
                    </button>
                    <button type="button" class="scwp-btn scwp-btn--secondary" onclick="resetForm()">
                        🔄 Reset Form
                    </button>
                </div>
            </form>

            <!-- Analytics Dashboard (SCWP Style for comparison) -->
            <div class="scwp-card scwp-card--primary">
                <div class="scwp-card__header">
                    <h3 class="scwp-card__title">📊 Cookie Analytics</h3>
                    <span class="scwp-card__icon">📈</span>
                </div>
                <div class="scwp-card__content">
                    <p>This section uses <strong>SCWP styling</strong> to show the contrast with CCM variants above.</p>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px 0;">
                        <div style="text-align: center; padding: 15px; background: rgba(67, 131, 240, 0.1); border-radius: 6px;">
                            <div style="font-size: 24px; font-weight: bold; color: var(--scwp-success);">2,847</div>
                            <div style="font-size: 13px; color: var(--scwp-wp-text-light);">Consents Given</div>
                        </div>
                        <div style="text-align: center; padding: 15px; background: rgba(67, 131, 240, 0.1); border-radius: 6px;">
                            <div style="font-size: 24px; font-weight: bold; color: var(--scwp-warning);">423</div>
                            <div style="font-size: 13px; color: var(--scwp-wp-text-light);">Consents Rejected</div>
                        </div>
                        <div style="text-align: center; padding: 15px; background: rgba(67, 131, 240, 0.1); border-radius: 6px;">
                            <div style="font-size: 24px; font-weight: bold; color: var(--scwp-primary);">87.1%</div>
                            <div style="font-size: 13px; color: var(--scwp-wp-text-light);">Acceptance Rate</div>
                        </div>
                    </div>
                </div>
                <div class="scwp-card__actions">
                    <button class="scwp-btn scwp-btn--primary">View Detailed Report</button>
                    <button class="scwp-btn scwp-btn--secondary">Export Data</button>
                </div>
            </div>

            <!-- Quick Actions (Mixed Styles) -->
            <div class="scwp-card--ccm">
                <h2 class="scwp-card__title">Quick Actions</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
                    <div>
                        <h4 style="margin-bottom: 10px; color: #2271b1;">CCM Actions:</h4>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <button class="scwp-btn scwp-btn--ccm-primary" onclick="exportSettings()">📤 Export Settings</button>
                            <button class="scwp-btn scwp-btn--ccm-copy" onclick="duplicateSettings()">📋 Duplicate Config</button>
                        </div>
                    </div>
                    <div>
                        <h4 style="margin-bottom: 10px; color: var(--scwp-primary);">SCWP Actions:</h4>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <button class="scwp-btn scwp-btn--primary" onclick="manageUsers()">👥 Manage Users</button>
                            <button class="scwp-btn scwp-btn--success" onclick="viewLogs()">📋 View Logs</button>
                        </div>
                    </div>
                    <div>
                        <h4 style="margin-bottom: 10px; color: #d63638;">Danger Zone:</h4>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <button class="scwp-btn scwp-btn--ccm-reset" onclick="resetAllData()">🗑️ Clear All Data</button>
                            <button class="scwp-btn scwp-btn--danger" onclick="deactivatePlugin()">⚠️ Deactivate Plugin</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- WordPress Footer Style -->
            <div style="margin-top: 40px; padding: 20px; text-align: center; color: #646970; font-size: 13px; border-top: 1px solid #e0e0e0;">
                <p>Cookie Manager Pro by <strong>Your Company</strong> | Using SCWP Design System with CCM Variants</p>
                <p>WordPress <?php echo get_bloginfo('version'); ?> | PHP <?php echo phpversion(); ?></p>
            </div>
        </div>

        <script>
            // Position selector functionality
            document.addEventListener('DOMContentLoaded', function() {
                const options = document.querySelectorAll('.scwp-position-selector__option');
                const display = document.getElementById('position-display');
                
                options.forEach(option => {
                    option.addEventListener('click', function() {
                        // Remove selected from all options
                        options.forEach(opt => opt.classList.remove('selected'));
                        // Add selected to clicked option
                        this.classList.add('selected');
                        
                        // Update display text
                        const position = this.dataset.position;
                        display.textContent = position.split('-').map(word => 
                            word.charAt(0).toUpperCase() + word.slice(1)
                        ).join(' ');
                        
                        // Check radio button
                        const radio = this.querySelector('input[type="radio"]');
                        if (radio) radio.checked = true;
                    });
                });
            });

            function previewBanner() {
                // Remove existing preview
                const existing = document.querySelector('.wp-preview-banner');
                if (existing) existing.remove();

                // Get form data
                const message = document.getElementById('cookie_message').value;
                const position = document.querySelector('input[name="banner_position"]:checked')?.value || 'bottom-right';

                // Create banner
                const banner = document.createElement('div');
                banner.className = `scwp-cookie-banner scwp-cookie-banner--${position} wp-preview-banner`;
                banner.innerHTML = `
                    <div class="scwp-cookie-banner__message">${message}</div>
                    <div class="scwp-cookie-banner__actions">
                        <button class="scwp-btn scwp-btn--primary" onclick="this.parentElement.parentElement.remove()">Accept All</button>
                        <button class="scwp-btn scwp-btn--secondary" onclick="this.parentElement.parentElement.remove()">Reject</button>
                        <button class="scwp-btn scwp-btn--ccm-copy" onclick="this.parentElement.parentElement.remove()">Close Preview</button>
                    </div>
                `;
                
                document.body.appendChild(banner);
                
                // Auto remove after 10 seconds
                setTimeout(() => {
                    if (banner && banner.parentNode) {
                        banner.remove();
                    }
                }, 10000);
            }

            function resetForm() {
                if (confirm('Reset form to default values?')) {
                    document.getElementById('cookie_message').value = 'We use cookies to enhance your browsing experience.';
                    document.getElementById('api_key').value = '';
                    
                    // Reset position to bottom-right
                    document.querySelectorAll('.scwp-position-selector__option').forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    document.querySelector('[data-position="bottom-right"]').classList.add('selected');
                    document.querySelector('input[value="bottom-right"]').checked = true;
                    document.getElementById('position-display').textContent = 'Bottom Right';
                }
            }

            function exportSettings() {
                const settings = {
                    message: document.getElementById('cookie_message').value,
                    position: document.querySelector('input[name="banner_position"]:checked')?.value,
                    apiKey: document.getElementById('api_key').value,
                    exportDate: new Date().toISOString()
                };
                
                const blob = new Blob([JSON.stringify(settings, null, 2)], { type: 'application/json' });
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'cookie-manager-settings.json';
                a.click();
                URL.revokeObjectURL(url);
            }

            function duplicateSettings() {
                alert('Settings copied to clipboard! (In real implementation, this would copy current config)');
            }

            function manageUsers() {
                alert('Redirecting to user management... (SCWP style action)');
            }

            function viewLogs() {
                alert('Opening activity logs... (SCWP style action)');
            }

            function resetAllData() {
                if (confirm('⚠️ This will permanently delete all cookie consent data. Continue?')) {
                    alert('All data cleared! (CCM style destructive action)');
                }
            }

            function deactivatePlugin() {
                if (confirm('⚠️ This will deactivate the Cookie Manager plugin. Continue?')) {
                    alert('Plugin deactivated! (SCWP style destructive action)');
                }
            }

            // Form submission with WordPress-style feedback
            document.querySelector('form').addEventListener('submit', function(e) {
                const btn = this.querySelector('button[type="submit"]');
                const originalText = btn.innerHTML;
                btn.innerHTML = '⏳ Saving...';
                btn.disabled = true;
                
                // Re-enable after submission (handled by PHP redirect in real scenario)
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }, 2000);
            });

            console.log('🍪 WordPress Plugin with SCWP + CCM integration loaded');
        </script>
    </body>
    </html>
    
    <?php
}

/**
 * Register admin menu
 */
function register_admin_menu() {
    add_options_page(
        'Cookie Manager Settings',
        'Cookie Manager',
        'manage_options',
        'cookie-manager-settings',
        'render_main_settings_page'
    );
}
add_action('admin_menu', 'register_admin_menu');

/**
 * Plugin activation hook
 */
function plugin_activation() {
    // Set default values
    add_option('example_cookie_message', 'We use cookies to enhance your browsing experience.');
    add_option('example_banner_position', 'bottom-right');
    add_option('example_api_key', '');
}
register_activation_hook(__FILE__, 'plugin_activation');

/**
 * Plugin deactivation hook
 */
function plugin_deactivation() {
    // Cleanup if needed
}
register_deactivation_hook(__FILE__, 'plugin_deactivation');
?>