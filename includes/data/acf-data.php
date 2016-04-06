<?php

return array(
    array(
        'id' => 'acf_inbooks-io-options',
        'title' => 'InBooks.io Options',
        'fields' => array(
            array(
                'key' => 'field_54efd4447ae32',
                'label' => 'inbooks.io API Token',
                'name' => 'inbm_spree_api_token',
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
                'name' => 'inbm_spree_store_url',
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
                'name' => 'inbm_spree_sync_per_page',
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
