<?php
if (!defined('ABSPATH')) {
    exit;
}

class TR_Resource_REST {

    private $namespace = 'test/v1';
    private $route = '/resources';

    public function __construct() {
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes() {
        register_rest_route($this->namespace, $this->route, [
            'methods' => WP_REST_Server::READABLE,
            'callback' => [$this, 'handle_get_resources'],
            'permission_callback' => '__return_true',
        ]);
    }

    /**
     * Handle GET /wp-json/test/v1/resources
     */
    public function handle_get_resources(WP_REST_Request $request) {

        $minLevel = $request->get_param('min_level') ?? 'beginner';
        $levelsOrdered = ['beginner', 'intermediate', 'advanced'];

        // If invalid level, beginner by default
        if (!in_array($minLevel, $levelsOrdered)) {
            $minLevel = 'beginner';
        }

        // WP_Query args
        $query = new WP_Query([
            'post_type' => 'resource',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
        ]);

        $resources = [];

        foreach ($query->posts as $post) {
            $resourceLevel = get_post_meta($post->ID, 'level', true);

            // Level ordering 
            if (array_search($resourceLevel, $levelsOrdered) < array_search($minLevel, $levelsOrdered)) {
                continue;
            }

            $summary = get_post_meta($post->ID, 'summary', true);
            $readingEstimate = TR_Utils::calculate_reading_estimate($summary);

            // Protect summary content when not authenticated
            if (!current_user_can('edit_posts')) {
                $summary = null;
            }

            $resources[] = [
                'id' => $post->ID,
                'title' => $post->post_title,
                'summary' => $summary,
                'level' => $resourceLevel,
                'reading_estimate' => $readingEstimate,
            ];
        }

        return $resources;

    }
}