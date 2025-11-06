<?php
if (!defined('ABSPATH')) exit;

class TR_Resource_CPT {

    private $post_type = 'resource';

    public function __construct() {

        add_action('init', [$this, 'register']);
        add_action('add_meta_boxes', [$this, 'add_meta_box']);
        add_action('save_post', [$this, 'save_meta_box']);

        add_filter('use_block_editor_for_post_type', function ($use, $post_type) {
            if ($post_type === $this->post_type) {
                return false; // forçando Classic Editor
            }
            return $use;
        }, 10, 2);
    }

    public function enable_gutenberg($use, $post_type) {
        return $post_type === $this->post_type ? true : $use;
    }

    public function register() {

        register_post_type($this->post_type, [
            'label' => 'Resources',
            'public' => true,
            'show_in_rest' => true,
            'supports' => ['title', 'custom-fields'], // ✅ necessário para Gutenberg
        ]);

        register_post_meta($this->post_type, '_summary', [
            'single' => true,
            'show_in_rest' => true,
            'type' => 'string',
        ]);

        register_post_meta($this->post_type, '_level', [
            'single' => true,
            'show_in_rest' => true,
            'type' => 'string',
        ]);

    }

    public function add_meta_box() {
        add_meta_box(
            'resource_meta',
            'Resource Details',
            [$this, 'render_meta_box'],
            $this->post_type,
            'normal',
            'default'
        );
    }

    public function render_meta_box($post) {

        $summary = get_post_meta($post->ID, '_summary', true);
        $level = get_post_meta($post->ID, '_level', true);

        ?>
        <label><strong>Summary:</strong></label>
        <textarea name="summary" rows="3" style="width:100%;"><?= esc_textarea($summary) ?></textarea>

        <br><br>

        <label><strong>Level:</strong></label>
        <select name="level" style="width:100%;">
            <option value="beginner"     <?= selected($level, 'beginner')?>>
                Beginner
            </option>
            <option value="intermediate" <?= selected($level, 'intermediate')?>>
                Intermediate
            </option>
            <option value="advanced"     <?= selected($level, 'advanced')?>>
                Advanced
            </option>
        </select>
        <?php
    }

    public function save_meta_box($post_id) {

        if (isset($_POST['summary'])) 
            update_post_meta($post_id, '_summary', sanitize_text_field($_POST['summary']));

        if (isset($_POST['level'])) 
            update_post_meta($post_id, '_level', sanitize_text_field($_POST['level']));

    }
}