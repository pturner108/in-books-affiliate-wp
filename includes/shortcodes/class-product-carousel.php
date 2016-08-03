<?php
namespace IBA;

/**
 * Class Product_Carousel
 * [iba_product_carousel category="cat1,cat2" tag="staff-picks" max="20" skin="boxed" header="title" see_more_caption="View All"]
 *
 * @since 1.0.0
 */
class Product_Carousel extends Shortcodes {

    /**
     * @param $atts array
     *      $atts['category'] string. Optional, single category slug or comma separated
     *      $atts['tag'] string. Optional, single product_tag slug or comma separated
     *      $atts['max'] string|Int. Optional, Max number of product slides
     *      $atts['skin'] string. Optional, Templates to use
     *          1. topbar (Default)
     *          2. topbar-wide
     *          3. naked (Not yet implemented)
     *      $atts['header'] string. Optional, Defaults to category name
     *      $atts['sub_title'] string. Optional, Subtitle for topbar-wide template (useful for two row headers)
     *      $atts['see_more_caption'] string. Optional, Defaults to 'View All' will point to target category page
     *      $atts['link_to_caption'] string. Optional, Defaults links to category
     *      $atts['category_rank'] string|int. Optional, Defaults to 1, category must be define
     *      $atts['show_view_button'] bool. Optional, Defaults to false, tag must be define, only support naked skin
     */
    public function __construct($atts) {
        echo self::configure($atts);
    }

    public static function register() {
        add_shortcode('iba_product_carousel', array(__CLASS__, 'configure'));
        add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_scripts'));
    }

    public static function enqueue_scripts() {
        wp_enqueue_style(
            'bx-slider',
            \IBA\ASSETS_URI . '/css/jquery.bxslider.css',
            array(),
            Main::VERSION
        );

        wp_enqueue_script(
            'rahisified-bxslider',
            \IBA\ASSETS_URI . '/js/jquery.bxslider-rahisified.min.js',
            array('jquery'),
            Main::VERSION
        );
    }

    /**
     * @param $atts array
     * @return string
     */
    public static function configure($atts) {
        $props = shortcode_atts(array(
            'category' => 'featured-product',
            'tag' => '',
            'max' => 20,
            'skin' => 'topbar',
            'header' => '',
            'sub_title' => '',
            'see_more_caption' => 'View All',
            'link_to_caption' => '',
            'category_rank' => 1,
            'show_view_button' => false
        ), $atts);

        $args = array(
            'tax_query' => array(),
            'posts_per_page' => $props['max'],
            'post_type' => 'product',
            'meta_key' => 'iba_publication_date',
            'orderby' => 'meta_value_num',
            'meta_query' => array()
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

            $args['meta_query'][] = array(
                'key' => 'iba_category_1',
                'value' => ($category ? $category->term_id : ''),
                'compare' => '='
            );

            $args['meta_query'][] = array(
                'key' => 'iba_category_1_rank',
                'value' => $props['category_rank'],
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

            if ($props['show_view_button']) {
                $query_param = '';
                if ($props['category']) {
                    $query_param = '?' . http_build_query(array(
                            'category' => $props['category']
                        ));
                }
                $props['show_view_button_text'] = 'View All ' . $tag->name;

                $term_link = get_term_link($tag, 'product_tag');
                if (!is_wp_error($term_link)) $props['show_view_button_link'] = $term_link . $query_param;
            }
        }

        $carousel_query = new \WP_Query($args);
        if (!$carousel_query->have_posts()) {
            return '';
        }

        if ($category) {
            $props['cat_name'] = $category->name;
        }

        if ($tag) {
            $props['tag_name'] = $tag->name;
        }

        if (!$props['header'] && $category) {
            $props['header'] = $category->name;
        } else if (!$props['header'] && $tag) {
            $props['header'] = $tag->name;
        } else if ($props['header'] && $tag) {
            $props['header'] = '<span class="pdc-tag">' . $tag->name . '</span> ' . $props['header'];
        }

        if ($tag && $category) {
            $props['header'] = '<span class="pdc-tag">' . $tag->name . '</span> '
                . ' in <a href="'.get_category_link($category->term_id).'" class="link-brand">'
                . $category->name
                . '</a>';
        }

        if (!$props['link_to_caption'] && $category) {
            $props['link_to_caption'] = get_category_link($category->term_id);
        }

        if (!$props['link_to_caption'] && $tag) {
            $term_link = get_term_link($tag, 'product_tag');
            if (!is_wp_error($term_link)) $props['link_to_caption'] = $term_link;
        }

        $skin_avail = \IBA\TEMPLATE_DIR . "shortcodes/product-carousel/carousel-slider-{$props['skin']}.php";

        if (!file_exists($skin_avail)) {
            $props['skin'] = 'topbar';
        }

        // Generate unique identifiers for slider, slider > next, slider > prev, required by bxslider
        $props['slider_ID'] = uniqid('carousel-slider-');
        $props['slider_next_ID'] = uniqid('carousel-slider-next-');
        $props['slider_prev_ID'] = uniqid('carousel-slider-prev-');

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
