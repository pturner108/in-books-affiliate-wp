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
            'tax_query' => array(),
            'posts_per_page' => $props['max'],
            'post_type' => 'product',
            'orderby' => array(
                'iba_publication_date_clause' => 'DESC'
            ),
            'meta_query' => array(
                'iba_category_1_rank_clause' => array(
                    'key' => 'iba_category_1_rank',
                    'value' => 1,
                    'compare' => '='
                ),
                'iba_publication_date_clause' => array(
                    'key' => 'iba_publication_date',
                    'type' => 'DATE',
                    'compare' => 'EXISTS'
                )
            )
        );

        $tag = false;
        $category = false;

        /**
         * If category is defined add it to query
         */
        if ($props['category']) {
            $args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $props['category'],
            );

            $category = get_category_by_slug($props['category']);

            $args['meta_query']['iba_category_1_clause'] = array(
                'key' => 'iba_category_1',
                'value' => ($category ? $category->term_id : ''),
                'compare' => '='
            );
        }

        /**
         * If tag is defined add it to query
         */
        if ($props['tag']) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_tag',
                'field'    => 'slug',
                'terms'    => $props['tag']
            );

            $tag = get_term_by('slug', $props['tag'], 'product_tag');
        }

        $carousel_query = new \WP_Query($args);
        if (!$carousel_query->have_posts()) {
            return '';
        }

        if (!$props['header'] && $category) {
            $props['header'] = $category->name;
        }

        if ($tag && $category) {
            $props['header'] = $tag->name . ' in <span class="link-brand">' . $props['header'] . '</span>';
        }

        if (!$props['link_to_caption'] && $category) {
            $props['link_to_caption'] = get_category_link($category->term_id);
        }

        $skin_avail = \IBA\TEMPLATE_DIR . "carousel-slider-{$props['skin']}.php";

        if (!file_exists($skin_avail)) {
            $props['skin'] = 'topbar';
        }

        self::$_shortcodes['product_carousel'] = array(
            'atts' => $props,
            'query' => $carousel_query
        );

        if (file_exists($skin_avail)) {
            return return_include($skin_avail);
        }

        return '';
    }
}
