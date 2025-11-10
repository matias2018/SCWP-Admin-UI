<?php
/**
 * Example WordPress Plugin using SCWP Admin UI
 * 
 * This file demonstrates how to integrate SCWP Admin UI into a WordPress plugin
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Example_Plugin_Admin {
    
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_menu_page(
            'Example Plugin',
            'Example Plugin',
            'manage_options',
            'example-plugin',
            array($this, 'render_dashboard'),
            'dashicons-admin-generic',
            30
        );
        
        add_submenu_page(
            'example-plugin',
            'Settings',
            'Settings',
            'manage_options',
            'example-plugin-settings',
            array($this, 'render_settings')
        );
    }
    
    /**
     * Enqueue SCWP Admin UI assets
     */
    public function enqueue_assets($hook) {
        // Only load on our plugin pages
        if (strpos($hook, 'example-plugin') === false) {
            return;
        }
        
        wp_enqueue_style(
            'scwp-admin-ui',
            plugin_dir_url(__FILE__) . '../css/scwp-admin-ui.css',
            array(),
            '1.0.0'
        );
        
        wp_enqueue_script(
            'scwp-admin-ui',
            plugin_dir_url(__FILE__) . '../js/scwp-admin-ui.js',
            array('jquery'),
            '1.0.0',
            true
        );
    }
    
    /**
     * Render dashboard page
     */
    public function render_dashboard() {
        // Get some stats for demonstration
        $user_count = count_users();
        $post_count = wp_count_posts();
        ?>
        <div class="wrap scwp-ui">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <!-- Navigation Tabs -->
            <nav class="scwp-nav-tabs scwp-mb-6">
                <a href="#dashboard" class="scwp-nav-tab scwp-nav-tab--active">Dashboard</a>
                <a href="#reports" class="scwp-nav-tab">Reports</a>
                <a href="#tools" class="scwp-nav-tab">Tools</a>
            </nav>
            
            <!-- Dashboard Cards -->
            <div class="scwp-dashboard">
                <div class="scwp-dashboard__cards">
                    <!-- Total Users Card -->
                    <div class="scwp-card scwp-card--primary">
                        <div class="scwp-card__header">
                            <h3 class="scwp-card__title">Total Users</h3>
                            <span class="scwp-card__icon">👥</span>
                        </div>
                        <div class="scwp-card__content">
                            <span class="scwp-card__count"><?php echo number_format($user_count['total_users']); ?></span>
                            <p class="scwp-card__description">Registered users in the system</p>
                        </div>
                        <div class="scwp-card__actions">
                            <a href="<?php echo admin_url('users.php'); ?>" class="scwp-btn scwp-btn--secondary scwp-btn--small">
                                View All Users
                            </a>
                        </div>
                    </div>
                    
                    <!-- Published Posts Card -->
                    <div class="scwp-card scwp-card--success">
                        <div class="scwp-card__header">
                            <h3 class="scwp-card__title">Published Posts</h3>
                            <span class="scwp-card__icon">📝</span>
                        </div>
                        <div class="scwp-card__content">
                            <span class="scwp-card__count"><?php echo number_format($post_count->publish); ?></span>
                            <p class="scwp-card__description">Posts currently published</p>
                        </div>
                        <div class="scwp-card__actions">
                            <a href="<?php echo admin_url('edit.php'); ?>" class="scwp-btn scwp-btn--secondary scwp-btn--small">
                                Manage Posts
                            </a>
                        </div>
                    </div>
                    
                    <!-- Draft Posts Card -->
                    <div class="scwp-card scwp-card--warning">
                        <div class="scwp-card__header">
                            <h3 class="scwp-card__title">Draft Posts</h3>
                            <span class="scwp-card__icon">📄</span>
                        </div>
                        <div class="scwp-card__content">
                            <span class="scwp-card__count"><?php echo number_format($post_count->draft); ?></span>
                            <p class="scwp-card__description">Posts in draft status</p>
                        </div>
                    </div>
                    
                    <!-- System Status Card -->
                    <div class="scwp-card scwp-card--danger">
                        <div class="scwp-card__header">
                            <h3 class="scwp-card__title">System Status</h3>
                            <span class="scwp-card__icon">⚡</span>
                        </div>
                        <div class="scwp-card__content">
                            <span class="scwp-card__count scwp-text-success">Good</span>
                            <p class="scwp-card__description">All systems operational</p>
                        </div>
                        <div class="scwp-card__actions">
                            <button type="button" class="scwp-btn scwp-btn--primary scwp-btn--small" onclick="runSystemCheck()">
                                <span class="scwp-loading" style="display: none;"></span>
                                Run Check
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="scwp-mb-6">
                <h2>Quick Actions</h2>
                <div class="scwp-flex scwp-gap-4">
                    <button class="scwp-btn scwp-btn--primary" onclick="showNotificationExample()">
                        Show Notification
                    </button>
                    <button class="scwp-btn scwp-btn--secondary" onclick="createCardExample()">
                        Create Dynamic Card
                    </button>
                    <a href="<?php echo admin_url('options-general.php'); ?>" class="scwp-btn scwp-btn--success">
                        WordPress Settings
                    </a>
                </div>
            </div>
        </div>
        
        <script>
        function runSystemCheck() {
            const button = event.target;
            const spinner = button.querySelector('.scwp-loading');
            
            button.disabled = true;
            spinner.style.display = 'inline-block';
            
            // Simulate system check
            setTimeout(() => {
                button.disabled = false;
                spinner.style.display = 'none';
                
                SCWPAdminUI.utils.showNotification('✅ System check completed successfully!', 'success');
            }, 2000);
        }
        
        function showNotificationExample() {
            SCWPAdminUI.utils.showNotification('This is an example notification using SCWP Admin UI!', 'info');
        }
        
        function createCardExample() {
            const card = SCWPAdminUI.components.createCard({
                title: 'Dynamic Card',
                content: '<p class="scwp-card__description">This card was created dynamically using JavaScript!</p>',
                icon: '🚀',
                variant: 'primary',
                actions: [
                    {
                        text: 'Remove',
                        variant: 'danger',
                        onclick: 'this.closest(\'.scwp-card\').remove()'
                    }
                ]
            });
            
            document.querySelector('.scwp-dashboard__cards').appendChild(card);
        }
        </script>
        <?php
    }
    
    /**
     * Render settings page
     */
    public function render_settings() {
        ?>
        <div class="wrap scwp-ui">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <form method="post" action="options.php">
                <?php settings_fields('example_plugin_settings'); ?>
                
                <div class="scwp-form-group">
                    <label class="scwp-label" for="plugin_name">Plugin Name</label>
                    <input type="text" 
                           id="plugin_name" 
                           name="example_plugin_name" 
                           class="scwp-input" 
                           value="<?php echo esc_attr(get_option('example_plugin_name', 'My Example Plugin')); ?>"
                           placeholder="Enter plugin name">
                </div>
                
                <div class="scwp-form-group">
                    <label class="scwp-label" for="description">Description</label>
                    <textarea id="description" 
                              name="example_plugin_description" 
                              class="scwp-input scwp-textarea" 
                              placeholder="Enter plugin description"><?php echo esc_textarea(get_option('example_plugin_description')); ?></textarea>
                </div>
                
                <div class="scwp-form-group">
                    <div class="scwp-flex scwp-items-center scwp-gap-3">
                        <label class="scwp-toggle">
                            <input type="checkbox" 
                                   class="scwp-toggle__input" 
                                   name="example_plugin_enabled" 
                                   value="1" 
                                   <?php checked(get_option('example_plugin_enabled'), 1); ?>>
                            <span class="scwp-toggle__slider"></span>
                        </label>
                        <span class="scwp-label">Enable Plugin Features</span>
                    </div>
                </div>
                
                <div class="scwp-form-group">
                    <div class="scwp-flex scwp-items-center scwp-gap-3">
                        <label class="scwp-toggle">
                            <input type="checkbox" 
                                   class="scwp-toggle__input" 
                                   name="example_plugin_debug" 
                                   value="1" 
                                   <?php checked(get_option('example_plugin_debug'), 1); ?>>
                            <span class="scwp-toggle__slider"></span>
                        </label>
                        <span class="scwp-label">Enable Debug Mode</span>
                    </div>
                </div>
                
                <div class="scwp-flex scwp-gap-4">
                    <?php submit_button('Save Settings', 'primary', 'submit', false, array('class' => 'scwp-btn scwp-btn--primary')); ?>
                    <button type="reset" class="scwp-btn scwp-btn--secondary">Reset</button>
                </div>
            </form>
        </div>
        <?php
    }
}

// Initialize the admin class
new Example_Plugin_Admin();