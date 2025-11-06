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

/**
 * Includes necessary files
 */
require_once TR_PLUGIN_DIR . 'includes/class-resource-cpt.php';
require_once TR_PLUGIN_DIR . 'includes/class-resource-rest.php';
require_once TR_PLUGIN_DIR . 'includes/class-utils.php';

function tr_init_plugin() {
    new TR_Resource_CPT();
    new TR_Resource_REST();
}

add_action('plugins_loaded', 'tr_init_plugin');