/**
 * SCWP Admin UI Design System
 * Emoji Library
 * 
 * @version 1.0.0
 * @author SCWP Matias
 * @description Comprehensive emoji library for WordPress admin plugins
 */

(function() {
    'use strict';

    // Emoji Library Namespace
    window.SCWPEmoji = window.SCWPEmoji || {};

    /**
     * Severity/Status Emojis
     */
    window.SCWPEmoji.severity = {
        // Critical/High severity
        critical: '🚨',
        high: '🚨',
        error: '🚨',
        danger: '🚨',
        
        // Medium/Warning severity
        medium: '⚠️',
        warning: '⚠️',
        caution: '⚠️',
        
        // Low/Info severity
        low: 'ℹ️',
        info: 'ℹ️',
        notice: 'ℹ️',
        
        // Success/OK
        success: '✅',
        ok: '✅',
        good: '✅',
        
        // Unknown/Default
        unknown: '❓',
        default: '❓'
    };

    /**
     * Action/Function Emojis
     */
    window.SCWPEmoji.actions = {
        // Analysis & Detection
        scan: '🔍',
        search: '🔍',
        analyze: '🔍',
        detect: '🔍',
        
        // Tools & Configuration
        tools: '🛠️',
        fix: '🛠️',
        repair: '🛠️',
        config: '🔧',
        settings: '🔧',
        gear: '⚙️',
        
        // Data & Statistics
        stats: '📊',
        chart: '📊',
        data: '📊',
        dashboard: '📊',
        
        // Documentation & Logging
        log: '📝',
        note: '📝',
        docs: '📖',
        book: '📖',
        
        // Refresh & Update
        refresh: '🔄',
        update: '🔄',
        sync: '🔄',
        reload: '🔄',
        
        // Target & Focus
        target: '🎯',
        focus: '🎯',
        aim: '🎯'
    };

    /**
     * Features & Capabilities Emojis
     */
    window.SCWPEmoji.features = {
        // Accessibility
        accessibility: '♿',
        a11y: '♿',
        
        // Performance
        performance: '⚡',
        speed: '⚡',
        fast: '⚡',
        
        // Design & UI
        design: '🎨',
        ui: '🎨',
        paint: '🎨',
        
        // Mobile & Responsive
        mobile: '📱',
        responsive: '📱',
        device: '📱',
        
        // Technology
        rocket: '🚀',
        tech: '🚀',
        launch: '🚀',
        
        // Integration
        link: '🔗',
        connect: '🔗',
        chain: '🔗',
        
        // Innovation
        star: '✨',
        new: '✨',
        sparkle: '✨',
        
        // Organization
        package: '📦',
        box: '📦',
        
        // Components
        puzzle: '🧩',
        component: '🧩',
        piece: '🧩',
        
        // Quality
        trophy: '🏆',
        award: '🏆',
        quality: '🏆',
        
        // Professional
        briefcase: '💼',
        business: '💼',
        professional: '💼'
    };

    /**
     * WordPress Specific Emojis
     */
    window.SCWPEmoji.wordpress = {
        // Content
        post: '📄',
        page: '📄',
        content: '📄',
        
        // Users
        user: '👤',
        users: '👥',
        admin: '👨‍💼',
        
        // Media
        image: '🖼️',
        media: '🖼️',
        gallery: '🖼️',
        
        // Plugins
        plugin: '🔌',
        extension: '🔌',
        
        // Themes
        theme: '🎭',
        template: '🎭',
        
        // Database
        database: '🗄️',
        storage: '🗄️',
        
        // Security
        security: '🔒',
        lock: '🔒',
        shield: '🛡️'
    };

    /**
     * Utility Functions
     */
    window.SCWPEmoji.utils = {
        /**
         * Get emoji by severity level
         */
        getSeverityEmoji: function(severity) {
            severity = (severity || 'default').toLowerCase();
            return window.SCWPEmoji.severity[severity] || window.SCWPEmoji.severity.default;
        },

        /**
         * Get emoji by action type
         */
        getActionEmoji: function(action) {
            action = (action || 'default').toLowerCase();
            return window.SCWPEmoji.actions[action] || '🔧';
        },

        /**
         * Get emoji by feature type
         */
        getFeatureEmoji: function(feature) {
            feature = (feature || 'default').toLowerCase();
            return window.SCWPEmoji.features[feature] || '✨';
        },

        /**
         * Get emoji by WordPress context
         */
        getWordPressEmoji: function(context) {
            context = (context || 'plugin').toLowerCase();
            return window.SCWPEmoji.wordpress[context] || '🔌';
        },

        /**
         * Create icon span with emoji
         */
        createIcon: function(emoji, className = 'scwp-emoji-icon') {
            const span = document.createElement('span');
            span.className = className;
            span.textContent = emoji;
            span.setAttribute('role', 'img');
            span.setAttribute('aria-label', 'Icon');
            return span;
        },

        /**
         * Add emoji to text
         */
        addEmojiToText: function(text, emoji, position = 'before') {
            if (position === 'after') {
                return text + ' ' + emoji;
            }
            return emoji + ' ' + text;
        },

        /**
         * Get status emoji with fallback
         */
        getStatusEmoji: function(status, fallback = '📄') {
            const statusMap = {
                'active': '✅',
                'inactive': '❌',
                'pending': '⏳',
                'processing': '⚙️',
                'completed': '✅',
                'failed': '❌',
                'cancelled': '⏹️',
                'paused': '⏸️',
                'running': '▶️'
            };
            
            return statusMap[status?.toLowerCase()] || fallback;
        },

        /**
         * Get all emojis as flat array
         */
        getAllEmojis: function() {
            const allEmojis = [];
            
            Object.values(window.SCWPEmoji.severity).forEach(emoji => allEmojis.push(emoji));
            Object.values(window.SCWPEmoji.actions).forEach(emoji => allEmojis.push(emoji));
            Object.values(window.SCWPEmoji.features).forEach(emoji => allEmojis.push(emoji));
            Object.values(window.SCWPEmoji.wordpress).forEach(emoji => allEmojis.push(emoji));
            
            // Remove duplicates
            return [...new Set(allEmojis)];
        },

        /**
         * Search emojis by keyword
         */
        searchEmoji: function(keyword) {
            keyword = keyword.toLowerCase();
            const results = [];
            
            // Search in all categories
            const categories = ['severity', 'actions', 'features', 'wordpress'];
            
            categories.forEach(category => {
                Object.keys(window.SCWPEmoji[category]).forEach(key => {
                    if (key.includes(keyword)) {
                        results.push({
                            category: category,
                            key: key,
                            emoji: window.SCWPEmoji[category][key]
                        });
                    }
                });
            });
            
            return results;
        }
    };

    /**
     * Common emoji combinations for quick access
     */
    window.SCWPEmoji.combinations = {
        // Plugin status
        pluginActive: '🔌 ✅',
        pluginInactive: '🔌 ❌',
        pluginError: '🔌 🚨',
        
        // Scan results
        scanComplete: '🔍 ✅',
        scanRunning: '🔍 ⚙️',
        scanFailed: '🔍 ❌',
        
        // Issues found
        issuesFound: '🚨 📊',
        noIssues: '✅ 📊',
        
        // Performance
        goodPerformance: '⚡ ✅',
        poorPerformance: '⚡ ⚠️',
        
        // Accessibility
        accessibleContent: '♿ ✅',
        accessibilityIssues: '♿ ⚠️'
    };

    // Auto-initialize emoji styles if not already defined
    if (!document.getElementById('scwp-emoji-styles')) {
        const style = document.createElement('style');
        style.id = 'scwp-emoji-styles';
        style.textContent = `
            .scwp-emoji-icon {
                display: inline-block;
                font-style: normal;
                font-variant: normal;
                text-rendering: auto;
                line-height: 1;
            }
            
            .scwp-emoji-large {
                font-size: 1.5em;
            }
            
            .scwp-emoji-small {
                font-size: 0.875em;
            }
            
            .scwp-emoji-clickable {
                cursor: pointer;
                transition: transform 0.2s ease;
            }
            
            .scwp-emoji-clickable:hover {
                transform: scale(1.1);
            }
        `;
        document.head.appendChild(style);
    }

    // Fire initialization event
    document.dispatchEvent(new CustomEvent('scwp-emoji:initialized', {
        detail: {
            version: '1.0.0',
            totalEmojis: window.SCWPEmoji.utils.getAllEmojis().length
        }
    }));

})();