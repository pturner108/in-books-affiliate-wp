<?php
namespace IBA;

/**
 * Class Metaboxes
 *
 * @since 1.0.0
 */
class Metaboxes {
    public static function init() {
        if (is_admin()) {
            add_action('add_meta_boxes', array(__CLASS__, 'meta_box_related_init'));
        }

        add_action('p2p_init', array(__CLASS__, 'set_p2p_relationships'));
    }

    /**
     * Register metaboxes
     */
    public static function meta_box_related_init() {
        $screens = array('post', 'product');

        foreach ($screens as $screen) {
            add_meta_box(
                'ds1-related-books-id',
                __('Related Products'),
                array(__CLASS__, 'meta_box_related_products_display'),
                $screen
            );

        }
    }

    /**
     * Adds metabox to posts to show related products
     */
    public static function meta_box_related_products_display() {
        $max = 50;
        $related = iba_get_related_posts(get_the_ID(), array('post_status' => 'publish', 'max' => $max, 'p2p_type' => 'related_post_to_product'));

        echo '<h2>Published Connections</h2>';
        echo '<h3>'. __('Direct Connections') . '</h3>';
        $table = new Related_List_Table();
        $table->prepare_items($related['direct']);
        $table->display();

        echo '<h3>'. __('Via Categories') . '</h3>';
        $table = new Related_List_Table();
        $table->prepare_items($related['ai']);
        $table->display();

        $related = iba_get_related_posts(get_the_ID(), array('post_status' => 'all', 'max' => $max, 'p2p_type' => 'related_post_to_product'));

        echo '<h2>All Connections</h2>';
        echo '<h3>'. __('Direct Connections') . '</h3>';
        $table = new Related_List_Table();
        $table->prepare_items($related['direct']);
        $table->display();

        echo '<h3>'. __('Via Categories') . '</h3>';
        $table = new Related_List_Table();
        $table->prepare_items($related['ai']);
        $table->display();
    }

    /**
     * Create connections between articles and products
     */
    public static function set_p2p_relationships() {
        if (!function_exists('p2p_register_connection_type')) {
            return;
        }
        
        /**
         * Connection types for products post type
         */
        
        // The featured product connection
        p2p_register_connection_type(array(
            'name' => 'featured_product',
            'from' => 'post',
            'to' => 'product',
            'title' => array('from' => 'Featured Product', 'to' => 'Related Article'),
            'from_labels' => array(
                'create' => __('Assign Featured Article')
            ),
            'to_labels' => array(
                'create' => __('Assign Featured Product')
            ),
            'admin_dropdown' => 'any',
            'from_query_vars' => array('post_status' => 'any')
        ));

        // Product to product connection
        p2p_register_connection_type(array(
            'name' => 'related_product_to_product',
            'from' => 'product',
            'to' => 'product',
            'reciprocal' => true,
            'title' => 'Related Products',

            'to_labels' => array(
                'create' => __('Assign Related Products')
            ),
            'from_query_vars' => array('post_status' => 'any')
        ));

        // Post to product connection
        p2p_register_connection_type(array(
            'name' => 'related_post_to_product',
            'from' => 'post',
            'to' => 'product',
            'title' => array('from' => 'Related Products', 'to' => 'Related Articles'),

            'to_labels' => array(
                'create' => __('Assign Related Products')
            ),
            'from_query_vars' => array('post_status' => 'any')
        ));
    }
}
