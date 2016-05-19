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
 * Add main category to IBA Products
 */
function iba_categories_for_products()
{
    register_taxonomy_for_object_type('category', 'product');
}
add_action('init', 'iba_categories_for_products');

/**
 * Unregister IBA Product taxonomy
 */
function iba_unregister_product_taxonomy()
{
    unregister_taxonomy('product_cat');
}

/**
 * Disabled the action causing woocommerce to throw error
 * Todo: Investigate
 */
# add_action('woocommerce_after_register_taxonomy', 'iba_unregister_product_taxonomy');

/**
 * Enable IBA Products with category search
 * @param $query WP_Query
 */
function iba_products_on_category_pages($query)
{
    if ( $query->is_category() && $query->is_main_query() ) {
        $query->set('post_type', array('post', 'product'));
    }
}
add_action('pre_get_posts', 'iba_products_on_category_pages');
