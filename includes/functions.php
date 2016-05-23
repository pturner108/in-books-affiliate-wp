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
 * Hook acf/save_post for acf categories to be synced with post categories
 */
add_action('acf/save_post', function($post_id) {
    if ('product' != get_post_type($post_id)) {
        return;
    }

    if(empty($_POST['acf'])) {
        return;
    }

    // specific iba_category_* field value
    $cat_1 = $_POST['acf']['iba_category_1'];
    $cat_2 = $_POST['acf']['iba_category_2'];
    $cat_3 = $_POST['acf']['iba_category_3'];

    $total_cat = array();

    if (!empty($cat_1)) {
        $total_cat[] = sanitize_text_field($cat_1);
    }

    if (!empty($cat_2)) {
        $total_cat[] = sanitize_text_field($cat_2);
    }

    if (!empty($cat_3)) {
        $total_cat[] = sanitize_text_field($cat_3);
    }

    wp_set_post_categories($post_id, $total_cat);
}, 1, 2);

/**
 * Remove post categories metabox from product screen
 */
add_action('admin_menu', function() {
    remove_meta_box('categorydiv', 'product', 'side');
});