<?php
if (!defined('ABSPATH')) {
    exit;
}

class TR_Utils {

    /**
     * Simple reading estimate.
     * Formula documented in README.
     */
    public static function calculate_reading_estimate(string $text = ''): int {
        if (!$text) return 0;

        $words = str_word_count($text);
        $minutes = ceil($words / 200);

        return $minutes;
    }
}