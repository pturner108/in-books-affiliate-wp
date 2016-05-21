<?php

return array(
    // Primary Meta Data
    array(
        'id' => 'acf_primary-meta-data',
        'title' => 'Primary Meta Data',
        'fields' => array(
            array(
                'key' => 'iba_title',
                'label' => 'Title',
                'name' => 'iba_title',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_subtitle',
                'label' => 'Subtitle',
                'name' => 'iba_subtitle',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_availability',
                'label' => 'Product Availability',
                'name' => 'iba_availability',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_display_format',
                'label' => 'Format',
                'name' => 'iba_display_format',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_isbn13',
                'label' => 'ISBN 13',
                'name' => 'iba_isbn13',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_isbn10',
                'label' => 'ISBN 10',
                'name' => 'iba_isbn10',
                'type' => 'text'
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 2,
    ),
    // Product Details
    array(
        'id' => 'acf_product-details',
        'title' => 'Product Details',
        'fields' => array(
            array(
                'key' => 'iba_publisher',
                'label' => 'Publisher',
                'name' => 'iba_publisher',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_publisher_imprint',
                'label' => 'Publisher Imprint',
                'name' => 'iba_publisher_imprint',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_publication_date',
                'label' => 'Publication Date',
                'name' => 'iba_publication_date',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_language',
                'label' => 'Language of Text',
                'name' => 'iba_language',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_product_form_detail',
                'label' => 'Format (detail)',
                'name' => 'iba_product_form_detail',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_edition_number',
                'label' => 'Edition Number',
                'name' => 'iba_edition_number',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_edition_description',
                'label' => 'Edition Description',
                'name' => 'iba_edition_description',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_large_print_flag',
                'label' => 'Large Print Flag',
                'name' => 'iba_large_print_flag',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_page_count',
                'label' => 'Page Count',
                'name' => 'iba_page_count',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_playing_time',
                'label' => 'Playing Time',
                'name' => 'iba_playing_time',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_file_size',
                'label' => 'File Size',
                'name' => 'iba_file_size',
                'type' => 'text'
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'side',
            'layout' => 'default',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 3,
    ),
    // Categories
    array(
        'id' => 'acf_categories',
        'title' => 'Categories',
        'fields' => array(
            array(
                'key' => 'iba_category_1',
                'label' => 'Category 1',
                'name' => 'iba_category_1',
                'type' => 'taxonomy',
                'taxonomy' => 'category',
                'field_type' => 'select',
                'add_term' => false,
                'return_format' => 'object'
            ),
            array(
                'key' => 'iba_category_1_rank',
                'label' => 'Category 1 Rank',
                'name' => 'iba_category_1_rank',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_category_2',
                'label' => 'Category 2',
                'name' => 'iba_category_2',
                'type' => 'taxonomy',
                'taxonomy' => 'category',
                'field_type' => 'select',
                'add_term' => false,
                'return_format' => 'object'
            ),
            array(
                'key' => 'iba_category_2_rank',
                'label' => 'Category 2 Rank',
                'name' => 'iba_category_2_rank',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_category_3',
                'label' => 'Category 3',
                'name' => 'iba_category_3',
                'type' => 'taxonomy',
                'taxonomy' => 'category',
                'field_type' => 'select',
                'add_term' => false,
                'return_format' => 'object'
            ),
            array(
                'key' => 'iba_category_3_rank',
                'label' => 'Category 3 Rank',
                'name' => 'iba_category_3_rank',
                'type' => 'text'
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'side',
            'layout' => 'default',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 4,
    ),
    // Contributors
    array(
        'id' => 'acf_contributors',
        'title' => 'Contributors',
        'fields' => array(
            array(
                'key' => 'iba_contributor_1_id',
                'label' => 'Contributor 1 ID',
                'name' => 'iba_contributor_1_id',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_contributor_1_',
                'label' => 'Contributor 1 Display Name',
                'name' => 'iba_contributor_1_display_name',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_contributor_1_biography',
                'label' => 'Contributor 1 Bio',
                'name' => 'iba_contributor_1_biography',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'media_upload' => 0
            ),
            array(
                'key' => 'iba_contributor_1_photo',
                'label' => 'Contributor 1 Photo',
                'name' => 'iba_contributor_1_photo',
                'type' => 'image',
                'column_width' => '',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all'
            ),
            array(
                'key' => 'iba_contributor_2_id',
                'label' => 'Contributor 2 ID',
                'name' => 'iba_contributor_2_id',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_contributor_2_display_name',
                'label' => 'Contributor 2 Display Name',
                'name' => 'iba_contributor_2_display_name',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_contributor_2_biography',
                'label' => 'Contributor 2 Bio',
                'name' => 'iba_contributor_2_biography',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'media_upload' => 0
            ),
            array(
                'key' => 'iba_contributor_2_photo',
                'label' => 'Contributor 2 Photo',
                'name' => 'iba_contributor_2_photo',
                'type' => 'image',
                'column_width' => '',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all'
            ),
            array(
                'key' => 'iba_contributor_3_id',
                'label' => 'Contributor 3 ID',
                'name' => 'iba_contributor_3_id',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_contributor_3_display_name',
                'label' => 'Contributor 3 Display Name',
                'name' => 'iba_contributor_3_display_name',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_contributor_3_biography',
                'label' => 'Contributor 3 Bio',
                'name' => 'iba_contributor_3_biography',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'media_upload' => 0
            ),
            array(
                'key' => 'iba_contributor_3_photo',
                'label' => 'Contributor 3 Photo',
                'name' => 'iba_contributor_3_photo',
                'type' => 'image',
                'column_width' => '',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all'
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 4,
    ),
    // Marketing Copy
    array(
        'id' => 'acf_marketing-copy',
        'title' => 'Marketing Copy',
        'fields' => array(
            array(
                'key' => 'iba_staff_review',
                'label' => 'Staff Review',
                'name' => 'iba_staff_review',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'media_upload' => 0
            ),
            array(
                'key' => 'iba_excerpt',
                'label' => 'Book Excerpt',
                'name' => 'iba_excerpt',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'media_upload' => 0
            ),
            array(
                'key' => 'iba_table_of_contents',
                'label' => 'Table of Contents',
                'name' => 'iba_table_of_contents',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'media_upload' => 0
            ),
            array(
                'key' => 'iba_praise',
                'label' => 'Praise',
                'name' => 'iba_praise',
                'type' => 'wysiwyg',
                'toolbar' => 'full',
                'media_upload' => 0
            ),
            array(
                'key' => 'iba_look_inside_code',
                'label' => 'Look Inside the Book',
                'name' => 'iba_look_inside_code',
                'type' => 'textarea'
            )
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 5,
    ),
    // InBooks.io Options
    array(
        'id' => 'acf_inbooks-io-options',
        'title' => 'InBooks.io Options',
        'fields' => array(
            array(
                'key' => 'field_54efd4447ae32',
                'label' => 'inbooks.io API Token',
                'name' => 'iba_spree_api_token',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'spree_id' => '',
            ),
            array(
                'key' => 'field_54efd5121a59a',
                'label' => 'inbooks.io URL',
                'name' => 'iba_spree_store_url',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'spree_id' => '',
            ),
            array(
                'key' => 'field_54f9119e78460',
                'label' => 'Record per page of sync',
                'name' => 'iba_spree_sync_per_page',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'spree_id' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 3,
    ),
    // Contributor Taxonomy, contributors
    array (
        'key' => 'acf_contributor-taxonomy',
        'title' => '',
        'fields' => array (
            array(
                'key' => 'iba_contributor_import_id',
                'label' => 'Import ID',
                'name' => 'iba_contributor_import_id',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_contributor_display_name',
                'label' => 'Display Name',
                'name' => 'iba_contributor_display_name',
                'type' => 'text'
            ),
            array(
                'key' => 'iba_contributor_photo',
                'label' => 'Photo',
                'name' => 'iba_contributor_photo',
                'type' => 'image',
                'column_width' => '',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
                'library' => 'all'
            )
        ),
        'location' => array (
            array (
                array (
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'contributor',
                ),
            ),
        ),
        'menu_order' => 0,
        'active' => 1
    )
);
