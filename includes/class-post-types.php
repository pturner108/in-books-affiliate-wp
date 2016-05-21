<?php
namespace IBA;

/**
 * Class PostTypes
 *
 * @since 1.0.0
 */
class PostTypes {
    public static function init() {
        add_action('init', array(__CLASS__, 'register_taxonomies'));
    }

    public static function register_taxonomies() {
        register_taxonomy('contributor', 'product', array(
            'hierarchical'          => true,
            'label'                 => __('Contributors', 'iba'),
            'labels' => array(
                'name'              => __('Contributors', 'iba'),
                'singular_name'     => __('Contributor', 'iba'),
                'menu_name'         => _x('Contributors', 'Admin menu name', 'iba'),
                'search_items'      => __('Search Product Contributors', 'iba'),
                'all_items'         => __('All Contributors', 'iba'),
                'parent_item'       => __('Parent Contributor', 'iba'),
                'parent_item_colon' => __('Parent Contributor:', 'iba'),
                'edit_item'         => __('Edit Contributor', 'iba'),
                'update_item'       => __('Update Contributor', 'iba'),
                'add_new_item'      => __('Add New Contributor', 'iba'),
                'new_item_name'     => __('New Contributor Name', 'iba'),
                'not_found'         => __('No contributors found', 'iba')
            ),
            'show_ui'               => true,
            'query_var'             => true,
            'rewrite' => array(
                'slug'         => _x('contributor', 'slug', 'iba'),
                'with_front'   => false,
                'hierarchical' => true,
            ),
            'meta_box_cb' => false // Hide metabox from post type
       ));
    }
}

PostTypes::init();
