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
        $screens = array('post', 'book');

        foreach ($screens as $screen) {
            add_meta_box(
                'ds1-related-books-id',
                __('Related Books'),
                array(__CLASS__, 'meta_box_related_books_display'),
                $screen
            );

        }
    }

    /**
     * Adds metabox to posts to show related products
     */
    public static function meta_box_related_books_display() {
        $max = 50;
        $related = iba_get_related_posts(get_the_ID(), array('post_status' => 'publish', 'max' => $max, 'p2p_type' => 'related_post_to_book'));

        echo '<h2>Published Connections</h2>';
        echo '<h3>'. __('Direct Connections') . '</h3>';
        $table = new Related_List_Table();
        $table->prepare_items($related['direct']);
        $table->display();

        echo '<h3>'. __('Via Categories') . '</h3>';
        $table = new Related_List_Table();
        $table->prepare_items($related['ai']);
        $table->display();

        $related = iba_get_related_posts(get_the_ID(), array('post_status' => 'all', 'max' => $max, 'p2p_type' => 'related_post_to_book'));

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

        // The featured book connection
        p2p_register_connection_type(array(
            'name' => 'featured_book',
            'from' => 'post',
            'to' => 'book',
            'title' => array('from' => 'Featured Book', 'to' => 'Related Article'),
            'from_labels' => array(
                'create' => __('Assign Featured Article')
            ),
            'to_labels' => array(
                'create' => __('Assign Featured Book')
            ),
            'admin_dropdown' => 'any',
            'from_query_vars' => array('post_status' => 'any')
        ));

        // Post to book connection
        p2p_register_connection_type(array(
            'name' => 'related_post_to_book',
            'from' => 'post',
            'to' => 'book',
            'title' => array('from' => 'Related Books', 'to' => 'Related Articles'),

            'to_labels' => array(
                'create' => __('Assign Related books')
            ),
            'from_query_vars' => array('post_status' => 'any')
        ));

        // Book to book connection
        p2p_register_connection_type(array(
            'name' => 'related_book_to_book',
            'from' => 'book',
            'to' => 'book',
            'reciprocal' => true,
            'title' => 'Related Books',

            'to_labels' => array(
                'create' => __('Assign Related Books')
            ),
            'from_query_vars' => array('post_status' => 'any')
        ));
    }
}
