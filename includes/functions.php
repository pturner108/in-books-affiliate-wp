<?php
/**
 * Function helpers
 */

require_once IBA\INC_DIR . 'iba-functions.php';

/**
 * Dirty way of returning include contents
 *
 * @param string $template
 * @return string
 */
function return_include_once($template)
{
    ob_start();
    include_once $template;
    return ob_get_clean();
}

/**
 * Dirty way of returning include contents
 * Same as return_include_once() instead it calls `include`
 *
 * @param string $template
 * @return string
 */
function return_include($template)
{
    ob_start();
    include $template;
    return ob_get_clean();
}

/**
 * Generates unique id
 *
 * @return string
 */
function iba_random_unique_id()
{
    $alphabet = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 4; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

/**
 * Cumulative rank event
 * @return void
 */
function iba_activate_cumulative_rank_event()
{
    if (!wp_next_scheduled('iba_cumulative_rank_event')) {
        wp_schedule_event(time(), 'daily', 'iba_cumulative_rank_event');
    }
}

/**
 * Get product items
 *
 * @param int $paged
 * @param int $batch_size
 * @return WP_Query
 */
function iba_get_product_items($paged, $batch_size = 100)
{
    return new \WP_Query(array(
        'post_type' => 'product',
        'posts_per_page' => $batch_size,
        'post_status' => 'any',
        'order' => 'ASC',
        'orderby' => 'ID',
        'paged' => $paged
    ));
}
