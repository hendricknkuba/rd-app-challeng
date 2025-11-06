<?php
/**
 * Plugin Name: Test Resources Plugin
 * Plugin URI:  https://github.com/hendricknkuba/rd-app-challenge
 * Description: Registers a Resource custom post type and exposes a custom REST API endpoint.
 * Version:     1.0.0
 * Author:      Hendrick Nkuba
 * Author URI:  https://github.com/hendricknkuba
 * License:     MIT
 * Text Domain: test-resources
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Define constantes do plugin
 */
define('TR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('TR_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Includes necessary files
 */
require_once TR_PLUGIN_DIR . 'includes/class-resource-cpt.php';
require_once TR_PLUGIN_DIR . 'includes/class-resource-rest.php';
require_once TR_PLUGIN_DIR . 'includes/class-utils.php';

/**
 * Main Plugin Class
 */
class Test_Resources_Plugin {
    public function __construct() {
        // Register main hooks
        add_action('init', [$this, 'register_custom_post_type']);
        add_action('rest_api_init', [$this, 'register_rest_routes']);
        register_activation_hook(__FILE__, [$this, 'on_activation']);
    }

    public function register_custom_post_type() {
        $cpt = new TR_Resource_CPT();
        $cpt->register();
    }

    public function register_rest_routes() {
        $rest = new TR_Resource_REST();
        $rest->register_routes();
    }

    public function on_activation() {
        $cpt = new TR_Resource_CPT();
        $cpt->register();
        flush_rewrite_rules();

        // Create a sample post on activation
        $cpt->create_sample_post();
    }
}

// Initialize the plugin
new Test_Resources_Plugin();
