<?php
namespace IBA;

/**
 * Class Shortcodes
 *
 * @since 1.0.0
 */
class Shortcodes {
    /**
     * Will store all shortcodes atts by key (without prefix `iba`)
     * @var array
     */
    private static $_shortcodes = array();

    public static function init() {
        add_shortcode('iba_product_carousel', array(__CLASS__, 'product_carousel'));
    }

    public static function get_atts($key) {
        return self::$_shortcodes[$key];
    }

    /**
     * [iba_product_carousel category="cat1,cat2" tag="staff-picks" max="20" skin="boxed" header="title" see_more_caption="View All"]
     * @param $atts array
     *      $atts['category'] string. Optional, single category slug or comma separated
     *      $atts['tag'] string. Optional, single product_tag slug or comma separated
     *      $atts['max'] string|Int. Optional, Max number of product slides
     *      $atts['skin'] string. Optional, Templates to use
     *          1. topbar (Default)
     *          2. topbar-wide
     *          3. naked (Not yet implemented)
     *      $atts['header'] string. Optional, Defaults to category name
     *      $atts['see_more_caption'] string. Optional, Defaults to 'View All' will point to target category page
     *      $atts['link_to_caption'] string. Optional, Defaults links to category
     *
     * @return string;
     */
    public static function product_carousel($atts) {
        $props = shortcode_atts(array(
            'category' => 'featured-product',
            'tag' => '',
            'max' => 20,
            'skin' => 'topbar',
            'header' => '',
            'see_more_caption' => 'View All',
            'link_to_caption' => ''
        ), $atts);

        $args = array(
            'category_name' => $props['category'],
            'posts_per_page' => $props['max'],
            'post_type' => 'product',
            'orderby' => array(
                //'iba_category_rank_clause' => 'ASC',
                'iba_publication_date_clause' => 'DESC'
            ),
            'meta_query' => array(
                /*'iba_category_rank_clause' => array(
                    'relation' => 'AND',
                    array(
                        'relation' => 'OR',
                        array(
                            'key'     => 'iba_category_1',
                            'value' => $props['category'],
                            'compare' => '='
                        ),
                        array(
                            'key'     => 'iba_category_2',
                            'value' => $props['category'],
                            'compare' => '='
                        ),
                        array(
                            'key'     => 'iba_category_3',
                            'value' => $props['category'],
                            'compare' => '='
                        ),
                    ),
                    array(
                        'relation' => 'OR',
                        array(
                            'key'     => 'iba_category_1_rank',
                            'type'    => 'numeric',
                            'compare' => 'EXISTS'
                        ),
                        array(
                            'key'     => 'iba_category_2_rank',
                            'type'    => 'numeric',
                            'compare' => 'EXISTS'
                        ),
                        array(
                            'key'     => 'iba_category_3_rank',
                            'type'    => 'numeric',
                            'compare' => 'EXISTS'
                        )
                    )
                ),*/
                'iba_publication_date_clause' => array(
                    'key' => 'iba_publication_date',
                    'type' => 'DATE',
                    'compare' => 'EXISTS'
                )
            )
        );

        $tag_name = false;
        $category_name = get_term_by('slug', $props['category'], 'category');

        /**
         * If tag is defined add it to query
         */
        if ($props['tag']) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_tag',
                    'field'    => 'slug',
                    'terms'    => $props['tag'],
                ),
            );

            $tag_name = get_term_by('slug', $props['tag'], 'product_tag');
        }

        $carousel_query = new \WP_Query($args);
        if (!$carousel_query->have_posts()) {
            return '';
        }

        if (!$props['header'] && $category_name) {
            $props['header'] = $category_name->name;
        }

        if ($tag_name && $category_name) {
            $props['header'] = $tag_name->name . ' in <span class="link-brand">' . $props['header'] . '</span>';
        }

        if (!$props['link_to_caption'] && $category_name) {
            $props['link_to_caption'] = get_category_link($category_name->term_id);
        }

        $skin_avail = \IBA\TEMPLATE_DIR . "carousel-slider-{$props['skin']}.php";

        if (!file_exists($skin_avail)) {
            $props['skin'] = 'naked';
        }

        self::$_shortcodes['product_carousel'] = array(
            'atts' => $props,
            'query' => $carousel_query
        );

        return return_include($skin_avail);
    }
}
