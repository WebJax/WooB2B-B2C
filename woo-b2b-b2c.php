<?php
/**
 * Plugin Name: WooCommerce B2B/B2C Hybrid
 * Plugin URI: https://example.com
 * Description: A flexible WooCommerce plugin for a hybrid B2B/B2C solution with reordering, customer-specific discounts, RFQ, role-based pricing, and more.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * Text Domain: woocommerce-b2b-b2c
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('WC_B2B_B2C_PATH', plugin_dir_path(__FILE__));
define('WC_B2B_B2C_URL', plugin_dir_url(__FILE__));

// Initialize the plugin
function wc_b2b_b2c_init() {
    // Load necessary files
    require_once WC_B2B_B2C_PATH . 'includes/class-wc-b2b-b2c-settings.php';
    require_once WC_B2B_B2C_PATH . 'includes/class-wc-b2b-b2c-pricing.php';
    require_once WC_B2B_B2C_PATH . 'includes/class-wc-b2b-b2c-reorder.php';
    require_once WC_B2B_B2C_PATH . 'includes/class-wc-b2b-b2c-rfq.php';

    // Initialize classes
    new WC_B2B_B2C_Settings();
    new WC_B2B_B2C_Pricing();
    new WC_B2B_B2C_Reorder();
    new WC_B2B_B2C_RFQ();
}
add_action('plugins_loaded', 'wc_b2b_b2c_init');

// Activation and deactivation hooks
function wc_b2b_b2c_activate() {
    // Add custom roles and capabilities
    add_role('b2b_customer', __('B2B Customer', 'woocommerce-b2b-b2c'), array('read' => true));
}
register_activation_hook(__FILE__, 'wc_b2b_b2c_activate');

function wc_b2b_b2c_deactivate() {
    // Remove custom roles and capabilities
    remove_role('b2b_customer');
}
register_deactivation_hook(__FILE__, 'wc_b2b_b2c_deactivate');
