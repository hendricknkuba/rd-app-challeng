<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handles the registration of the "Resource" custom post type
 * and its custom meta fields.
 */

class TR_Resource_CPT {

    private $post_type = 'resource';
    private $levels = ['beginner', 'intermediate', 'advanced'];

    /**
     * Registers the custom post type and custom fields.
     */
    public function register() {
        $labels = [
            'name' => __('Resources', 'test-resources'),
            'singular_name' => __('Resource', 'test-resources'),
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'has_archive' => false,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-welcome-learn-more',
            'supports' => ['title'],
        ];

        register_post_type($this->post_type, $args);

        // Registers the native WP meta fields without ACF
        foreach (['summary', 'level'] as $meta_key) {
            register_post_meta($this->post_type, $meta_key, [
                'type'         => 'string',
                'single'       => true,
                'show_in_rest' => true,
                'auth_callback'=> '__return_true',
            ]);
        }
    }

    /**
     * Creates a sample post on plugin activation.
     */
    public function create_sample_post() {
        // Avoid duplication
        $existing = get_posts([
            'post_type' => $this->post_type,
            'numberposts'     => 1,
        ]);

        if ($existing) return;

        $post_id = wp_insert_post([
            'post_type' => $this->post_type,
            'post_title' => 'Introduction to WordPress REST API',
            'post_status' => 'publish',
        ]);

        if ($post_id) {
            update_post_meta($post_id, 'summary', 'A beginner-friendly guide to understanding and using the WordPress REST API.');
            update_post_meta($post_id, 'level', 'beginner');
        }
    }

    /**
     * Helper to get valid levels
     */
    public function get_levels() {
        return $this->levels;
    }
}