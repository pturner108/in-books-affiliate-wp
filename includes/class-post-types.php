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
            'label'                 => __('Product Contributors', 'iba'),
            'labels' => array(
                'name'              => __('Product Contributors', 'iba'),
                'singular_name'     => __('Product Contributor', 'iba'),
                'menu_name'         => _x('Contributors', 'Admin menu name', 'iba'),
                'search_items'      => __('Search Product Contributors', 'iba'),
                'all_items'         => __('All Product Contributors', 'iba'),
                'parent_item'       => __('Parent Product Contributor', 'iba'),
                'parent_item_colon' => __('Parent Product Contributor:', 'iba'),
                'edit_item'         => __('Edit Product Contributor', 'iba'),
                'update_item'       => __('Update Product Contributor', 'iba'),
                'add_new_item'      => __('Add New Product Contributor', 'iba'),
                'new_item_name'     => __('New Product Contributor Name', 'iba')
           ),
            'show_ui'               => true,
            'query_var'             => true,
            'rewrite' => array(
                'slug'         => _x('contributor', 'slug', 'iba'),
                'with_front'   => false,
                'hierarchical' => true,
           ),
       ));
    }
}

PostTypes::init();
