/**
 * SCWP Admin UI Design System
 * JavaScript Components
 * 
 * @version 1.0.0
 * @author SCWP Matias
 * @description JavaScript functionality for the design system components
 */

(function() {
    'use strict';

    // Design System Namespace
    window.SCWPAdminUI = window.SCWPAdminUI || {};

    /**
     * Initialize all components
     */
    function init() {
        initToggles();
        initNotifications();
        initCards();
        initTabs();
        
        // Fire custom event when initialized
        document.dispatchEvent(new CustomEvent('scwp-admin-ui:initialized'));
    }

    /**
     * Toggle Switch Component
     */
    function initToggles() {
        const toggles = document.querySelectorAll('.scwp-toggle__input');
        
        toggles.forEach(toggle => {
            toggle.addEventListener('change', function() {
                const event = new CustomEvent('scwp-toggle:change', {
                    detail: {
                        element: this,
                        checked: this.checked,
                        value: this.value
                    }
                });
                
                this.dispatchEvent(event);
            });
        });
    }

    /**
     * Auto-dismiss notifications
     */
    function initNotifications() {
        const notifications = document.querySelectorAll('.scwp-notification[data-auto-dismiss]');
        
        notifications.forEach(notification => {
            const delay = parseInt(notification.dataset.autoDismiss) || 5000;
            
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-10px)';
                
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, delay);
        });
    }

    /**
     * Card hover effects and interactions
     */
    function initCards() {
        const cards = document.querySelectorAll('.scwp-card');
        
        cards.forEach(card => {
            // Add click event if card has data-href
            if (card.dataset.href) {
                card.style.cursor = 'pointer';
                card.addEventListener('click', function() {
                    window.location.href = this.dataset.href;
                });
            }

            // Enhanced hover effects
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-2px)';
            });
        });
    }

    /**
     * Tab Navigation
     */
    function initTabs() {
        const tabContainers = document.querySelectorAll('.scwp-nav-tabs');
        
        tabContainers.forEach(container => {
            const tabs = container.querySelectorAll('.scwp-nav-tab');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    // Only handle if it's a hash link
                    if (this.getAttribute('href')?.startsWith('#')) {
                        e.preventDefault();
                        
                        // Remove active class from all tabs in this container
                        tabs.forEach(t => t.classList.remove('scwp-nav-tab--active'));
                        
                        // Add active class to clicked tab
                        this.classList.add('scwp-nav-tab--active');
                        
                        // Fire custom event
                        const event = new CustomEvent('scwp-tab:change', {
                            detail: {
                                tab: this,
                                target: this.getAttribute('href'),
                                container: container
                            }
                        });
                        
                        container.dispatchEvent(event);
                    }
                });
            });
        });
    }

    /**
     * Utility Functions
     */
    window.SCWPAdminUI.utils = {
        /**
         * Show notification
         * @param {string} message - The notification message (can include HTML)
         * @param {string} type - Notification type: 'success', 'warning', 'danger', 'info'
         * @param {number|boolean} autoDismiss - Auto dismiss time in ms, or false to disable
         * @param {object} options - Additional options
         */
        showNotification: function(message, type = 'info', autoDismiss = 5000, options = {}) {
            const {
                floating = false,
                container = null,
                animation = 'slideInFromRight',
                position = 'top-right'
            } = options;

            const notification = document.createElement('div');
            notification.className = `scwp-notification scwp-notification--${type}`;
            
            // Add floating class for fixed positioned notifications
            if (floating) {
                notification.classList.add('scwp-notification--floating');
            }
            
            notification.innerHTML = message;
            
            if (autoDismiss) {
                notification.dataset.autoDismiss = autoDismiss;
            }

            // Determine container for notification
            let targetContainer;
            if (container) {
                targetContainer = typeof container === 'string' ? document.querySelector(container) : container;
            } else if (floating) {
                targetContainer = document.body;
            } else {
                targetContainer = document.querySelector('.scwp-ui') || document.body;
            }

            // Position notification appropriately
            if (floating) {
                // For floating notifications, append to body and position with CSS
                targetContainer.appendChild(notification);
                
                // Apply entrance animation
                notification.style.animation = `scwp-${animation} 0.3s ease-out`;
                
                // Stack multiple floating notifications
                this.stackFloatingNotifications();
            } else {
                // For inline notifications, insert at top
                targetContainer.insertBefore(notification, targetContainer.firstChild);
                
                // Apply entrance animation
                notification.style.animation = `scwp-fadeIn 0.3s ease-out`;
            }

            // Auto-dismiss functionality
            if (autoDismiss) {
                setTimeout(() => {
                    this.dismissNotification(notification, floating);
                }, autoDismiss);
            }

            // Add close button functionality if needed
            this.addCloseButton(notification, floating);
            
            return notification;
        },

        /**
         * Dismiss a notification with animation
         */
        dismissNotification: function(notification, floating = false) {
            const exitAnimation = floating ? 'scwp-slideOutToRight' : 'scwp-fadeOut';
            notification.style.animation = `${exitAnimation} 0.3s ease-in`;
            
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
                
                // Restack floating notifications if needed
                if (floating) {
                    this.stackFloatingNotifications();
                }
            }, 300);
        },

        /**
         * Stack floating notifications properly
         */
        stackFloatingNotifications: function() {
            const floatingNotifications = document.querySelectorAll('.scwp-notification--floating');
            floatingNotifications.forEach((notification, index) => {
                const offset = index * 80; // 80px spacing between notifications
                notification.style.top = `${100 + offset}px`;
            });
        },

        /**
         * Add close button to notification
         */
        addCloseButton: function(notification, floating = false) {
            // Only add close button to floating notifications or long-lived notifications
            if (floating || !notification.dataset.autoDismiss) {
                const closeBtn = document.createElement('button');
                closeBtn.innerHTML = '&times;';
                closeBtn.style.cssText = `
                    position: absolute;
                    top: 8px;
                    right: 8px;
                    background: none;
                    border: none;
                    font-size: 18px;
                    cursor: pointer;
                    opacity: 0.6;
                    padding: 0;
                    width: 20px;
                    height: 20px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                `;
                
                closeBtn.addEventListener('click', () => {
                    this.dismissNotification(notification, floating);
                });

                closeBtn.addEventListener('mouseenter', () => {
                    closeBtn.style.opacity = '1';
                });

                closeBtn.addEventListener('mouseleave', () => {
                    closeBtn.style.opacity = '0.6';
                });

                notification.style.position = 'relative';
                notification.style.paddingRight = '40px';
                notification.appendChild(closeBtn);
            }
        },

        /**
         * Create loading spinner
         */
        createSpinner: function(size = 'normal') {
            const spinner = document.createElement('span');
            spinner.className = `scwp-loading${size === 'large' ? ' scwp-loading--large' : ''}`;
            return spinner;
        },

        /**
         * Toggle element visibility
         */
        toggle: function(element, show = null) {
            if (show === null) {
                show = element.classList.contains('scwp-hidden');
            }
            
            element.classList.toggle('scwp-hidden', !show);
            return show;
        },

        /**
         * Animate element
         */
        animate: function(element, animation = 'fadeIn', duration = 300) {
            element.style.animation = `scwp-${animation} ${duration}ms ease`;
            
            return new Promise(resolve => {
                setTimeout(() => {
                    element.style.animation = '';
                    resolve();
                }, duration);
            });
        }
    };

    /**
     * Component Factory
     */
    window.SCWPAdminUI.components = {
        /**
         * Create a card component
         */
        createCard: function(options = {}) {
            const {
                title = '',
                content = '',
                icon = '',
                variant = 'primary',
                borderPosition = 'top',
                actions = []
            } = options;

            const card = document.createElement('div');
            card.className = `scwp-card scwp-card--${variant} scwp-card--border-${borderPosition}`;

            let html = '';
            
            if (title || icon) {
                html += `
                    <div class="scwp-card__header">
                        <h3 class="scwp-card__title">${title}</h3>
                        ${icon ? `<span class="scwp-card__icon">${icon}</span>` : ''}
                    </div>
                `;
            }

            if (content) {
                html += `<div class="scwp-card__content">${content}</div>`;
            }

            if (actions.length > 0) {
                html += '<div class="scwp-card__actions">';
                actions.forEach(action => {
                    html += `<button class="scwp-btn scwp-btn--${action.variant || 'primary'}" ${action.onclick ? `onclick="${action.onclick}"` : ''}>${action.text}</button>`;
                });
                html += '</div>';
            }

            card.innerHTML = html;
            return card;
        },

        /**
         * Create a button component
         */
        createButton: function(text, variant = 'primary', size = 'normal') {
            const button = document.createElement('button');
            button.className = `scwp-btn scwp-btn--${variant}`;
            
            if (size !== 'normal') {
                button.classList.add(`scwp-btn--${size}`);
            }
            
            button.textContent = text;
            return button;
        }
    };

    // Auto-initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Expose init function for manual initialization
    window.SCWPAdminUI.init = init;

})();