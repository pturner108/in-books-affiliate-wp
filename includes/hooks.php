<?php
/**
 * ============================================================
 * Filters
 * ============================================================
 */

// Remove product categories from screen options
add_filter('manage_product_posts_columns', function($columns) {
    unset($columns['product_cat']);
    return $columns;
}, 11);

/**
 * ============================================================
 * Actions
 * ============================================================
 */

// Remove post categories metabox from product screen
add_action('admin_menu', function() {
    remove_meta_box('categorydiv', 'product', 'side');
});

// Hook acf/save_post for acf categories to be synced with post categories
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

// Update acf meta field values for post type product
add_action('acf/save_post', function($post_id) {
    // bail early if no ACF data
    if (empty($_POST['acf'])) {
        return;
    }

    global $post_type;
    if ($post_type !== 'product') {
        return;
    }

    if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
        return;
    }

    iba_update_parent_category_sort_rank($post_id);
}, 11);

// Routine which will Update the parent_category_sort_rank field by
// summing up the iba_category ranks
add_action('iba_cumulative_rank_event', function() {
    $page = 1;
    iba_cumulative_rank_event_update($page);
});
