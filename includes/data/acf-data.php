<?php

return array(
    // Book Meta Data
    array(
        'id' => 'acf_book-meta-data',
        'title' => 'Book Meta Data',
        'fields' => array(
            array(
                'key' => 'field_54be7c15d492f',
                'label' => 'ISBN-10',
                'name' => 'iba_isbn10',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'spree_id' => 'product_properties:isbn_10',
            ),
            array(
                'key' => 'field_54be7c1bd4930',
                'label' => 'ISBN-13',
                'name' => 'iba_isbn13',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'spree_id' => 'product_properties:isbn_13',
            ),
            array(
                'key' => 'field_54be7aa96908a',
                'label' => 'Title Only',
                'name' => 'iba_title',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'spree_id' => 'name',
            ),
            array(
                'key' => 'field_54d64507a27d3',
                'label' => 'Subtitle',
                'name' => 'iba_subtitle',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'spree_id' => 'product_properties:subtitle',
            ),
            array(
                'key' => 'field_54be7ac16908b',
                'label' => 'Series',
                'name' => 'iba_series',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'spree_id' => 'product_properties:series_number',
            ),
            array(
                'key' => 'field_54be7ad46908c',
                'label' => 'Product Format',
                'name' => 'iba_product_format',
                'type' => 'select',
                'choices' => array(
                    '' => '',
                    'AA' => 'Audio',
                    'AB' => 'Audio cassette',
                    'AC' => 'CD-Audio',
                    'AD' => 'DAT',
                    'AE' => 'Audio disc',
                    'AF' => 'Audio tape',
                    'AG' => 'MiniDisc',
                    'AH' => 'CD-Extra',
                    'AI' => 'DVD Audio',
                    'AJ' => 'Downloadable audio file',
                    'AK' => 'Pre-recorded digital audio player',
                    'AL' => 'Pre-recorded SD card',
                    'AZ' => 'Other audio format',
                    'BA' => 'Book',
                    'BB' => 'Hardback',
                    'BC' => 'Paperback / softback',
                    'BD' => 'Loose-leaf',
                    'BE' => 'Spiral bound',
                    'BF' => 'Pamphlet',
                    'BG' => 'Leather / fine binding',
                    'BH' => 'Board book',
                    'BI' => 'Rag book',
                    'BJ' => 'Bath book',
                    'BK' => 'Novelty book',
                    'BL' => 'Slide bound',
                    'BM' => 'Big book',
                    'BN' => 'Part-work (fascículo)',
                    'BO' => 'Fold-out book or chart',
                    'BP' => 'Foam book',
                    'BZ' => 'Other book format',
                    'CA' => 'Sheet map',
                    'CB' => 'Sheet map, folded',
                    'CC' => 'Sheet map, flat',
                    'CD' => 'Sheet map, rolled',
                    'CE' => 'Globe',
                    'CZ' => 'Other cartographic',
                    'DA' => 'Digital',
                    'DB' => 'CD-ROM',
                    'DC' => 'CD-I',
                    'DD' => 'DVD',
                    'DE' => 'Game cartridge',
                    'DF' => 'Diskette',
                    'DG' => 'Electronic book text',
                    'DH' => 'Online resource',
                    'DI' => 'DVD-ROM',
                    'DJ' => 'Secure Digital (SD) Memory Card',
                    'DK' => 'Compact Flash Memory Card',
                    'DL' => 'Memory Stick Memory Card',
                    'DM' => 'USB Flash Drive',
                    'DN' => 'Double-sided CD/DVD',
                    'DZ' => 'Other digital',
                    'FA' => 'Film or transparency',
                    'FB' => 'Film',
                    'FC' => 'Slides',
                    'FD' => 'OHP transparencies',
                    'FE' => 'Filmstrip',
                    'FF' => 'Film',
                    'FZ' => 'Other film or transparency format',
                    'MA' => 'Microform',
                    'MB' => 'Microfiche',
                    'MC' => 'Microfilm',
                    'MZ' => 'Other microform',
                    'PA' => 'Miscellaneous print',
                    'PB' => 'Address book',
                    'PC' => 'Calendar',
                    'PD' => 'Cards',
                    'PE' => 'Copymasters',
                    'PF' => 'Diary',
                    'PG' => 'Frieze',
                    'PH' => 'Kit',
                    'PI' => 'Sheet music',
                    'PJ' => 'Postcard book or pack',
                    'PK' => 'Poster',
                    'PL' => 'Record book',
                    'PM' => 'Wallet or folder',
                    'PN' => 'Pictures or photographs',
                    'PO' => 'Wallchart',
                    'PP' => 'Stickers',
                    'PQ' => 'Plate (lámina)',
                    'PR' => 'Notebook / blank book',
                    'PS' => 'Organizer',
                    'PT' => 'Bookmark',
                    'PZ' => 'Other printed item',
                    'VA' => 'Video',
                    'VB' => 'Video, VHS, PAL',
                    'VC' => 'Video, VHS, NTSC',
                    'VD' => 'Video, Betamax, PAL',
                    'VE' => 'Video, Betamax, NTSC',
                    'VF' => 'Videodisc',
                    'VG' => 'Video, VHS, SECAM',
                    'VH' => 'Video, Betamax, SECAM',
                    'VI' => 'DVD video',
                    'VJ' => 'VHS video',
                    'VK' => 'Betamax video',
                    'VL' => 'VCD',
                    'VM' => 'SVCD',
                    'VN' => 'HD DVD',
                    'VO' => 'Blu-ray',
                    'VP' => 'UMD Video',
                    'VZ' => 'Other video format',
                    'WW' => 'Mixed media product',
                    'WX' => 'Multiple copy pack',
                    'XA' => 'Trade-only material',
                    'XB' => 'Dumpbin - empty',
                    'XC' => 'Dumpbin - filled',
                    'XD' => 'Counterpack - empty',
                    'XE' => 'Counterpack - filled',
                    'XF' => 'Poster, promotional',
                    'XG' => 'Shelf strip',
                    'XH' => 'Window piece',
                    'XI' => 'Streamer',
                    'XJ' => 'Spinner',
                    'XK' => 'Large book display',
                    'XL' => 'Shrink-wrapped pack',
                    'XZ' => 'Other point of sale',
                    'ZA' => 'General merchandise',
                    'ZB' => 'Doll',
                    'ZC' => 'Soft toy',
                    'ZD' => 'Toy',
                    'ZE' => 'Game',
                    'ZF' => 'T-shirt',
                    'ZZ' => 'Other merchandise',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
                'spree_id' => 'product_properties:product_format',
            ),
            array(
                'key' => 'field_54be7b53614b7',
                'label' => 'Display Format',
                'name' => 'iba_display_format',
                'type' => 'select',
                'choices' => array(
                    '' => '',
                    'ebook' => 'eBook',
                    'paperback' => 'Paperback',
                    'hardcover' => 'Hardcover',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
                'spree_id' => 'product_properties:display_format',
            ),
            array(
                'key' => 'field_54be7bead492d',
                'label' => 'Availability',
                'name' => 'iba_availability',
                'type' => 'text'
            ),
            array(
                'key' => 'field_54be7c0cd492e',
                'label' => 'Page Count',
                'name' => 'iba_page_count',
                'type' => 'number',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
                'spree_id' => 'product_properties:page_count',
            ),
            array(
                'key' => 'field_54be7c72d4934',
                'label' => 'Publisher',
                'name' => 'iba_publisher',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'spree_id' => 'product_properties:publisher',
            ),
            array(
                'key' => 'field_54be7c82d4935',
                'label' => 'Publication Date',
                'name' => 'iba_publication_date',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'spree_id' => 'product_properties:pub_date',
            ),
            array(
                'key' => 'field_54be7c97d4936',
                'label' => 'Language',
                'name' => 'iba_language',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
                'spree_id' => 'product_properties:language',
            ),
            array(
                'key' => 'field_54be7d20d493a',
                'label' => 'Staff Review',
                'name' => 'iba_staff_review',
                'type' => 'wysiwyg',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 1,
                'spree_id' => 'description',
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
        'menu_order' => 1,
    ),
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
            'position' => 'normal',
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
            'position' => 'normal',
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
                'key' => 'iba_contributor_1_display_name',
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
    )
);
