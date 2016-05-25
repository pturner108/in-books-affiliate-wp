<?php

$contributor_choices = array(
    '' => 'Not Available',
    '@' => 'Other',
    'ec' => 'Editor in Chief',
    'ev' => 'Volume Editor',
    'A' => 'Author',
    'AA' => 'With',
    'AC' => 'Associate Producer',
    'AG' => 'Arranged by',
    'AL' => 'Alto Vocalist',
    'AR' => 'As Recorded by',
    'AT' => 'Actor',
    'B' => 'Abridged by',
    'BA' => 'Brass by',
    'BI' => 'Biographee',
    'BK' => 'Based on Book Series',
    'BP' => 'Based on a Play by',
    'BR' => 'Baritone Vocalist',
    'BS' => 'Bass Vocalist',
    'BT' => 'Based on a TV Series',
    'BV' => 'Based on a Book by',
    'C' => 'Adapted by',
    'CD' => 'Conductor',
    'CF' => 'Channel',
    'CG' => 'Cartographer',
    'CH' => 'Choreography by',
    'CI' => 'Clarinetist',
    'CL' => 'Calligrapher',
    'CP' => 'Composer',
    'CR' => 'Co-Producer',
    'CS' => 'Consultant',
    'CT' => 'Contralto Vocalist',
    'D' => 'Afterword by',
    'DT' => 'Director',
    'DV' => 'Developed by',
    'E' => 'Editor',
    'EG' => 'Engineer',
    'EP' => 'Executive Producer',
    'ES' => 'Essay by',
    'F' => 'Annotations by',
    'FL' => 'Flutist',
    'FT' => 'Featuring',
    'G' => 'As Told to',
    'GA' => 'Guest Appearance',
    'GP' => 'Guest Perfomer',
    'GT' => 'Guitarist',
    'H' => 'As Told by',
    'HC' => 'Harpsichordist',
    'HP' => 'Harpist',
    'HR' => 'Horn by',
    'HS' => 'Hosted by',
    'I' => 'Illustrator',
    'J' => 'Contribution by',
    'JA' => 'Joint Author',
    'K' => 'Commentaries by',
    'KY' => 'Keyboards by',
    'L' => 'Compiled by',
    'LB' => 'Libretto by',
    'LY' => 'Lyricist',
    'M' => 'Created by',
    'MB' => 'Manufactured by',
    'ME' => 'Music Engraved by',
    'MP' => 'As Made Popular by',
    'MX' => 'Mixer',
    'N' => 'Concept by',
    'O' => 'Designed by',
    'OB' => 'Orchestrated by',
    'OE' => 'Oboist',
    'OR' => 'Organist',
    'P' => 'Photographer',
    'PB' => 'Performed by',
    'PC' => 'Percussion by',
    'PI' => 'Pianist',
    'PN' => 'Piano/Keyboard/Organ by',
    'PR' => 'Prepared by',
    'Q' => 'Epilogue by',
    'R' => 'Experiments by',
    'RB' => 'Recorded by',
    'S' => 'Footnotes by',
    'SB' => 'Screenplay by',
    'SM' => 'Mezzosoprano Vocalist',
    'SO' => 'Soloist',
    'SP' => 'Soprano Vocalist',
    'ST' => 'Strings by',
    'SX' => 'Saxophonist',
    'T' => 'Translator',
    'TB' => 'Transcribed by',
    'TN' => 'Tenor Vocalist',
    'TP' => 'Trumpeteer',
    'TT' => 'Tribute to',
    'U' => 'Foreword by',
    'V' => 'Introduction by',
    'VA' => 'Various Artists (VMI)',
    'VB' => 'Vocal by',
    'VL' => 'Violinist',
    'VO' => 'Voice Talents of',
    'W' => 'Memoir by',
    'WD' => 'Woodwinds by',
    'WL' => 'Worship Leader',
    'Y' => 'Narrated by',
    'Z' => 'Notes by',
    "'0'" => 'Text by (Art/Photo Books)',
    "'1'" => 'Preface by',
    "'2'" => 'Prologue by',
    "'3'" => 'Producer',
    "'4'" => 'Read by',
    "'5'" => 'Retold by',
    "'6'" => 'Revised by',
    "'7'" => 'Selected by',
    "'8'" => 'Summary by',
    "'9'" => 'Supplement by',
);

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
                'label' => 'Contributor 1',
                'name' => 'iba_contributor_1_id',
                'type' => 'taxonomy',
                'taxonomy' => 'contributor',
                'field_type' => 'select'
            ),
            array(
                'key' => 'iba_contributor_1_role',
                'label' => 'Contributor 1 Role',
                'name' => 'iba_contributor_1_role',
                'type' => 'select',
                'choices' => $contributor_choices,
                'default_value' => 'A',
                'allow_null' => 0,
                'multiple' => 0
            ),
            array(
                'key' => 'iba_contributor_2_id',
                'label' => 'Contributor 2',
                'name' => 'iba_contributor_2_id',
                'type' => 'taxonomy',
                'taxonomy' => 'contributor',
                'field_type' => 'select'
            ),
            array(
                'key' => 'iba_contributor_2_role',
                'label' => 'Contributor 2 Role',
                'name' => 'iba_contributor_2_role',
                'type' => 'select',
                'choices' => $contributor_choices,
                'default_value' => 'A',
                'allow_null' => 0,
                'multiple' => 0
            ),
            array(
                'key' => 'iba_contributor_3_id',
                'label' => 'Contributor 3',
                'name' => 'iba_contributor_3_id',
                'type' => 'taxonomy',
                'taxonomy' => 'contributor',
                'field_type' => 'select'
            ),
            array(
                'key' => 'iba_contributor_3_role',
                'label' => 'Contributor 3 Role',
                'name' => 'iba_contributor_3_role',
                'type' => 'select',
                'choices' => $contributor_choices,
                'default_value' => 'A',
                'allow_null' => 0,
                'multiple' => 0
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
    // Contributor Taxonomy, contributors
    array (
        'key' => 'acf_contributor-taxonomy',
        'title' => '',
        'fields' => array (
            array(
                'key' => 'iba_contributor_id',
                'label' => 'ID',
                'name' => 'iba_contributor_id',
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
